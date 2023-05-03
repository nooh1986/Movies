<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Main CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}" media="all">

        <title>Login</title>
        
    </head>

    <body>
        <section class="material-half-bg">
            <div class="cover"></div>
        </section>

        <section class="login-content">
            <div class="logo">
                <h1>Movies</h1>
            </div>
            <div class="login-box">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username">
                    </div>
                    <div class="form-group">
                        <label class="control-label">PASSWORD</label>
                        <input class="form-control" type="password" name="password" required autocomplete="current-password">
                    </div>
                    <div class="form-group">
                        <div class="utility">
                            <div class="animated-checkbox">
                                <label><input type="checkbox" name="remember"><span class="label-text">Stay Signed in</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group btn-container">
                        <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
                    </div>
                </form>
            </div>
        </section>

        <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
        
        <script src="{{ asset('assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

        <script src="{{ asset('assets/js/main.js') }}"></script>

        <!-- The javascript plugin to display page loading on top-->
        <script src="{{ asset('assets/js/plugins/pace.min.js') }}"></script>

        <script type="text/javascript">
            // Login Page Flipbox control
            $('.login-content [data-toggle="flip"]').click(function() {
                $('.login-box').toggleClass('flipped');
                return false;
            });
        </script>

    </body>
</html>