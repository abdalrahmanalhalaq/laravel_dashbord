<?php

namespace App\Http\Controllers;

use App\Mail\AdminWelcomeEmail;
use App\Mail\UserWelcomeEmail;
use App\Models\Admin;


use Illuminate\Console\View\Components\Alert;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data  = Admin::all();
        return response()->view('admins.adminsControls' , ['Admin' => $data ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if( auth('admin')->user()->administrator == 'Yes')
        {
            return response()->view('admins.addAdmin');
        }
        else
        {

            return response()->view('admins.notAdministrator');
        }

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
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:40',
            'email' => 'required|string|email |unique:Admins,email',
            'image' => 'nullable|image|mimes:jpg,png|max:1024',
            'password' => ['required','string',
                        Password::min(7)
                        ->letters()
                       ->numbers()
                       ->symbols()
                       ->mixedCase()
                       ->uncompromised()
                       ]
            ]);

            $admin = new Admin();
            $admin->name = $request->input('name');
            $password2 = $request->input('password');
            $admin->password = Hash::make($request->input('password'));
            $admin->email = $request->input('email');
            $admin->administrator = $request->input('administrator');
            if($request->hasFile('image'))
            {
                $adminImage = $request->file('image'); // جبنا الملف الخاص بملف الصورة
                $imageName = time() . '_image_' . $admin->title . '.' . $adminImage->getClientOriginalExtension(); //اسم لملف الصورة
                $adminImage->storePubliclyAs('admins' , $imageName , ['disk' =>'public']); // نقلنا الصورة داخل مجلد اسمه ادمنز داخل الستورج
                $admin->image = 'admins/' . $imageName; // عشان يخزنلي الصورة في الداتا بيز بنعطيه بيانات الصورة وين موجودة واسمها
            }
            $save = $admin->save();



        if($save)
        {
            Mail::to($request->user())->send(new AdminWelcomeEmail($admin));

        }

            return   redirect('/admins');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data= Admin::findOrFail($id);
        return response()->view('admins.updateAdmin' ,['Admin' => $data ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
                //
    //    dd($request->all());
       $request->validate([
        'email' => 'required|string|email|unique:admins,email,'. $id,

        # . $id => مشان لما يدخل نفس الايميل بغرض التعديل يبحث عن تطابق الاي دي مع الايميل
        'password' => ['nullable','string',
        Password::min(7)->letters()
        ->numbers()
        ->symbols()
        ->mixedCase()
        ->uncompromised()

        ]
        ]);
                // findOrFail($id) => عشان لو العنصر مش موجود يظهر واجهة 404
        $admin = Admin::findOrFail($id);
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        if ($request->has('password')) {
            $admin->password = $request->input('password');
            // لو موجود في الريكوست اللي معدل عليه باسورد عدل عليه لو ما فيه ما تعمل شي -> يعني خليك على القيمة الاخيرة ب
        }





        if($request->hasFile('image'))
        {



            Storage::delete($admin->image);


            $adminImage = $request->file('image'); // جبنا الملف الخاص بملف الصورة
            $imageName = time() . '_image_' . $admin->title . '.' . $adminImage->getClientOriginalExtension(); //اسم لملف الصورة
            $adminImage->storePubliclyAs('admins' , $imageName , ['disk' =>'public']); // نقلنا الصورة داخل مجلد اسمه ادمنز داخل الستورج
            $admin->image = 'admins/' . $imageName; // عشان يخزنلي الصورة في الداتا بيز بنعطيه بيانات الصورة وين موجودة واسمها
        }





        $save = $admin->save();
        if($save){
            Mail::to($request->user())->send(new AdminWelcomeEmail($admin));
        }
        return   redirect('admins');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // $delete = Admin::destroy($id);
        // $deleted = $admin->delete();
        // if ($deleted) {
        //   if($admin->image){
        //     Storage::delete($admin->image);
        //  }}


        return redirect()->back();
    }
}
