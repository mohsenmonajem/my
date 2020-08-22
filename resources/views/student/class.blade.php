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
    <script src="{{ asset('js-persian-cal.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('js-persian-cal.css') }}">

     <script type="text/javascript">
         var payedars=0;
         $(document).ready(function() {
                $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
        });
          $("input:radio").change(function() {
              payedars=$(this).val();
              var  count=0;
              $.ajax({
                url: '/getpayedars',
                type: 'POST',
                data: { _token: '{{ csrf_token() }}',paye:$(this).val()},
                success:function(data) {
                    for (var i = 0; i < data["msg"].length; i++) {
                        var poem = data["msg"][i];
                        var text1 = '<spand>' + poem + '</spand><input type="radio" name="dars"' + 'value=' + poem + ' />' + '<br/>'
                        var radioBtn = $('<div style="text-align: right;margin-right: 5%;margin-top: 2%">' + text1 + '</div>');
                        radioBtn.appendTo('#content');
                        count++;
                             }
                    var text2 = '<input type="button"   class="btn btn-primary" id="rr" value="انتخاب" onclick="msg()" >';
                    var radioBtn2 = $('<div style="text-align: right;margin-right: 5%;margin-top: 3%">' + text2 + '</div>');
                    radioBtn2.appendTo('#content');
                    $("#pcal1").toggle(true);
                    var objCal1 = new AMIB.persianCalendar('pcal1',
                        {extraInputID: "extra", extraInputFormat: "YYYYMMDD"}
                    );
                                    },
                error: function ()
                {
                    alert('error');
                },
            });
           });
    });

</script>

         <script>
                   function msg()
                   {
                       $("#mytable").empty();
                       window.stop();
                      var getradio=document.getElementsByName('dars');
                      var checking=false;
                      var  text;
                      for(var i=0;i<getradio.length;i++)
                      {
                             if(getradio[i].checked==true)
                               {
                                 checking=true;
                                 text=getradio[i].value;
                               }
                      }
                       var checkdate=$("input:text");
                       if(checkdate[0].value.length==0)
                          checking=false;
                      if(checking==true)
                      {
                            $.ajaxSetup({

                                        headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                 });
                  $.ajax({
                   url: '/getclassinformation',
                   type: 'POST',
                   data: { _token: '{{ csrf_token() }}',dars:text,startclass:checkdate[0].value,paye:payedars},
                                            success:function(data)
                                            {
                                                if(data["msg"]==0)
                                                   alert('درسی موجود نیست');
                                                else
                                                {
                                                    var content = '<table  class="table table-bordered" style="background: aliceblue;margin-top: 3%" id="myTable"><thead><tr><th scope="col">#</th><th  scope="col">نام</th><th  scope="col">نام خانوادگی</th><th  scope="col"> ظرفیت</th><th  scope="col">  تاریخ شروع</th><th  scope="col">  تاریخ پایان</th><th  scope="col">  قیمت</th><th  scope="col"> ادرس</th><th  scope="col">  ثبت نام</th></tr></thead><tbody>';
                                                    var text="";
                                                    for (var i = 0; i < data["teacherdetail"].length; i++)
                                                    {
                                                        var start='<tr><th scope="row">'+(i+1)+'</th>';
                                                        var name = '<td>' + data["teacherdetail"][i].name + '</td>';
                                                        var family = '<td>' + data["teacherdetail"][i].family + '</td>';
                                                        var capacity = '<td>' + data["classdetail"][i].capacity + '</td>';
                                                        var startdate = '<td>' + data["classdetail"][i].startdate + '</td>';
                                                        var enddate = '<td>' + data["classdetail"][i].enddate + '</td>';
                                                        var cost = '<td>' + data["classdetail"][i].cost + '</td>';
                                                        var address = '<td>' + data["classdetail"][i].address + '</td>';
                                                        var input1 = '<td><button class="btn btn-primary data"  style="font-size: 70%" onclick="sabtenam(this)" value="' + data["classdetail"][i].id +'" > register </button></td>';
                                                        text = start+name+family+capacity+startdate+enddate+cost+address+input1+'<tr>'+text;
                                                        console.log(text);
                                                    }
                                                    var element= $(content+text+'</tbody></table>');
                                                    element.appendTo("#mytable");
                                                }
                                            },
                    error: function ()
                    {
                      alert('error');
                    },
                     });
                   }
                 else
                      {
                              alert(' لطفا درسی را انتخاب کنید یا  روز شروع کلاس خالی است  ');
                      }
             }
         </script>
         <script>
                function sabtenam(id)
                {

                    $.ajax({
                        url: '/sabtenam',
                        type: 'POST',
                        data: { _token: '{{ csrf_token() }}',roomid:$(id).val()},

                        success:function(data){

                                                   if(data["msg"]==0)
                                                   {
                                                       alert('قبلا ثبت نام شده است');
                                                   }
                                                   else
                                                   {
                                                       alert('ثبت نام با موفقیت انجام شده است');

                                                   }
                                               },
                        error: function ()
                        {
                            alert('error');
                        },
                    });
                }

         </script>
    <style>
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
    <div class="row" style="height: 100% !important;">
        <div class="col-9 full-height" style="background: #e0e0d2;margin-right: 12%" >
            <div style="background: white;margin-top: 2%">
                <nav class="navbar navbar-dark bg-dark" style="border: 2px solid black">
                    <span><a style="color: white;"  href="/student/showclass">ثبت نام کلاس</a></span>
                    <span><a style="color: white;" href="/student/sendteacher">درخواست به معلم</a></span>
                    <span><a style="color: white;" href="/student/showmessage">مشاهده پیام</a></span>
                    <span><a style="color: white;" href="/logout"> خروج</a></span>
                </nav>
            </div>
            <div style="text-align: right;margin-right: 5%;margin-top: 5%">
            @foreach($paye as $variable)
                <div>
                    <span>{{ $variable }} </span>
                    <input type="radio" name="paye" class="getclick" value="{{ $variable }}">
                </div>
            @endforeach
            </div>
            <div id="content" style="margin-top: 5%;text-align: right">
            <input type="text" id="pcal1" class="pdate" name="startdate"  value="{{ old('startdate') }}">
            </div>
            <small class="text-danger">{{ $errors->first('startdate') }}</small>
            <div   id="mytable"  style="text-align: right;font-size: 75%;background: #e0e0d2;weight:300%!important;height: auto"></div>
            </div>
        </div>
    </div>
  </div>
    </body>
    <script>
          $("#pcal1").toggle();
    </script>
</html>
