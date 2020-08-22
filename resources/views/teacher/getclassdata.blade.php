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
<body style="height: 100%!important;margin-right: 20%">
<div class="container" style="height: 100%!important;text-align: center!important;">
    <div class="row" style="height: 100%!important;">
        <div class="col-9 full-height" style="background: #e0e0d2;" >
            <ul>
                <li><a  href="/teacher/takedars">ثبت درس</a></li>
                <li ><a  href="/teacher/requestclass">ثبت کلاس</a></li>
                <li ><a  href="/teacher/showclassdetail">مشاهده وضعیت کلاس </a></li>
                <li><a  href="/teacher/listlesson"> پیام ها</a></li>
                <li><a  href="/logout"> خروج </a></li>
            </ul>
<form style="margin-top: 4%" method="post" action={{ url("/teacher/saveclass")}}  >
    <div class="input-group input-group-sm mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-sm">تاریخ شروع</span>
        </div>
        <input type="text" id="pcal1"  class="pdate form-control"  aria-label="Small form-control" aria-describedby="inputGroup-sizing-sm" name="startdate" {{ old('startdate') }}>
    </div>
        <small class="text-danger">{{ $errors->first('startdate') }}</small>
    {{ csrf_field() }}

    <div class="input-group input-group-sm mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-sm">تاریخ پایان</span>
        </div>
    <input type="text" id="pcal2" class="pdate form-control" name="enddate" aria-label="Small form-control" aria-describedby="inputGroup-sizing-sm" value={{ old('enddate') }}>
    </div>
    <small class="text-danger">{{ $errors->first('enddate') }}</small>
    <div class="input-group">
        <span class="input-group-text">تعداد نفرات</span>
        <div class="input-group-append">
            <input type="number"  class="form-control" aria-label="Amount (to the nearest dollar)" name="capacity" value={{ old('capacity') }}>
        </div>
    </div>
    <div style="margin-top: 2%"></div>
    <small class="text-danger">{{ $errors->first('capacity') }}</small>
    <div class="input-group">
        <span class="input-group-text">ادرس کلاس</span>
        <div class="input-group-append">
         <input type="text" name="address"   class="form-control"    value={{ old('address') }}>
        </div>
    </div>
    <small class="text-danger">{{ $errors->first('cost') }}</small>
    <div class="input-group" style="margin-top:2%">
        <span class="input-group-text">تومان</span>
        <div class="input-group-append">

            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="cost">
        </div>
    </div>
    <small class="text-danger">{{ $errors->first('address') }}</small>
         @foreach($lessondetail as $value)
        <div class="form-check" style="text-align: right!important;">
            <label class="form-check-label" for="exampleRadios{{$value->id}}">
                {{ $value->payenumber}} {{ $value->namedars }}
            </label>
            <input class="form-check-input" type="radio" name="dars" id="exampleRadios{{$value->id}}" value="{{ $value->id }}">
       </div>
        @endforeach
     <div style="text-align: right!important;margin: 5%">
    <button type="submit" style="font-size: 130%;" class="btn btn-primary pb-2 mb-3">تایید</button>
     </div>
         <span class="text-danger">{{ $errors->first('dars') }}</span>
</form>
        </div>
    </div>
</div>
</body>
<script>
    var objCal1 = new AMIB.persianCalendar( 'pcal1',
        { extraInputID: "extra", extraInputFormat: "YYYYMMDD" }
    );
    var objCal2 = new AMIB.persianCalendar( 'pcal2',
        { extraInputID: "extra2", extraInputFormat: "YYYYMMDD" }
    );
</script>
</html>
