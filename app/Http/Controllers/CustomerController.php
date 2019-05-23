<?php

namespace Flurry\Http\Controllers;

use Illuminate\Http\Request;
use Flurry\Http\Requests\StoreCustomerRequest;
use Flurry\Customer;
use Flurry\AreaCode;
use Flurry\InternationalCode;
use Flurry\Locality;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->query('per_page', 15);
        $search = $request->query('search');
        if ($search)
            $customers = Customer::whereRaw("CONCAT(name, ' ', lastname) like ?", '%'.$search.'%')
                                ->orWhere('email', 'like', '%'.$search.'%')
                                ->orWhere('phone', 'like', '%'.$search.'%')
                                ->orWhere('mobile', 'like', '%'.$search.'%')
                                ->with(['locality:id,name', 'area_code_phone:id,code', 'area_code_mobile:id,code'])
                                ->paginate($per_page);
        else
            $customers = Customer::with(['locality:id,name', 'area_code_phone:id,code', 'area_code_mobile:id,code'])
                                ->paginate($per_page);

        return view('customers.index', compact('customers'));
    }

    /**
     * Función utilizada para crear nuevos Clientes.
     * Si por GET viene phone, vengo de Armar Pedido y utilizo phone como futuro celular.
     * Si no viene nada por GET, vengo del Listado de Clientes.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = new Customer(); // Se pasa customer vacío porque lo utiliza en el formulario como parámetro si existe o no.
        $mobile       = request()->input('phone');
        $createOrder  = boolval($mobile);
        if ($createOrder){
            session()->flash('create_order', 'yes');
        }
        $area_codes   = AreaCode::all();
        $localities   = Locality::all();
        $default_code = config('ourconfig.international_codes.default_id', 10);
        $international_code = InternationalCode::where('id', $default_code)->first();
        return view('customers.create', compact("customer", "area_codes", "localities", "international_code", "mobile"));
    }

    /**
     * Guardo un nuevo cliente en la base de datos.
     * Dos casos: 
     *   a) venir de "Armar Pedido", por ende redirigir a crear orden
     *   b) venir de "Listado de Clientes", por ende volver a dicho Listado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        $customer = new Customer();
        $customer->fill($request->except(['name', 'lastname', 'email']));
        $customer->name = ucwords(strtolower(trim($request->input('name'))));
        $customer->lastname = ucwords(strtolower(trim($request->input('lastname'))));
        $customer->email = strtolower(trim($request->input('email')));
        if ($request->filled('facebook_verify'))
            $customer->facebook_verify = true;        
        else
            $customer->facebook_verify = false;
        
        if ($request->filled('instagram_verify'))
            $customer->instagram_verify = true;        
        else 
            $customer->instagram_verify = false;
        
        if ($request->filled('twitter_verify'))
            $customer->twitter_verify = true;
        else 
            $customer->twitter_verify = false;
        
        $customer->save();
        if (session()->has('create_order'))
            return redirect()->action('OrderController@create', ['customer_id' => $customer->id]);
        else
            return redirect('/customers')->with('success', '¡Cliente creado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        session()->flash('back_url', url()->previous());
        $mobile = ""; // Se pasa mobile vacío porque lo utiliza en el formulario como parámetro si existe o no.
        $area_codes   = AreaCode::all();
        $localities   = Locality::all();
        $default_code = config('ourconfig.international_codes.default_id', 10);
        $international_code = InternationalCode::where('id', $default_code)->first();
        return view('customers.edit', compact("customer", "area_codes", "localities", "international_code", "mobile"));
    }

    /**
     * Luego de actualizar un cliente:
     *   a) retorno json (caso de Edición de Pedido)
     *   b) retorno al Listado de Clientes
     *   c) retorno a show de Pedido
     *   d) retorno a show Cliente
     *   e) retorno json a show Cliente (en caso de geolocalización)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        if ($request->ajax() && $request->input("action_customer") == "SaveCoords") {
            $customer->latitude  = $request->input('lat');
            $customer->longitude = $request->input('lng');
            $customer->save();
            return response()->json("ok", 200);
        }
        $customer->fill($request->except(['name', 'lastname', 'email']));
        $customer->name = ucwords(strtolower(trim($request->input('name'))));
        $customer->lastname = ucwords(strtolower(trim($request->input('lastname'))));
        $customer->email = strtolower(trim($request->input('email')));
        if ($request->filled('facebook_verify')) {
            if ($request->input('facebook_verify') == 'on' || $request->input('facebook_verify') == true)
                $customer->facebook_verify = true;
            else
                $customer->facebook_verify = false;
        }
        else 
            $customer->facebook_verify = false;

        if ($request->filled('instagram_verify')) {
            if ($request->input('instagram_verify') == 'on' || $request->input('instagram_verify') == true) 
                $customer->instagram_verify = true;       
            else 
                $customer->instagram_verify = false;
        }
        else 
            $customer->instagram_verify = false;

        if ($request->filled('twitter_verify')) {
            if ($request->input('twitter_verify') == 'on' || $request->input('twitter_verify') == true)
                $customer->twitter_verify = true;
            else
                $customer->twitter_verify = false;
        }
        else
            $customer->twitter_verify = false;

        $customer->save();
        if ($request->ajax()) {
            return response()->json(['message' => 'Datos guardados correctamente.']);
        }
        else {
            return redirect(session('back_url'))->with('success', '¡Cliente actualizado!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return back()->with('success', '¡Cliente eliminado!');
    }
}
