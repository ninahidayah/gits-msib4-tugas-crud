<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories'] = Category::all();
        $data['products'] = Product::all();
        return view('manage.product',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|exists:categories,id',
            'photo' => 'required|image|mimes:png,jpg',
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
        ]);

        $photo = $request->file('photo')->store('public/products');
        $photo_path = Storage::url($photo);

        Product::create([
            'category_id' => $request->category,
            'name' => $request->name,
            'photo' => $photo_path,
            'price' => $request->price,
            'description' => $request->description
        ]);

        return redirect()->route('manage.product.index')->with('success','Successfully added data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category' => 'required|exists:categories,id',
            'photo' => 'nullable',
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
        ]);

        $photo_path = $product->photo;
        if($request->file('photo'))
        {
            $request->validate([
                'photo' => 'required|image|mimes:png,jpg',
            ]);
            $photo = $request->file('photo')->store('public/products');
            $photo_path = Storage::url($photo);
        }

        $product->update([
            'category_id' => $request->category,
            'name' => $request->name,
            'photo' => $photo_path,
            'price' => $request->price,
            'description' => $request->description
        ]);

        return redirect()->route('manage.product.index')->with('success','Successfully updated data');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('manage.product.index')->with('success','Successfully deleted data');
    }
}
