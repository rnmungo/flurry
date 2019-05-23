<?php

namespace Flurry\Http\Controllers;

use Illuminate\Http\Request;
use Flurry\Cadet;
use Flurry\Http\Requests\StoreCadetRequest;


class CadetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cadets = Cadet::all()->sortBy('name');
        return view('cadets.index', compact('cadets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCadetRequest $request)
    {
        $cadet = new Cadet();
        $cadet->name = $request->name;
        $cadet->save();
        return redirect('/cadets')->with('success', '¡Cadete creado!');
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
    public function edit($id)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCadetRequest $request, Cadet $cadet)
    {
        $cadet->name = $request->name;
        $cadet->save();
        alert()->success('¡Cadete modificado con éxito!')->autoclose(2000);
        return redirect('/cadets');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cadet $cadet)
    {
        $cadet->delete();
        return back()->with('success', '¡Cadete eliminado!');
    }
}
