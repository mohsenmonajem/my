<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Student;
use Illuminate\Support\Str;
use App\Teacher;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class HomeController extends Controller {
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Login username to be used by the controller.
     *
     * @var string
     */
     protected $username;
     public function saveregisterdata(Request $request)
     {
        $rules = [
            'email' => 'email|unique:users',
            'family' => 'min:3',
            'role'  =>'required',
            'username'=> 'required|unique:users',
        ];
        $customMessages = [
             'email' =>'ایمیل معتبر وارد کنید',
            'email.unique' =>"ایمیل تکراری ",
            'family.min' =>'طول فامیل باید بیش از 3 باشد',
            'role.required'  =>'عنوان خود را وارد نکردید',
            'username.unique' =>"قبلا این نام کاربری وارد شده است ",
           ];
           $this->validate($request, $rules, $customMessages);
           $userdata= new  User ([
            'name' => $request["name"],
            'family' =>$request["family"],
            'username' => $request["username"],
            'password' => Hash::make($request["password"]),
            'email' => $request["email"],
            'role' => $request["role"],
            'image' => $request["image"],
             'remember_token'=>Str::random(30),
            ]);
            $userdata->save();
            if($request["role"]=="student")
               {
                   $studentdata=new Student ([
                                   'user_id'=>$userdata->id,
                    ]);
                    $studentdata->save();
               }
               if($request["role"]=="teacher")
               {
                   $teacherdata=new Teacher ([
                                   'user_id'=>$userdata->id,
                    ]);
                    $teacherdata->save();
               }
               session(['userid' => $userdata->id]);
                   Cookie::queue('userid', $userdata->id, 10000000);
                  if($request["role"]=="student")
                    return view("student.home");
                  else
                    return view("teacher.home");
     }
    public function  checklogin(Request $request)
    {

        if(Auth::attempt(['username'=>$request->input('username'),'password'=>$request->input('password')]))
        {
            $remember=$request->input('_token');
           if(!empty($remember))
           {
               Auth::login(Auth::user(), true);
               $request->session()->put('userid', Auth::user()->id);
               Cookie::queue('userid', Auth::user()->id, 10000000);
               if (Auth::user()->role == "student")
                   return view("student.home");
               if (Auth::user()->role == "teacher")
                   return view("teacher.home");
           }
        }
        $userpassword = User::whereusername($request->input('username'))->pluck('password')->first();
        if ($userpassword == $request->input('password')) {
          //   $this->username= User::whereusername($request->input('username'))->first();
             $userdetail = User::whereusername($request->input('username'))->first();
             $request->session()->put('userid', $userdetail->id);
             Cookie::queue('userid', $userdetail->id, 10000000);
             if ($userdetail["role"] == "student")
                 return view("student.home");
             if ($userdetail["role"] == "teacher")
                 return view("teacher.home");
         }

         if ($userpassword == null)
         {
            $request->session()->put('error', 'نام کاربری اشتباه وارد کرده اید');
            return back()->withInput();
         }
         else
         {
            $request->session()->put('error', 'رمز اشتباه وارد کرده اید');
             return back()->withInput();
         }
    }
    public function logout()
    {
        if(Cookie::has('userid')||Session::has('userid'))
        {
            setcookie('userid', false);
            Session::flush('userid');
            return redirect('/');
        }
    }
}
