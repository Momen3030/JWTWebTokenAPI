<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Auth;
use Tymon\JWTAuth\Facades\JWTAuth; //use this library
use Illuminate\Support\Facades\Validator;
class ProductController extends Controller
{
    public  function  allProducts(){
        $products=Product::paginate(10);
        return response()->json($products);
    }

    public function store(Request $request)
    { 

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:255',
        'description' => 'required',
        'price'=>'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['errorr'=>$validator->errors()]);
        }
        
    $product = Product::create($request->all());
    return response()->json(['msg'=>'Product Created Successfully']);
    }
}