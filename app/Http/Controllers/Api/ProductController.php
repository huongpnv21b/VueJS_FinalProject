<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use DB;

class ProductController extends Controller
{

    //
    // fetches and returns all the product records
    public function index()
    {
        return response()->json(Product::all(),200);
    }

    //search
    function search(Request $request)
    {
        $q =$request->name;
        $search = Product::where('name','LIKE',"%$q%")->get();
        return response()->json($search,200);
    }
    // creates a product record
    public function store(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id'=>$request->category_id,
            'units' => $request->units,
            'price' => $request->price,
            'image' => $request->image
        ]);

        return response()->json([
            'status' => (bool) $product,
            'data'   => $product,
            'message' => $product ? 'Product Created!' : 'Error Creating Product'
        ]);
    }

    // fetches and returns a single product
    public function show(Product $product)
    {
        return response()->json($product,200); 
    }


    // uploads the image for a product we created and returns the url for the product.
    public function uploadFile(Request $request)
    {
        if($request->hasFile('image')){
            $name = time()."_".$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $name);
        }
        return response()->json(asset("images/$name"),201);
    }


    // updates the product record.
    public function update(Request $request, Product $product)
    {
        $status = $product->update(
            $request->only(['name','category_id', 'description', 'units', 'price', 'image'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Product Updated!' : 'Error Updating Product'
        ]);
    }


    // adds new units to a product.
    public function updateUnits(Request $request, Product $product)
    {
        $product->units = $product->units + $request->get('units');
        $status = $product->save();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Units Added!' : 'Error Adding Product Units'
        ]);
    }


    // deletes a product.
    public function destroy($id)
    {
        $delete =  DB:: table ('products')->where('id', '=', $id)->delete();
        return response()->json( $delete,200);
    }
}
