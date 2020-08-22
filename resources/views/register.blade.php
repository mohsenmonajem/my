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
    <style>
         input {
                      border: 1px solid #bbbbbb!important;
                      background:  #eff5f5!important;

                }

    </style>
</head>
<body style="height: 100%!important;margin-right: 20%!important;background-image: url('{{ asset('Web-Page-Background-Color.jpg') }}')  ;  background-repeat: repeat-x; background-repeat: repeat-y;">
<div class="container" style="height: 100%!important;">
    <div class="row" style="height: 100%!important;">
        <div class="col-9 full-height" style="position: relative;margin-top:12%;margin-right: 22%">
            <form action="home/registerdata" method="post"  >
                {{ csrf_field() }}
                <div class="row">
                <div class="form-group col-lg-5">
                    <label for="name" class="sr-only">نام</label>
                    <input type="text"  required name="name" class="form-control" id="name" placeholder="نام">
                </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-5">
                        <label for="family" class="sr-only"> نام خانوادگی</label>
                        <input type="text"  required name="family" class="form-control" id="family" placeholder="نام خانوادگی">
                    </div>
                </div>
                <div class="row">
                <div class="form-group col-lg-5">
                    <label for="family" class="sr-only"> ایمیل</label>
                    <input type="email"  required name="email" class="form-control" id="email" placeholder="ایمیل">
                </div>
               </div>
                <div class="row">
                    <div class="form-group col-lg-5">
                        <label for="password" class="sr-only">پسورد</label>
                        <input type="password"  required name="password" class="form-control" id="password" placeholder="کلمه عبور">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-5">
                        <label for="username" class="sr-only">نام کاربری</label>
                        <input type="text"  required name="username" class="form-control" id="username" placeholder=" نام کاربری">
                    </div>
                </div>
                <div id="radio1" style="text-align: right!important;">
                <div class="form-check">
                    <label class="form-check-label" for="exampleRadios1" style="margin-left: 3%">
                        معلم
                    </label>
                    <input class="form-check-input" type="radio" name="role" id="exampleRadios1" value="teacher">
                </div>
                <div class="form-check">
                    <label class="form-check-label" for="exampleRadios2" style="margin-left: 3%" >
                        دانش اموز
                    </label>
                    <input class="form-check-input" type="radio" name="role" id="exampleRadios2" value="student">
                </div>
                </div>
                <div class="row" style="margin-top: 2%">
                    <div class="form-group col-lg-5">
                        <div class="custom-file" id="customFile">
                            <input type="file" name="image" class="custom-file-input" id="exampleInputFile" aria-describedby="fileHelp">
                            <label class="custom-file-label" for="exampleInputFile" style="text-align: right;padding-right: 40%">
                                انتخاب عکس
                            </label>
                        </div>
                    </div>
                </div>
                <div style="text-align: right;margin-top: 2%">
                <button type="submit" class="btn btn-info btn-lg" style="width: 20%;font-size: 85%"> ارسال</button>
                </div>
            </form>
        </div>
     </div>
   </div>
    </body>
</html>
