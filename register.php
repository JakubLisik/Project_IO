<?php
require_once __DIR__.'/classes/User.php';
session_start();

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (User::register($_POST['email'] ?? '', $_POST['password'] ?? '')) {
        $msg = 'Rejestracja udana – możesz się zalogować.';
    } else {
        $msg = 'Użytkownik już istnieje lub błąd walidacji.';
    }
}
?>
<!DOCTYPE html><html lang="pl"><head><meta charset="utf-8"><title>Rejestracja</title></head><body>
<h1>Rejestracja</h1>
<?php if ($msg) echo "<p>$msg</p>"; ?>
<form method="post">
    E-mail: <input type="email" name="email" required><br>
    Hasło:  <input type="password" name="password" required><br>
    <button>Zarejestruj</button>
</form>
</body></html>
