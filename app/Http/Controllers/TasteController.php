<?php

namespace Flurry\Http\Controllers;

use Illuminate\Http\Request;
use Flurry\Taste;
use Flurry\Http\Requests\StoreTasteRequest;


class TasteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tastes = Taste::all()->sortBy('name');
        return view('tastes.index', compact('tastes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Se pasa un objeto vacío para facilitar la vista blade
        $taste = new Taste();
        return view('tastes.create', compact('taste'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTasteRequest $request)
    {
        $taste = new Taste();
        $taste->fill($request->except('white_text'));
        if ($request->has('white_text')) {
            $taste->white_text = true;
        }
        else {
            $taste->white_text = false;
        }
        $taste->save();
        return redirect('/tastes')->with('success', '¡Gusto creado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Taste $taste)
    {
        return view('tastes.edit', compact('taste'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTasteRequest $request, Taste $taste)
    {
        $taste->fill($request->except('white_text'));
        if ($request->has('white_text')) {
            $taste->white_text = true;
        }
        else {
            $taste->white_text = false;
        }
        $taste->save();
        alert()->success('¡Gusto modificado con éxito!')->autoclose(2000);
        return redirect('/tastes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Taste $taste)
    {
        $taste->delete();
        return back()->with('success', '¡Gusto eliminado!');
    }
}
