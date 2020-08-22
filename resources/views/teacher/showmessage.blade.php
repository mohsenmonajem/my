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
        <script type="text/javascript">
            var paye;
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $(".getclick").click(function() {
                    $("#content").empty();
                     window.stop();
                        paye=$(this).val();
                        $.ajax({
                            url: '/studentlistmessage',
                            type: 'POST',
                            data: { _token: '{{ csrf_token() }}',darsid:$(this).val()},
                            success:function(data){
                              if(data["msg"]==0)
                              {
                                 var name='<div>اطلاعاتی موجود نیست</div>';
                                 var text = $(name);
                                 text.appendTo('#content');

                              }
                              else
                              {
                                for(var i=0;i<data["userdetail"].length ;i++)
                                {
                                  var name='<button class="btn btn-secondary btn-sm">'+'<a style="color: white" href="/teacher/showusermessage/{'+data["userdetail"][i].id+'}/{'+data["darsid"][i]+'}">'+data["userdetail"][i].name+data["userdetail"][i].family+'</a>'+'<span style="margin-right: 8%;color: azure">'+data["numbermessage"][i]+'</span></button>';
                                  var text = $(name);
                                  text.appendTo('#content');
                                }
                              }
                            },
                            error: function ()
                            {
                                alert('error');
                            },
                        });
                });

             });
        </script>
    </head>
    <body style="height: 100%!important;">
    <div class="container" style="height: 100%!important;">
        <div class="row" style="height: 100%!important;">
            <div class="col-9 full-height" style="background: #e0e0d2!important;" >
                <ul>
                    <li><a  href="/teacher/takedars">ثبت درس</a></li>
                    <li ><a  href="/teacher/requestclass">ثبت کلاس</a></li>
                    <li ><a  href="/teacher/showclassdetail">مشاهده وضعیت کلاس </a></li>
                    <li><a  href="/teacher/listlesson"> پیام ها</a></li>
                    <li><a  href="/logout"> خروج </a></li>
                </ul>
                <div id="content" style="margin-top: 5%;text-align: right!important;"> </div>
            </div>
            <div class="col-1"></div>
            <div class="col-2 full-height" style="background:   #e0e0d2;">
      @if ($darsdetail===0)
       <p>  درسی موجود نیست</p>
      @else
           @foreach($darsdetail as $element)
                        <button type="button" class="btn btn-secondary btn-sm getclick" value="{{$element->id}}">{{$element->payenumber}} {{$element->namedars}}</button>

                    @endforeach
      @endif
            </div>
    </div>
        </div>
    </body>
</html>
