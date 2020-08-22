<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use App\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function () {
    return view('home');
});
Route::get('/login', function ()
{
    return view('login');
});
Route::post('/checklogin', 'HomeController@checklogin');
Route::get('/register', function () {

      return view('register');
});
Route::post('home/registerdata', 'HomeController@saveregisterdata' );
Route::get('admin/login', function () {

    return view("admin.login");
});
Route::post('/admin/checklogin', 'adminController@checklogin');
Route::get('admin/createdars', function () {

    return view("admin.createdars");
});
Route::post('/admin/savelessondata', 'adminController@createlesson');
Route::group(['middleware' => 'checksessioncookies'], function() {
Route::post('/getpayedars','teacherController@getpayedars');
Route::get('/teacher/takedars','teacherController@takedars');
Route::post('/savedarsteacher','teacherController@savedarsteacher');
Route::get('/teacher/requestclass', 'teacherController@requestclass');
Route::post('/teacher/saveclass','teacherController@saveclass');
Route::post('/roommember','teacherController@teshstrero');
Route::any('/teacher/showclassdetail','teacherController@showclass');
Route::get('/student/showclass','studentController@showclassview');
Route::post('/sabtenam','studentController@sabtenam');
Route::post('/getclassinformation','studentController@getclassinformation');
Route::get('/student/sendteacher','studentController@demandteacher');
Route::post('/savestudentdemand','studentController@savestudentdemand');
Route::post('/getnamestudent','teacherController@getnamestudent');
Route::get('student/showmessage','studentController@showmessageforstudent');
Route::post('/getallstudentmessage','studentController@studentallmessage');
Route::get('/student/show/{teacherid}/{darsid}','studentController@showmessageteacher');
Route::post('/getclassinformation','studentController@getclassinformation');
Route::post('/getteacherdetail','studentController@teacherdetail');
Route::get('/teacher/listlesson','teacherController@listlessonmessage');
Route::Post('/studentlistmessage','teacherController@studentlistmessage');
Route::get('/logout','HomeController@logout');
Route::get('/teacher/showusermessage/{studentid}/{darsid}','teacherController@getstudentmessage');
Route::post('/replyteacher','teacherController@replyteacher');
Route::post('/sendemail','teacherController@send');
});

?>


