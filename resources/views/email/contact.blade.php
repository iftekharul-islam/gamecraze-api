<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Mail</title>
</head>
<body>
    <h5>Dear admin, </h5>
    <p>New contact request from Gamehub</p>
    <p>Name: {{ $data['first_name'] }} {{ $data['last_name'] }}</p>
    <p>Phone: {{ $data['phone_number'] }}</p>
    <p>Email: {{ $data['email'] }}</p>
    <p>Message:</p>
    <p>{{ $data['message'] }}</p>
    <p>Thank you,<br/>Gamehub</p>
</body>
</html>