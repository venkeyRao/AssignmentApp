<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Test Application</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="{!! asset('css/bootstrap.min.css') !!}">
        <link rel="stylesheet" href="{!! asset('css/font-awesome.min.css') !!}">
        <link rel="stylesheet" href="{!! asset('css/form-elements.css') !!}">
        <link rel="stylesheet" href="{!! asset('css/style.css') !!}">

        <link rel="shortcut icon" href="{!! asset('ico/favicon.png') !!}">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{!! asset('ico/apple-touch-icon-144-precomposed.png') !!}">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{!! asset('ico/apple-touch-icon-114-precomposed.png') !!}">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{!! asset('ico/apple-touch-icon-72-precomposed.png') !!}">
        <link rel="apple-touch-icon-precomposed" href="{!! asset('ico/apple-touch-icon-57-precomposed.png') !!}">

    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
            
            <div class="inner-bg">
                <div class="container">
                    
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1>Login Or Register</h1>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('errorMessage'))
                                <div class="alert alert-danger">
                                    {{ session('errorMessage') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-5">
                            
                            <div class="form-box">
                                <div class="form-top">
                                    <div class="form-top-left">
                                        <h3>Login to our site</h3>
                                        <p>Enter username and password to log on:</p>
                                    </div>
                                    <div class="form-top-right">
                                        <i class="fa fa-key"></i>
                                    </div>
                                </div>
                                <div class="form-bottom">
                                    <form role="form" action="{{url('loginUser')}}" method="post" class="login-form">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label class="sr-only" for="loginEmail">Email</label>
                                            <input type="text" name="loginEmail" placeholder="Email..." class="form-username form-control" id="loginEmail">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="loginPass">Password</label>
                                            <input type="password" name="loginPass" placeholder="Password..." class="form-password form-control" id="loginPass">
                                        </div>
                                        <button type="submit" class="btn">Sign in!</button>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="col-sm-1 middle-border"></div>
                        <div class="col-sm-1"></div>
                            
                        <div class="col-sm-5">
                            
                            <div class="form-box">
                                <div class="form-top">
                                    <div class="form-top-left">
                                        <h3>Sign up now</h3>
                                        <p>Fill in the form below to get instant access:</p>
                                    </div>
                                    <div class="form-top-right">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                </div>
                                <div class="form-bottom">
                                    <form role="form" action="{{url('registerUser')}}" method="post" class="registration-form">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label class="sr-only" for="name">Name</label>
                                            <input type="text" name="name" placeholder="Name..." class="form-first-name form-control" id="name">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="email">Email</label>
                                            <input type="text" name="email" placeholder="Email..." class="form-email form-control" id="email">
                                        </div>
                                         <div class="form-group">
                                            <label class="sr-only" for="password">Password</label>
                                            <input type="password" name="password" placeholder="Password..." class="form-email form-control" id="password">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="confirmPassword">Password Confirm</label>
                                            <input type="password" name="confirmPassword" placeholder="Confirm Password" class="form-email form-control" id="confirmPassword">
                                        </div>
                                        <button type="submit" class="btn">Sign me up!</button>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>

        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row">
                    
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="footer-border"></div>
                       
                    </div>
                    
                </div>
            </div>
        </footer>

        <!-- Javascript -->
      <script src="{!! asset('js/jquery.js') !!}"></script>
        <script src="{!! asset('js/bootstrap.min.js') !!}"></script>
        <script src="{!! asset('js/scripts.js') !!}"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>