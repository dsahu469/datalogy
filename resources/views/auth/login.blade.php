<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <link rel="stylesheet" href="{{ asset('fonts/material-icon/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/jquery-ui/jquery-ui.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="robots" content="noindex, follow">

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
</head>

<body>
    <div class="main">
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <form method="POST" action="{{ url('login') }}" enctype="multipart/form-data" class="signup-form" style="height: 330px">
                        @if(Session::has('responseData.status') == true)
                        <p class="text-center mb-3 text-danger">{{Session::get('responseData.message')}}</p>
                        @endif

                        @php
                        $errors = array();

                        if(Session::get('responseData.error')){
                        $errors = Session::get('responseData.error');
                        }
                        @endphp

                        @if(Session::get('responseData.status') == '1')
                        <p class="text-center mb-3 text-success">{{Session::get('responseData.message')}}</p>
                        @endif
                        @csrf
                        <div class="form-group">
                            <label for="phone_number">Email</label>
                            <input type="text" class="form-input" name="email" id="email" />
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Password</label>
                            <input type="password" class="form-input" name="password" id="password" />
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="LOGIN" />
                        </div>
                        <div class="form-group">
                            <a href="{{ url('/register') }}">Don't have an account? REGISTER</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</body>
</html>