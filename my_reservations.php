<?php
require_once __DIR__.'/classes/Core/guard.php';
require_once __DIR__.'/classes/Reservation.php';

$res = Reservation::getByUser($_SESSION['user_id']);
?>
<!DOCTYPE html><html lang="pl"><head><meta charset="utf-8"><title>Moje rezerwacje</title></head><body>
<h1>Moje rezerwacje</h1>
<p><a href="dashboard.php">← Powrót</a></p>
<table border="1">
<tr><th>ID</th><th>Miejsce</th><th>Od</th><th>Do</th><th>Status płatności</th></tr>
<?php foreach ($res as $r): ?>
<tr>
  <td><?= $r['id'] ?></td><td><?= $r['spot_id'] ?></td>
  <td><?= $r['start_datetime'] ?></td><td><?= $r['end_datetime'] ?></td>
  <td><?= $r['payment_status'] ?></td>
</tr>
<?php endforeach; ?>
</table>
</body></html>
