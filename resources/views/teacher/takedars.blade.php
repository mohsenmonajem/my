<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }} fa" dir="rtl" style="height: 100%!important;">
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
    <script src="{{ asset('js-persian-cal.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('js-persian-cal.css') }}">
    <head>
    <script>
           var value=0;
    </script>
    <script type="text/javascript">
     var  payedars;
               $(document).ready(function() {
                $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
        });
          $("input:radio").click(function() {
              $("#container").empty();
              window.stop();
              payedars=$(this).val();
              $.ajax({
                url: '/getpayedars',
                type: 'POST',
                data: { _token: '{{ csrf_token() }}',paye:$(this).val()},

                success:function(data){
                    for(var i=0;i<data["msg"].length ;i++)
                    {
                        var poem = data["msg"][i];
                        var div='<div style="margin-top: 5%" class="form-check">';
                        var label='<label class="form-check-label" for="gridRadios'+poem+'">'+poem+'</label>';
                        var input='<input  class="form-check-input getclick" type="radio" name="dars" id="gridRadios'+poem+'" value="'+poem+'">';
                        var  radiobtn=$(div+label+input+'</div>');
                        radiobtn.appendTo('#container');
                    }
                    var button='<button type="submit"  style="font-size: 100%;margin-top: 5%" onclick="msg(this)" class="btn btn-primary pb-1 mb-1">تایید</button>';
                    var radioBtn2 = $(button);
                    radioBtn2.appendTo('#container');
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
                   function msg(id)
                   {


                      var getradio=document.getElementsByName('dars');
                      var checking=false;
                      for(var i=0;i<getradio.length;i++)
                      {
                             if(getradio[i].checked==true)
                               {
                                 checking=true;
                                 text=getradio[i].value;
                               }
                      }
                      console.log(text);
                      if(checking==true)
                      {
                            $.ajaxSetup({
                                        headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                 });
                  $.ajax({
                   url: '/savedarsteacher',
                   type: 'POST',
                   data: { _token: '{{ csrf_token() }}',dars:text,userid:'{{ Session::get("userid") }}',paye:payedars},
                                            success:function(data)
                                            {
                                                var div='<div style="margin-top: 5%" class="success"> با موفقیت ذخیره شد</div>';
                                                 div=$(div);
                                                 div.appendTo("#container");
                                            },
                    error: function ()
                    {
                      alert('error');
                    },
                     });
                   }
                 else
                      {
                              alert('لطفا درسی را انتخاب کنید');
                      }
             }
         </script>
        <!-- Styles -->
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
                <div style="margin-top: 10%!important;">
            @foreach($data as $variable)
                    <div class="form-check ">
                        <label class="form-check-label" for="gridRadios{{$variable}}">
                            {{$variable}}
                        </label>
                        <input class="form-check-input getclick" type="radio" name="paye" id="gridRadios{{$variable}}" value="{{$variable}}">
                    </div>
          @endforeach
          <div id="container"> </div>
            </div>
         </div>
        </div>
       </div>
    </body>
</html>
