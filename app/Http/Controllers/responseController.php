<?php

namespace App\Http\Controllers;

use App\Mail\AdminWelcomeEmail;
use App\Mail\UserWelcomeEmail;
use App\Models\Admin;
use App\Models\order;
use Database\Seeders\OrderSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class responseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function edit( $id)
    {
        //
        $order = order::find($id);
        return response()->view('admins.respons' , ['order' => $order]);


    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $order = order::findOrFail($id);

        if($order->response == ""){
            $order->response = $request->input('Response');
            $saved = $order->save();
        }
        if($order->response == ""){
            return 'Add Status';
        }
        else{
            $order->response = $request->input('Response');
            $order->status = $request->input('status');
            $saved = $order->save();
        }
        //

        if($order->status == "closed"){
            $order->closed_date  = now();
            $saved = $order->save();
        }

        if($saved){
            Mail::to($request->user())->send(new UserWelcomeEmail($order));
        }




        return redirect()->route('orders.index');





    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        //

}

}
