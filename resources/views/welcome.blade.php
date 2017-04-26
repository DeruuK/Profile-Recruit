<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>CP</title>
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }
            .container{
                padding-top: 20px;
                margin-top:10px;
            }
           
            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            
           
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
        <div class="container">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/myspace') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            
                <div id="w-showusers" class="w-float">
                    <h2>Show recommend userlist here(4) if have</h2>
                    @if ($recom_users != null)
                        <table>
                        <tr>
                        @foreach($recom_users as $re_user)
                            <td>
                            <img class="re_portrait" id="{{$re_user['name']}}+img" src="img.php?imgurl={{$re_user['imgurl']}}"><br>
                            <p>re_user['name']</p>
                            <p>re_user['status']</p>
                            <p>re_user['tag']</>
                            <p>re_user['email']</p>
                            </td>
                        @endforeach
                        </tr>
                        </table>
                    @else
                        no recommend users...
                    @endif
                </div> 
                <div id="w-showrecruit" class="w-float">
                    <h2>Show Recruit</h2>
                    @if ($recruits != null)
                        <div class="panel-group" id="recruitwall">
                        @foreach($recruits as $rec)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <a data-toggle="collapse" data-parent="#recruitwall" href="#rec{{$rec->id}}">
                                            <h3>{{$rec->position}}</h3>
                                        </a>
                                        <p><i>{{$rec->companyName}}</i></p>
                                    </div>
                                </div>
                                <div id="rec{{$rec->id}}" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <table class="table">
                                            <tr>
                                                <td>Post by <b>{{$rec->name}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>{{$rec->description}}</td>
                                            </tr>
                                            @if(Auth::check())
                                            <tr>
                                                <td><button type="button" class="sendcv" data-id = "{{$rec->id}}">Send My Resume</button></td>
                                            </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    @else
                        no recruit here...
                    @endif
                </div>
                      
                <div id="postFormData"></div>
                
            </div>
        </div>
    </body>
    <script src="{{ asset('js/newcp.js') }}"></script>
    <script>
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
        $(document).ready(function(){
            $('testform').submit(function(){
                var fname = $('#fname').val();
                var lname = $('#lname').val();
                $.post('postTest',{fname:fname,lname:lname}, function(data){
                    $('#postFormData').html(data);
                });
            });
        });
    </script>
</html>
