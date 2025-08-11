<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use App\Models\Subproductcats;
use App\Models\Productcats;
use App\Models\Products;
// use App\Models\Productimages;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.Subproductcats
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('adminend.product.show',['productCats'=>Productcats::all(),'products'=>Products::orderBy('created_at','DESC')->get()
      ]);
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
      
      if(Products::Create($request->all())){
            return redirect('admin/products')->with('success','Bill successfully added');
        }else{
            return redirect('admin/products')->with('error','Something went wrong,Please try again'); 
        }
        
    
 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $product)
    {
        $Productcats = Productcats::all();
        return view('adminend.product.edit',['product'=>$product,'productCats'=> $Productcats]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $product)
    {
      

        if($product->update($request->all())){

            return redirect('/admin/products')->with('success','Bill successfully updated');

          }else{
              return redirect('admin/subproductcats')->with('error','Something went wrong,Please try again'); 
          }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $product)
    {

            $product->delete();
            return redirect('/admin/products')->with('success','Bill successfully deleted');
        
        
        
    }

}
