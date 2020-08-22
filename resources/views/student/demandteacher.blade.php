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

    <style>
            html, body {

                height: 100%;
            }

            .full-height {
                height: 100%;
            }

        </style>
         <script>
            var count=0;
            var value=1;
         </script>
        <script type="text/javascript">
            var  payedars;
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $(".getclick").click(function() {
                    if(this.value!=value)
                    {
                      $("#teacherdata").empty();
                        payedars=$(this).val();
                        value=this.value;
                        $.ajax({
                            url: '/getpayedars',
                            type: 'POST',
                            data: { _token: '{{ csrf_token() }}',paye:$(this).val()},
                            success:function(data){
                                for(var i=0;i<data["msg"].length ;i++)
                                {
                                    var poem = data["msg"][i];
                                    var text1='<spand style="margin-right: 2%">'+poem+'</spand><input type="radio"  class="darse"  name="dars" value='+poem+'><br/>';
                                    var radioBtn = $(text1);
                                    radioBtn.appendTo("#container");
                                    count++;
                                }
                                var text2='<input type="button" class="btn btn-primary" style="margin-top: 5%;margin-right: 5%" id="rr" value="انتخاب" onclick="msg()" >';
                                var radioBtn2 = $(text2);
                                radioBtn2.appendTo('#container');

                            },
                            error: function ()
                            {
                                alert('error');
                            },
                        });
                    }
                });

             });
        </script>
        <script type="text/javascript">
            function msg()
            {
              $("#teacherdata").empty();
              window.stop();
              var paye=$('input[name="paye"]:checked').val();
              var dars= $('input[name="dars"]:checked').val();
              $.ajax({
                  url: '/getteacherdetail',
                  type: 'POST',
                  data: { _token: '{{ csrf_token() }}',dars:dars,paye:paye },
                  success:function(data){
                    console.log(data);
                    for(var i=0;i<data["msg"].length ;i++)
                    {

                        var start='<div style="text-align: right;margin-top: 7%;border-bottom: 2px solid white;padding-right: 5%">';
                      var namefamily='<div>'+data["msg"][i].name+data["msg"][i].family+'</div>';
                      var email='<p>'+data["msg"][i].email+'</p>'
                      var text='<textarea style="width: 50%"  class="form-control" rows="2" id="messag2"></textarea>';
                      var iddars=data["iddars"];
                      var input1 ='<button class="data btn btn-primary" onclick="darkhast(this,'+iddars+')" value="'+data["msg"][i].id+'">ارسال درخواست</button>';
                      var border='<p style="margin-top: %5;"> </p>'
                      var end='</div>';
                      var text = $(start+namefamily+email+text+input1+border+end);
                      text.appendTo('#teacherdata');
                    count++;
                  }
                 },
                  error: function ()
                  {
                      alert('error');
                  },
              });
            }
            function  darkhast(data,darsid)
            {

            if($('#messag2').val().length>1)
            {

              $.ajax({
                  url: '/savestudentdemand',
                  type: 'POST',
                  dataType: "json",
                  data: { _token: '{{ csrf_token() }}',teacheruserid:$(data).val(),darsid:darsid,text:$('#messag2').val()},
                  success:function(value){
                            alert('ok');
                  },
                  error: function ()
                  {
                      alert('error');
                  },
              });
            }
            else
            {
                      var text='<div style="border:2px solid black">شرح در خواست را کامل کنید</div>';
                      var text1 = $(text);
                      text1.appendTo('#teacherdata');
            }
          }
        </script>
    </head>
    <body>
    {{ csrf_field() }}
    <body style="height: 100%!important;">
    <div class="container" style="height: 100%!important;">
        <div class="row" style="height: 100% !important;">
            <div class="col-9 full-height" style="background: #e0e0d2;margin-right: 12%" >
                <div style="background: white;margin-top: 2%">
                    <nav class="navbar navbar-dark bg-dark" style="border: 2px solid black">
                        <span><a style="color: white;"  href="/student/showclass">ثبت نام کلاس</a></span>
                        <span><a style="color: white;" href="/student/sendteacher">درخواست به معلم</a></span>
                        <span><a style="color: white;" href="/student/showmessage">مشاهده پیام</a></span>
                        <span><a style="color: white;" href="/logout">خروج</a></span>

                    </nav>
                </div>
                    @foreach($data as $variable)
                        <div style="text-align: right;margin-top: 5%">
                            <span>{{ $variable }} </span>
                            <input type="radio" name="paye" class="getclick" value="{{ $variable }}">
                        </div>
                    @endforeach
                <div style="height: auto;background: #e0e0d2;position: relative;right: -2%;width: 104.2%">
    <div id="container" style="text-align: right;margin-top: 5% "></div>
    <div id="teacherdata"></div>
                </div>
            </div>
        </div>
     </div>
    </body>
</html>
