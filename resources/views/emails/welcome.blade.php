<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
</head>
<body>
    <p>Please Click on the link below and fill all the necessary fields to complete the registration process</p>
    <a href='{{ route('final-form', $user->email_code) }}'>Complete Registration</a>
</body>
</html>
