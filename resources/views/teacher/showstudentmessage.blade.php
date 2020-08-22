<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }} fa" dir="rtl" style="height: 100%!important;">
<meta charset="utf-8">
<meta name="_token" content="{{ csrf_token() }}">
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<title style="color: red">monajemking</title>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src= "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="{{ asset('js-persian-cal.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('js-persian-cal.css') }}">
<style>
    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #333333;
    }

    li {
        float: right;
        margin-right: 5%;
    }

    li a {
        display: block;
        color: white;
        text-align: center;
        padding: 16px;
        text-decoration: none;
    }

    li a:hover {
        background-color: #111111;
    }
    html, body {
        height: 100%;
    }

    .full-height {
        height: 100%;
    }

</style>
     <script>
               $(document).ready(function() {
                 $.ajaxSetup({
             headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
            });
          $(".message").click(function() {
              $("#reply").empty();
              window.stop();
              var textid=$(this).attr("value");
              console.log();
              var text1='<div style="margin-top: 10%!important;background: darkgrey ">'+'<p style="padding-top: 5%;padding-right: 5%">'+$("#message"+textid).text()+'</p>'+' <div class="col"> <input type="text" class="form-control"  id="messages"><input type="button"  class="btn btn-primary btn-sm"  value="ارسال"></div></div>';
              var divBtn = $(text1);
              divBtn.appendTo('#reply');
             $("input:button").click(function() {
                 $.ajax({
                 url: '/replyteacher',
                 type: 'POST',
                 data: { _token: '{{ csrf_token() }}',textid:textid,replytext:$("#messages").val()},
                   success:function(data){
                                       if(data["msg"]==0)
                                        {
                                          $("#reply").empty();
                                          var text1='<div>قبلا به این پیام پاسخ داده شده است </div>';
                                          var divBtn = $(text1);
                                          divBtn.appendTo('#reply');
                                        }
                                        else
                                        {
                                          var text1='<div>  پاسخ ثبت شد</div>';
                                          var divBtn = $(text1);
                                          divBtn.appendTo('#reply');
                                        }
                                       },
                 error: function ()
                 {
                     alert('error');
                 },
               });
              });
           });
    });
</script>
<body style="height: 100%!important;margin-right: 20%!important;">
<div class="container" style="height: 100%!important;">
    <div class="row" style="height: 100%!important;">
        <div class="col-9 full-height" style="background: #e6e6e6;text-align: right!important;" >
            <ul>
                <li><a  href="/teacher/takedars">ثبت درس</a></li>
                <li ><a  href="/teacher/requestclass">ثبت کلاس</a></li>
                <li ><a  href="/teacher/showclassdetail">مشاهده وضعیت کلاس </a></li>
                <li><a  href="/teacher/listlesson"> پیام ها</a></li>
                <li><a  href="/logout"> خروج </a></li>
            </ul>
                 @foreach($message  as $element)
                  <div value="{{$element->id}}" class="message" style="background:white;direction: rtl!important;padding-top: 3%;margin-right: 10%;padding-right: 5%;margin-left: 5%">
                        <p id="message{{$element->id}}" >{{$element->messagestudent}}</p>
                        <span>ساعت:{{$element->datestudent}}</span><span style="padding-right: 20%">تاریخ:{{$element->timestudent}}</span>
                  </div>
                @endforeach
            <div id="reply"></div>
           </div>
    </div>
</div>
</body>
</html>
