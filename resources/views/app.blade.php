<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        li {
            float: right;
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover {
            background-color: #111;
        }

        body{
            margin: 0 auto;
            text-align: center;
        }
    </style>
</head>
<body>
    <ul>
        <li><a href="{{ url('logout') }}">Logout</a></li>
        <li><a href="{{ url('home') }}">Hello, {{Auth::user()->name}}</a></li>
    </ul>
    @yield('content')
</body>
</html>