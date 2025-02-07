<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>login</title>
</head>
<body>
<h1>login</h1>

<?php require_once __DIR__ . '/Partials/Message.php'; ?>

<form action="/login" method="post">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <input type="submit" value="login">

</form>
</body>
</html>
