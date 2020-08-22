<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class adminController extends Controller
{
    public function checklogin(Request $request)
    {
        $rules = [
            'password' => 'required',
        ];
        $customMessages = [
            'password.required' => 'وارد کردن پسورد اجباری است',

        ];
            $this->validate($request, $rules, $customMessages);
            $password = DB::table('admin')->pluck('password')->first();
            if($password==$request->input('password'))
            {
                return view('admin.home');
            }
            else
                {
                    $request->session()->put('error', 'رمز اشتباه وارد کرده اید');
                    return back()->withInput();

                }
    }
    public function createlesson(Request $request)
    {
        $payenumber=$request->input('payenumber');
        $namelesson=$request->input('namedars');
        $check=DB::table('lessons')->where('payenumber',$payenumber)->where('namedars',$namelesson)->first();
        if ($check==null) {
            $lessondata= new  Lesson ([
                'payenumber' => $payenumber,
                'namedars' =>$namelesson,
                ]);
            $lessondata->save();
            $request->session()->put('nonrepeat', 'درس جدید وارد شده است');
            return back()->withInput();
        }
        else
        {

            $request->session()->put('repeat', 'درس تکراری وارد شده است');
            return back()->withInput();
        }

    }


}
