<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('profiles.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {
        $this->validate($request, [
            'first_name'  => 'max:255',
            'last_name'   => 'max:255',
            'designation' => 'max:255',
            'website'     => "url",
            'phone'       => 'regex:/(01)[0-9]{9}/',
            'bio'         => 'min:3|max:1000',
        ],[
            'max'      => 'يجب أن لا يزيد النص عن 255 حرف',
        ]);
        Profile::where('user_id', $user_id)
            ->update([
                'first_name'  => $request->first_name,
                'last_name'   => $request->last_name,
                'designation' => $request->designation,
                'website'     => $request->website,
                'phone'       => $request->phone,
                'address'     => $request->address,
                'bio'         => $request->bio,
            ]);
            session()->flash('Update', 'تم تعديل الملف الشخصي');
            return redirect()->back();
    }
        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function infoUpdate(Request $request, $id)
    {
        $this->validate($request,
        [
            'name'  => 'required|max:255',
            'email' => 'required|unique:users|email',
        ],[
            'required' => 'يرجى ادخال اسم المستخدم',
            'max'      => 'يجب أن لا يزيد اسم المستخدم عن 255 حرف',
            'unique'   => 'الايميل مسجل مسبقاً'
        ]);
        User::where('id', $id)
            ->update([
                'name'  => $request->name,
                'email' => $request->email,
            ]);
        session()->flash('Update', 'تم تعديل المعلومات الشخصية');
        return redirect()->back();
    }
        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function passUpdate(Request $request, $id){

        $this->validate($request, [
            'password'  => 'required|confirmed|min:6',
        ],[
            'required'  => 'يرجى ادخال كلمة المرور الجديدة',
            'min'       => 'يجب أن لا تقل كلمة المرور عن 6 احرف',
            'confirmed' => 'كلمتا المرور غير متطابقتان'
        ]);
        $user = User::find($id);
        if (Hash::check($request->currentPass, $user->password)) {
            User::where('id', $id)
                ->update([
                    'password' => Hash::make($request->password),
                ]);
                session()->flash('Update', 'تم تحديث كلمة المرور');
                return redirect()->back();
        }else{
            session()->flash('Error', 'كلمة المرور الحالية غير صحيحة');
            return redirect()->back();
        }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
