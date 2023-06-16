<?php
session_start();
if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 0;
}
if (!isset($_COOKIE['counter'])) {
    setcookie('counter', 0, time() + 86400);
}
$_SESSION['counter']++;
setcookie('counter', $_COOKIE['counter'] + 1, time() + 86400);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Session and Cookie Counter</title>
</head>
<body>
    <h1>Session and Cookie Counter</h1>
    <p>Session Counter: <?php echo $_SESSION['counter']; ?></p>
    <p>Cookie Counter: <?php echo $_COOKIE['counter']; ?></p>
</body>
</html>
