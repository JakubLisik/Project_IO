<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pl">
<head><meta charset="utf-8"><title>Parking – Strona główna</title></head>
<body>
<h1>Witaj w systemie rezerwacji parkingów</h1>
<p><a href="login.php">Zaloguj się</a> lub <a href="register.php">załóż konto</a>.</p>
</body>
</html>
