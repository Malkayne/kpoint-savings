<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contacts = Contact::all();
      return view('adminend.contact',['contacts'=> $contacts,'title'=>'contacts']);

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
        //
        // Contact::create([
        //   request()->validate([
        //        'name'=> 'required',
        //        'email' => 'required',
        //        'phone_number' => 'required',
        //        'subject' => 'required',
        //        'message' => 'required'
        //      ])
        // ]);


     //  $validator = $request->validate([
     //           'name'=> 'required',
     //           'email' => 'required',
     //           'phone_number' => 'required',
     //           'subject' => 'required',
     //           'message' => 'required'
     //         ]);
     //
     // if($validator->fails()){
     //   redirect()->back()->withErrors($validator)->withInput();
     // }

         $validator = Validator::make($request->all(), [
                     'name'=> 'required',
                     'email' => 'required',
                     'phone_number' => 'required',
                     'subject' => 'required',
                     'message' => 'required'
    ]);

        if($validator->fails()) {
            return redirect('/contact#contactForm')->withErrors($validator)->withInput()->with('error',"Something went wrong,please try again");
        } else {
            // return
            Contact::create(request()->all());
            return redirect('/contact#contactForm')->with('success',"Message successfully sent,we would get back to you soon");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
