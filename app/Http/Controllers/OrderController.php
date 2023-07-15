<?php

namespace App\Http\Controllers;

use App\Mail\UserWelcomeEmail;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data  = order::all();
        return response()->view('orders.indexOrder' , ['orders' => $data ]);



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('orders.createOrder');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //    dd($request->all());
        //
        $request->validate([
            'title' => 'required|string|max:30',
            'message' => 'required|string|min:5|max:20',
            'student_university_id' => 'required|max:20',
            'urgent' => 'nullable|string',
            'student_email' => 'required|email|unique:orders',
            'order' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png|max:1024',

            ]);

            $order = new order();
            $order->title = $request->input('title');
            $order->message = $request->input('message');
            $order->order = $request->input('order');
            $order->student_university_id = $request->input('student_university_id');
            $order->student_name = $request->input('student_name');
            $order->student_email = $request->input('student_email');
            $order->urgent = $request->has('urgent');
            if($request->hasFile('image'))
                {
                    $orderImage = $request->file('image');
                    $imageName = time() . '_image_' . $order->title . '.' . $orderImage->getClientOriginalExtension();
                    $orderImage->storePubliclyAs('orders' , $imageName , ['disk' =>'public']);
                    $order->image = 'orders/' . $imageName;
                }
            $save = $order->save();
            if($save){
                Mail::to($request->user())->send(new UserWelcomeEmail($order));
            }
            return   redirect('/orders');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(order $order)
    {
        //


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        //
        $deleted = $order->delete();
        if ($deleted) {
          if($order->image){
            Storage::delete($order->image);
        }}
        return redirect()->back();
}

}
