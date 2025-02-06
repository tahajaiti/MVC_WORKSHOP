<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>register</title>
</head>
<body>
<h1>register</h1>

<?php require_once __DIR__ . '/Partials/Message.php'; ?>

<form action="/register" method="post">
    <input type="text" name="name" placeholder="Name">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <input type="submit" value="register">

</form>
</body>
</html>
