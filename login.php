<?php
require_once __DIR__.'/classes/User.php';
session_start();

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = User::login($_POST['email'] ?? '', $_POST['password'] ?? '');
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: dashboard.php'); exit;
    }
    $error = 'Nieprawidłowy e-mail lub hasło';
}
?>
<!DOCTYPE html><html lang="pl"><head><meta charset="utf-8"><title>Logowanie</title></head><body>
<h1>Logowanie</h1>
<?php if ($error) echo "<p style='color:red'>$error</p>"; ?>
<form method="post">
    E-mail: <input type="email" name="email" required><br>
    Hasło:  <input type="password" name="password" required><br>
    <button>Zaloguj</button>
</form>
</body></html>
