<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }
        
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0px 0px 5px 0px #ccc;
            text-align: center;
        }
        
        h1 {
            color: #007bff;
        }
        
        p {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Thank You for Your Payment!</h1>
        <p>Your payment was successfully processed.</p>
        <p>Please Wait..</p>
        <!-- You can add additional content or instructions here as needed. -->
    </div>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                window.location.href = "{{ url('home') }}";
            }, 5000);
        });
    </script>
</body>
</html>