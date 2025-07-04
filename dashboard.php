<?php
require_once __DIR__.'/classes/Core/guard.php';          // proste sprawdzenie sesji
require_once __DIR__.'/classes/Parking.php';

$parkings = Parking::getAll();
?>
<!DOCTYPE html><html lang="pl"><head><meta charset="utf-8"><title>Panel</title></head><body>
<h1>Panel użytkownika</h1>
<p><a href="my_reservations.php">Moje rezerwacje</a> | <a href="logout.php">Wyloguj</a></p>

<h2>Dostępne parkingi</h2>
<ul>
<?php foreach ($parkings as $p): ?>
  <li>
      <?= htmlspecialchars($p['name']) ?> –
      <a href="reserve.php?parking=<?= $p['id'] ?>">Rezerwuj</a>
  </li>
<?php endforeach; ?>
</ul>
</body></html>
