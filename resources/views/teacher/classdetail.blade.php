<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }} fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Laravel</title>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Laravel</title>
    <!-- Fonts -->
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <script src= "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Styles -->

    <script type="text/javascript">

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
    <script >
        $(document).ready(function() {
        });
            function sendidclass(id) {
                $("#content").empty();
                $("#roomdetail").empty();
                var textarea='<textarea style="direction: rtl" class="form-control" row="2"  id="send'+id.value+'"></textarea>';
                var text='ارسال پیام';
                var button='<button style="margin-left:70%" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off" onclick="sendemail(this)"'+' value="'+id.value+'">'+text+'</button>';
                var content = $(textarea+button);
                content.appendTo('#content');
                $.ajax({
                    url: '/roommember',
                    type: 'POST',
                    data: {_token: '{{ csrf_token() }}', roomid: id.value},

                    success: function (data) {
                        console.log(data);
                        var dars= ' <p style="text-align: right"><span>نام درس:</span>'+data["lessondetail"].namedars+'</p>';
                        var paye= '<p style="text-align: right"><span>نام پایه:</span>'+data["lessondetail"].payenumber+'</p>';
                        var startdate='<p style="text-align: right"><span>تاریخ شروع:</span>'+data["classdetail"].startdate +'</p>';
                        var enddate='<p style="text-align: right"><span>تاریخ پایان:</span>'+data["classdetail"].enddate+'</p>';
                        var  capacity='<p style="text-align: right"><span>ظرفیت کلاس:</span>'+data["classdetail"].capacity +'</p>';
                        var  address='<p style="text-align: right"><span>ادرس:</span>'+data["classdetail"].address +'</p>';
                        var cost='<p style="text-align: right"><span>قیمت:</span>'+data["classdetail"].cost +'</p>';

                        var table='<table style="font-size: 65%" class="table"> <thead> <tr>   <th scope="col">نام</th> <th scope="col">نام خانوادگی</th> </tr> </thead><tbody>';
                        var contents=new Array();
                        for(var i=0;i<data["studentsdetail"].length;i++)
                        {
                           contents[i]= '<tr>  <td>'+data["studentsdetail"][i].name+'</td><td>'+data["studentsdetail"][i].family+'</td><th scope="row">'+(i+1)+'</th> </tr>';
                        }
                        var roomdetail=$(dars+paye+startdate+enddate+capacity+address+cost+table+contents+'</tbody></table>');
                        roomdetail.appendTo("#roomdetail");
                    },
                    error: function () {
                        alert('error');
                    },
                });
            }


    </script>
    <script type="text/javascript">
        $(document).ready(function() {
        });
        function sendemail(id) {
            var text='send'+id.value;
            text=document.getElementById(text).value;
            $.ajax({
                url: '/sendemail',
                type: 'POST',
                data: {_token: '{{ csrf_token() }}', text: text,roomid: id.value},
                success: function (data) {



                },
                error: function () {
                    alert('error');
                },
            });
        }


    </script>
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
</head>
<body style="height: 100%!important;">
<div class="container" style="height: 100%!important;">
    <div class="row" style="height: 100%!important;">
          <div class="col-9 full-height" style="background: #e0e0d2;" >
              <ul>
                  <li><a  href="/teacher/takedars">ثبت درس</a></li>
                  <li ><a  href="/teacher/requestclass">ثبت کلاس</a></li>
                  <li ><a  href="/teacher/showclassdetail">مشاهده وضعیت کلاس </a></li>
                  <li><a  href="/teacher/listlesson"> پیام ها</a></li>
                  <li><a  href="/logout"> خروج </a></li>
              </ul>
              <div id="content" style="margin-top: 5%;"></div>
              <div id="roomdetail" style="direction: rtl!important;color: gray;background:#e6e6e6;">
              </div>
          </div>
        <div class="col-1">
        </div>
        <div class="col-2 full-height" style="background:   #e6e6e6;">
            @php
                $count=1;
            @endphp
            <ul class="nav flex-column" style="background: #28a745;text-align: center">
                @foreach($classdetail as $variable)
                    <li class="nav-item "  style="text-align: right;">
                        <button type="button;"  style="text-align: center!important;" class="btn btn-success  nav-link " onclick="sendidclass(this)" value="{{$variable->id}}">کلاس{{$count}}</button>
                        @php
                            $count++;
                        @endphp
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
</body>

</html>
