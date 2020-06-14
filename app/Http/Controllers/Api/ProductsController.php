<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\Auth;

use App\Service;
use App\Http\Resources\Product as ProductResource;
use App\Http\Requests;
use App\Product;

class ProductsController extends Controller
{
    
    public function index()
    {
         //Show services
         $products = Product::all();

         //Return collection
         $result = ProductResource::Collection($products);
         if($result){
             return response()->json(['products'=>$result, 'error'=>false, 'message'=>'Details succesfully fetched']);
         }
         else if(code ==404){
             return $result->response()->json(['error'=>true, 'message'=>'Details Not found']);
         }
         else return response()->json(['error'=>true, 'message'=>'Error fetching data']);
    }

    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        //Get user id
         //Validate before inserting user records
         $this->validate($request, [
            'capital'         => 'required',
            'income'          => 'required',
            'transport'       => 'required',
            'savings'         => 'required',
            'otherExpenses'   => 'required',

        ]);

        $product = $request->isMethod('put') ? Product::findOrFail($request->id) : new Product;

        $product->capital = $request->input('capital');
        $product->income = $request->input('income');
        $product->transport = $request->input('transport');
        $product->savings = $request->input('savings');
        $product->otherExpenses = $request->input('otherExpenses');
        $product->date = date("Y-m-d");

        $product->user = Auth::user()->id;
        $product->save();
        return response()->json(['error' => false, 'message' => 'Product Succesfully Recorded']);
        
    }

    
    public function show($id)
    {
        //Get single Product

        $product = Product::find($id);

        //Return user details
        $result = new ProductResource($product);

        if($product){
            return response()->json(['product'=>$result, 'error'=>false, 'message'=>'Details succesfully fetched']);
        }
        else return response()->json(['error'=>true, 'message'=>'Error fetching data']);
    }

    // public function edit($id)
    // {
    //     //
    // }

    
    // public function update(Request $request, $id)
    // {
    //     //
    // }
    
    // public function destroy($id)
    // {
    //     //
    // }
}
