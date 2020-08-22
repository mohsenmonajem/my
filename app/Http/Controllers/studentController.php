<?php

namespace App\Http\Controllers;
use App\Message;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;
use Verta;
use App\Room;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;
use App\Lesson;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
class studentController extends Controller
{
    public function showclassview()
    {

        $paye = Lesson::all()->pluck('payenumber')->unique();
        return view( 'student.class' )->with( 'paye', $paye );
    }
    public function getclassinformation( Request $request ) {

        //this function getpaye and return the lesson for this paye
        $darsid = Lesson::all()->where('namedars',$request->input('dars'))->where('payenumber',$request->input('paye'))->pluck('id')->first();
        $getroomdetail=Lesson::find($darsid)->room()->get();
        $count=0;
        foreach ($getroomdetail as $value  ) {
            $startdate = explode('/', $request->input('startdate'));
            $enddate = explode('-', $value->startdate);
            if ($enddate[0] < $startdate[0]) {
                continue;
            }
            if ($enddate[0] == $startdate[0]) {
                if ($enddate[1] < $startdate[1]) {

                    continue;
                }
                if ($enddate[2] < $startdate[2]) {
                    continue;
                }
            }
            $classdetail[$count]=$value;
            $idteacher=Room::find($value->id)->teacher()->pluck('teacher_id')->first();
            $teacherdetail[$count]=Teacher::find($idteacher)->user()->first();
            $count++;
        }
        $msg=1;
        if ( $count == 0 ) {
            $msg = 0;
            $detailteacher = 0;
        }
        return response()->json( array( 'classdetail'=> $classdetail, 'teacherdetail'=>$teacherdetail ,'msg',$msg), 200 );
    }
         public function sabtenam( Request $request )
         {
            if(Room::find($request->input('roomid'))->student(Session::get('userid')))
            {
                return response()->json(array( 'msg'=> 0 ), 200);

            }
             $studentid=User::find(Session::get('userid'))->student()->pluck('id');
             Room::find($request->input('roomid'))->student()->attach($studentid);
             return response()->json(array( 'msg'=> Session::get('userid') ), 200);
         }
         public function demandteacher()
         {
             $paye=Lesson::all()->pluck('payenumber')->unique();
             return view( 'student.demandteacher' )->with( 'data', $paye );
         }
        public function  teacherdetail(Request $request)
        {
            $lesson=Lesson::all()->where('payenumber',$request->input('paye'))->where('namedars',$request->input('dars'))->first();
            $teachersid=$lesson->teacher()->pluck('user_id')->unique();
            $teacherdetail=User::whereIn('id',$teachersid)->get();
            return response()->json(array( 'msg'=> $teacherdetail,'iddars'=>$lesson->id), 200);
        }
        public function savestudentdemand(Request $request)
        {
            $savedemand = new Message;
            $teacherid=User::find($request->input('teacheruserid'))->teacher()->pluck('id')->first();
            $savedemand->teacher_id=$teacherid;
            $studentid=User::find(Session::get('userid'))->student()->pluck('id')->first();
            $savedemand->student_id=$studentid;
            $savedemand->messagestudent=$request->input('text');
            $savedemand->dateteacher=null;
            $ldate[0] = date('Y');
            $ldate[1] = date('m');
            $ldate[2] = date('d');
            $shamsi=Verta::getJalali($ldate[0],$ldate[1],$ldate[2]);
            $ldate =new verta();
            $ldate->addHours(5);
            $savedemand->datestudent=collect($shamsi)->implode('-');
            $savedemand->timestudent=$ldate->formatTime();
            $savedemand->studentread=false;
            $savedemand->teacherread=false;
            $savedemand->lesson_id=$request->input("darsid");
            $savedemand->save();
            return response()->json( array( 'msg'=> 1 ), 200 );
        }
    public function showmessageforstudent()
    {
         $studentid=User::find(Session::get('userid'))->student()->pluck('id')->first();
         $darsid=Message::all()->where('student_id',$studentid)->pluck('lesson_id');
         $lessonname=Lesson::all()->whereIn('id',$darsid);
          return view('student.showmessage')->with('dars',$lessonname);
    }
    public function studentallmessage(Request $request)
    {
        $studentid=User::find(Session::get('userid'))->student()->pluck('id')->first();
        $teachersid=Message::all()->where('student_id',$studentid)->where('lesson_id',$request->input('darsid'))->pluck('teacher_id')->unique();
        if(count($teachersid)==0)
            return response()->json( array( 'numbermessage'=> -1 ), 200 );
        $count=0;
        foreach ($teachersid as $element)
        {
            $teacherdetail[$count]=Teacher::find($element)->user()->first();
            $numbernotreadmessage[$count]=Message::all()->where('student_id',$studentid)->where('teacher_id',$element)->whereNotNull('replyteacher')->where('studentread',false)->where('lesson_id',$request->input('darsid'))->count();
            $count++;
        }
        return response()->json( array( 'numbermessage'=> $numbernotreadmessage,'teacherdetail' => $teacherdetail ), 200 );
    }
    public function showmessageteacher($teacheruserid,$darsid)
    {
        $teacheruserid=str_replace('{', ' ', $teacheruserid);
        $teacheruserid=str_replace('}', ' ', $teacheruserid);
        $darsid=str_replace('{', ' ', $darsid);
        $darsid=str_replace('}', ' ', $darsid);
        $studentid=User::find(Session::get('userid'))->student()->pluck('id')->first();
        $teacherid=User::find($teacheruserid)->teacher()->pluck('id')->first();

        $message=Message::all()->where('student_id',$studentid)->where('teacher_id',$teacherid);
        foreach($message as $element)
        {
            Message::whereid($element->id)->update(
                [
                    'studentread' => true,
                ]
            );
        }
        return view ('student.showmessageteacher')->with('message',$message);
    }
}
