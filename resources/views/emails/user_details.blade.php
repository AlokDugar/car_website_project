<!DOCTYPE html>
<html>
<head>
    <title>Your Account Details</title>
</head>
<body>
    <h1>Hello {{ $userName }}</h1>
    <p>Your account has been created successfully. Below are your account details:</p>
    <p><strong>Email:</strong> {{ $userEmail }}</p>
    <p><strong>Password:</strong> {{ $password }}</p>
    <p>Thank you for using our service!</p>
</body>
</html>
