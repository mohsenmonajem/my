<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }} fa" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <!-- Fonts -->
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
        <script src= "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>

    <body style="height: 100%!important;margin-right: 20%!important;background-image: url('{{ asset('Web-Page-Background-Color.jpg') }}')  ;  background-repeat: repeat-x; background-repeat: repeat-y;">
    <div class="container" style="height: 100%!important;">
        <div class="row" style="height: 100%!important;">
            <div class="col-9 full-height" style="position: relative;margin-top:20%;">
                <form action="/checklogin" method="POST" style="text-align: right;">
                    {{ csrf_field() }}
                    <div class="form-group  mx-sm-3  mb-2">
                        <label for="username" class="col-sm-2 col-form-label" style="font-size: 90%">نام کاربری</label>
                        <div class="col-sm-10">
                            <input type="text"  style="border: 1px solid white" class="form-control" id="username" name="username" value="{{ old("username") }}">
                        </div>
                    </div>
                    <div class="form-group mx-sm-3 mb-2" style="margin-top: 3%">
                        <label for="password" class="col-sm-2 col-form-label" style="font-size: 90%">کلمه عبور</label>
                        <div class="col-sm-10">
                            <input type="text" name="password"  style="border: 1px solid white" class="form-control" id="password"  value="{{ old("password") }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2" style="padding-right: 3%;margin-right: 5%;margin-top: 5%">تایید</button>

                </form>
                @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    </body>
</html>
