<?php

namespace Flurry\Http\Controllers;

use Illuminate\Http\Request;
use Flurry\Product;
use Flurry\Http\Requests\StoreProductRequest;
use File;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::open()->get()->sortBy('name');
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Se pasa un objeto vacío para facilitar la vista blade
        $product = new Product();
        return view('products.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $product = new Product();
        $product->fill($request->except('picture'));
        if($request->hasFile('picture')){
            $file = $request->file('picture');
            $filename = time().$file->getClientOriginalName();
            $file->move(public_path().'/imagenes/productos/', $filename);
            $product->picture = $filename;
        }
        $product->save();
        return redirect('/products')->with('success', '¡Producto creado!');
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
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductRequest $request, Product $product)
    {
        $product->fill($request->except('picture'));
        if($request->hasFile('picture')){
            if ($product->hasPicture())
                $this->deletePicture($product);
            $file = $request->file('picture');
            $filename = time().$file->getClientOriginalName();
            $file->move(public_path().'/imagenes/productos/', $filename);
            $product->picture = $filename;
        }
        else if ($request->filled('deletePictureFlag')){
            if ($product->hasPicture()){
                $this->deletePicture($product);
                $product->picture = null;
            }
        }
        $product->save();
        alert()->success('¡Producto modificado con éxito!')->autoclose(2000);
        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->hasPicture())
            $this->deletePicture($product);
        $product->closed = true;
        $product->save();
        return back()->with('success', '¡Producto eliminado!');
    }

    public function deletePicture($product)
    {
        $picture_path = public_path().'/imagenes/productos/'.$product->picture;
        File::delete($picture_path);
    }
}
