<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }} fa" dir="rtl" style="height: 100%!important;"">
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
        <!-- Styles -->
<head>
    <style>
        .full-height
        {
            height: 100%!important;

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
                        <span><a style="color: white;" href="/logout">خروج</a></span>
                    </nav>
                </div>
                <div style="height: auto;background: #e0e0d2;width: 105%;position: relative;right: -3%">
              @foreach ($message as $element)
                    <div style="border:1px solid black;margin-top: 6%">
                            <div style="border:1px solid black;background:#99ffbb;text-align: right;padding: 2%">
                                       <p>{{$element->messagestudent}}</p>
                                       <span>  {{$element->datestudent }}</span>
                                        <span style="margin-right: 3%">  {{$element->timestudent}}</span>

                             </div>
                             @if($element->replyteacher==null)

                                        continue;
                               @endif
                             <div style="background: #e6e6e6;text-align: right;padding: 2%">

                                        <p> {{$element->replyteacher}}</p>
                                        <span> {{ $element->dateteacher }}</span>
                                         <span style="margin-right: 3%"> {{ $element->timeteacher}}</span>

                              </div>

                    </div>
              @endforeach
                </div>
            </div>
        </div>
     </div>
    </body>
</html>
