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
    <p>Name: {{ $first_name }} {{ $last_name }}</p>
    <p>Phone: {{ $phone }}</p>
    <p>Email: {{ $email }}</p>
    <p>Message: {{ $message }}</p>
    <p>Thank you,<br/>Gamehub</p>

</body>
</html>