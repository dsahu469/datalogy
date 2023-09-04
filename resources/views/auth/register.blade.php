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
                    <form method="POST" action="{{ url('register') }}" enctype="multipart/form-data" class="signup-form">
                        @if(Session::has('responseData.status') == true)
                            <p class="text-danger">{{Session::get('responseData.message')}}</p>
                        @endif

                        @php
                            $errors = array();

                            if(Session::get('responseData.error')){
                                $errors = Session::get('responseData.error');

                                //print_r($errors);
                            }
                        @endphp

                        @if(Session::get('responseData.status') == '1')
                            <p class="text-success">{{Session::get('responseData.message')}}</p>
                        @endif

                        @csrf
                        <div class="form-row">
                            <div class="form-group">
                                <label for="first_name">Name</label>
                                <input type="text" class="form-input" name="name" id="name" />
                            </div>
                            <div class="form-group">
                                <label for="last_name">Email</label>
                                <input type="text" class="form-input" name="email" id="email" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone number</label>
                            <input type="number" class="form-input" name="phone_number" id="phone_number" />
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-input" name="address" id="" cols="86" rows="4"></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-input" name="password" id="password" />
                            </div>
                            <div class="form-group">
                                <label for="re_password">Repeat your password</label>
                                <input type="password" class="form-input" name="re_password" id="re_password" />
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="REGISTER" />
                        </div>
                        <div class="form-group">
                            <a href="{{ url('/login') }}">Already have an account? TRY LOGIN</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</body>
</html>
