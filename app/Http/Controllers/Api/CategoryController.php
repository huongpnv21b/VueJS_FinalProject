<?php

namespace App\Http\Controllers\Api;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    function index()
    {
      $category = Category::all();
      return response()->json($category,201);
    }
    // get product according to id category
    function getCategory($id){
        $categories=Product::where('category_id',$id)->get();
        return  response()->json($categories,200);
       }
}
