<?php

namespace Flurry\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Flurry\Http\Controllers\Controller;
use Flurry\User;
use Flurry\Role;
use Flurry\Http\Requests\StoreUserRequest;
use Validator;


class UserController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('role:users')
             ->except([
                'update',
                'show_change_password',
                'show_change_avatar',
             ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::whereHas('role', function ($query) {
                $query->where('name', 'Supervisor')->orWhere('name', 'Manager');
            })->select('email')->get();
            return response()->json(['users' => $users], 200);
        }
        $users = User::all()->sortBy('name');
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all()->sortBy('name');
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User();
        $user->fill($request->except(['password']));
        $user->password = bcrypt($request->input('password'));
        $user->random_id = uniqid(str_random(17));
        $user->save();
        return redirect('/users')->with('success', '¡Usuario creado!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all()->sortBy('name');
        return view('users.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($request->filled('action_user')) {
            if ($request->action_user == 'change_password') {
                if ($request->input('password') != $request->input('password2')) {
                    return back()->with('errors', '¡Las contraseñas deben coincidir!');
                }
                $user->password = bcrypt($request->input('password'));
                $user->save();
                alert()->success('Contraseña modificada con éxito!')->autoclose(2500);
            }
            else if ($request->action_user == 'system_avatar') {
                $this->change_avatar($user, $request);
            }
            else if ($request->action_user == 'custom_avatar') {
                if($request->hasFile('custom_avatar')) {
                    $this->change_avatar($user, $request, True);
                }
                else {
                    return back()->withErrors('No se pudo cargar el avatar.
                        Pruebe con una imagen de menor tamaño. El máximo permitido es 1.5 MB.');
                }
            }
            return redirect('/home');
        }
        else {
            $user->fill($request->all());
            $user->save();
            return redirect('/users')->with('success', '¡Usuario modificado!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->own_avatar) {
            $this->delete_avatar($user);
        }
        $user->delete();
        return back()->with('success', '¡Usuario eliminado!');
    }


    /*****     Vistas extra     *****/
    public function show_change_password(User $user)
    {
        return view('users.password', compact('user'));
    }

    public function show_change_avatar(User $user)
    {
        $avatares = File::files('imagenes/avatares/');
        return view('users.avatar', compact('avatares'));
    }


    /*****     Manejo de avatar     *****/
    protected function change_avatar($user, $request, $custom=False)
    {
        if ($custom){
            $this->saveCustomAvatar($user, $request->file('custom_avatar'));
            $user->own_avatar = true;
        }
        else {
            if ($user->own_avatar){
                $this->delete_avatar($user);
                $user->own_avatar = false;
            }
            $user->avatar = $request->avatar;            
        }
        $user->save();
        alert()->success('¡Avatar modificado con éxito!')->autoclose(2500);
    }

    protected function saveCustomAvatar($user, $file)
    {
        $this->validateAvatarFile($file);
        if ($user->own_avatar)
            $this->delete_avatar($user);
        $filename = time().$user->name.'.'.$file->getClientOriginalExtension();
        $file->move(public_path().'/imagenes/avatares/usuarios/', $filename);
        $user->avatar = $filename;
    }

    protected function validateAvatarFile($file)
    {
        $rules = ['avatar' =>
            ['file',
             'image',
             'max:1536',
             Rule::dimensions()->maxWidth(1000)->maxHeight(1000)
            ]];
        $messages = [
            'image'      => 'El avatar elegido debe ser una imagen.',
            'max'        => 'La imagen debe pesar un máximo de 1.5 MB.',
            'dimensions' => 'La imagen es demasiado grande. La resolución máxima permitida es 1000x1000.',
        ];

        $validator = Validator::make(['avatar' => $file], 
                                    $rules,
                                    $messages
        )->validate();
    }

    protected function delete_avatar(User $user)
    {
        $path = public_path().$user->getAvatarFullPath();
        File::delete($path);
    }
}
