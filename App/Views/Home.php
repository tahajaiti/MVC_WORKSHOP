<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>
    <h1>Home</h1>
    <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['user_name'])) {
            echo 'welcome ' . $_SESSION['user_name'];
        }
    ?>

</body>
</html>
