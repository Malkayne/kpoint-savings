<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Productcats;
use Illuminate\Http\Request;

class ProductcatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productCats = Productcats::all();
        return view('adminend.productCat.show',['productCats'=>$productCats]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $creator = Productcats::Create($request->all());
        if($creator){
            return redirect('admin/productcats')->with('success','Bill Category successfully added');
        }else{
            return redirect('admin/productcats')->with('error','Something went wrong,Please try again'); 
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Productcats  $productcats
     * @return \Illuminate\Http\Response
     */
    public function show(Productcats $productcats)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Productcats  $productcats
     * @return \Illuminate\Http\Response
     */
    public function edit(Productcats $productcat)
    {
        return view('adminend.productCat.edit',['productCat'=>$productcat]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Productcats  $productcats
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Productcats $productcat)
    {
        $updater = $productcat->update($request->all());
        if($updater){
          return redirect('/admin/productcats')->with('success','Bill Category successfully updated');
        }else{
            return redirect('admin/productcats')->with('error','Something went wrong,Please try again'); 
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Productcats  $productcats
     * @return \Illuminate\Http\Response
     */
    public function destroy(Productcats $productcat)
    {
        $deleter = $productcat->delete();
        if($deleter){
            return redirect('/admin/productcats')->with('success','Product/Service Category successfully deleted');
        }else{
            return redirect('admin/productcats')->with('error','Something went wrong,Please try again');
        }
        
    }
}
