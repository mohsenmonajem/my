<?php

namespace App\Http\Controllers;
use App\Lesson;
use App\Message;
use App\Student;
use App\Teacher;
use App\User;
use App\Room;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Notification;
use App\Notifications\sendemail;
use Illuminate\Support\Facades\Session;
class    teacherController extends Controller
{

    public function takedars()
    {
        $paye = Lesson::all()->pluck('payenumber')->unique();
        return view('teacher.takedars')->with('data', $paye);
    }
    public function getpayedars(Request $request)
    {
        $msg = Lesson::all()->where('payenumber', $request->input('paye'))->pluck('namedars')->unique();
        return response()->json(array( 'msg'=> $msg ), 200);
    }
    public function savedarsteacher( Request $request )
    {
        $lesson = Lesson::all()->where('payenumber', $request->input('paye'))->where('namedars',$request->input('dars'))->first();
        $teacherid=Teacher::all()->where('user_id',$request->input('userid'))->pluck('id')->first();
        $lesson->teacher()->attach($teacherid);
        $msg1='با موفقیت ذخیره شد';
        return response()->json( array( 'msg'=> $msg1 ), 200 );
    }
    public function requestclass() {
        $teacherid=User::find(Session::get('userid'))->teacher()->pluck('id')->first();
        $lesson=Teacher::find($teacherid)->lesson()->get()->unique();
        return view( 'teacher.getclassdata' )->with( 'lessondetail', $lesson );
    }
    public function saveclass( Request $request ) {
        $startdate = explode( '/', $request->input( 'startdate' ) );
        $enddate = explode( '/', $request->input( 'enddate' ) );
        $rules = [
            'startdate'=> 'required|date',
            'enddate'=> 'required|date',
            'address'=> 'required',
            'dars'=> 'required',
            'cost'=> 'required|numeric|min:0',
            'capacity' => 'required|numeric|min:0:',

        ];
        $customMessages = [
            'capacity.required' =>'ظرفیت نمی تواند خالی باشد',
            'capacity.numeric' =>'ظرفیت نمی تواند کم تر از یک نفر باشد',
            ' cost.numeric' =>'هزینه نمی تواند 0 یا کم تر از ان باشدو',
            'startdate.required' =>' تاریخ شروع کلاس را وارد کنید',
            'enddate.required' =>'تاریخ   پایان کلاس را وارد کنید',
            'dars.required' => ' درسی برای انتخاب وارد نشده است',
            'address.required' => ' ادرس کلاس را وارد کنید',
            'cost.required' => 'هزینه کلاس را وارد نکردید',
            'start.date' =>'تاریخ  معتبر را وارد کنید ',
            'end.date' =>'تاریخ معتبر را وارد کنید',
        ];
        $this->validate($request, $rules, $customMessages);
        if ( $enddate[0]<$startdate[0] ) {

            return back()->withInput();
        }
        if ( $enddate[0] == $startdate[0] ) {
            if ( $enddate[1]<$startdate[1] ) {
                return back()->withInput();

            }
            if ( $enddate[2]<$startdate[2] ) {
                return back()->withInput();
            }
        }
        $this->validate( $request, $rules, $customMessages );
        $teacherid=User::find(Session::get('userid'))->teacher()->pluck('id')->first();
        $lessonid=$request->input('dars');
        $room=new Room();
        $room->address = $request->input( 'address' );
        $room->capacity = $request->input( 'capacity' );
        $room->cost = $request->input( 'cost' );
        $room->startdate = $request->input( 'startdate' );
        $room->enddate = $request->input( 'enddate' );
        $room->save();
        $room->lesson()->attach($lessonid);
        $room->teacher()->attach($teacherid);
        return view( 'teacher.home' );
    }
    public function  showclass()
    {
        $teacherid=User::find(Session::get('userid'))->teacher()->pluck('id')->first();
        $classdetail=Teacher::find($teacherid)->room()->get();
        return view( 'teacher.classdetail' )->with( 'classdetail', $classdetail );
    }
    public  function  teshstrero( Request $request ) {
        $classdetail=Room::find($request->input('roomid'))->first();
        $studentsid=Room::find($request->input('roomid'))->student()->pluck('id');
        $studentduserid=Student::all()->whereIn('id',$studentsid)->pluck('user_id');
        $studentsdetail=User::all()->whereIn('id',$studentduserid);
        $lessondetail=Room::find($request->input('roomid'))->lesson()->first();
        return response()->json( array( 'classdetail'=> $classdetail,'studentsdetail'=>$studentsdetail ,'lessondetail'=>$lessondetail), 200 );
    }
    public function  send(Request $request)
    {
        $classdetail=Room::find($request->input('roomid'))->first();
        $studentsid=Room::find($request->input('roomid'))->student()->pluck('id');
        $studentduserid=Student::all()->whereIn('id',$studentsid)->pluck('user_id');
        $studentsdetail=User::all()->whereIn('id',$studentduserid);
        $teacherdetail=User::find(Session::get('userid'));
        $details = [

            'greeting' => $teacherdetail->name.''.$teacherdetail->family,
            'body' =>$request->input('text'),
        ];
        Notification::send($studentsdetail, new sendemail($details));
    }
    public function listlessonmessage()
    {
      $teacherid=User::find(Session::get('userid'))->teacher()->pluck('id')->first();
      $lessonsid=Teacher::find($teacherid)->lesson()->pluck('lesson_id');
      $lessonteacher=Lesson::all()->whereIn('id',$lessonsid);
        return view('teacher.showmessage')->with('darsdetail',$lessonteacher);
    }
    public function studentlistmessage(Request $request)
    {
        $teacherid=User::find(Session::get('userid'))->teacher()->pluck('id')->first();
        $studentsid=Message::all()->where('lesson_id',$request->input('darsid'))->where('teacher_id',$teacherid)->pluck('student_id')->unique();
         if(count($studentsid)==0)
          return response()->json( array( 'msg'=> 0), 200 );
        $count=0;
        foreach( $studentsid  as $element)
        {
            $studentdetail[$count]=Student::find($element)->user()->first();
            $numbernotreadmessage[$count]= Message::all()->where('teacher_id',$teacherid)->where('student_id',$element)->where('teacherread',false)->count();
            $count++;
        }
        return response()->json( array('userdetail'=> $studentdetail,'numbermessage'=>$numbernotreadmessage,'darsid'=>$request->input('darsid')), 200 );
    }
    public function getstudentmessage($studentid,$darsid)
    {
        $studentid=str_replace('{', ' ', $studentid);
        $studentid=str_replace('}', ' ', $studentid);
        $darsid=str_replace('{', ' ', $darsid);
        $darsid=str_replace('}', ' ', $darsid);
        $teacherid=User::find(Session::get('userid'))->teacher()->pluck('id')->first();
        $message=Message::whereteacher_id($teacherid)->where('lesson_id',$darsid)->where('student_id',$studentid)->get();
        foreach ($message as $element)
        {
           $message2= Message::find($element->id);
           $message2->teacherread=true;
           $message2->save();
        }
        return view('teacher.showstudentmessage')->with('message',$message);
    }
    public function replyteacher(Request $request)
    {
        $id=$request->input('textid');
        $replyteacher=$request->input('replytext');
        $ldate[0] = date('Y');
        $ldate[1] = date('m');
        $ldate[2] = date('d');
        $shamsi=Verta::getJalali($ldate[0],$ldate[1],$ldate[2]);
        $ldate =new verta();
        $ldate->addHours(5);
        $text=  Message::find($id)->replteacher;
            if(isset(  Message::find($id)->replyteacher)==true)
            {
                return response()->json(array('msg' => 0), 200);
            }
            $message= Message::find($id);
         $message->dateteacher=collect($shamsi)->implode('-');
         $message->timeteacher=$ldate->formatTime();
         $message->replyteacher=$replyteacher;
        $message->save();
        return response()->json( array( 'msg'=> 1), 200 );
    }

}
