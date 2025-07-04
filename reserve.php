<?php
require_once __DIR__.'/classes/Core/guard.php';
require_once __DIR__.'/classes/ParkingSpot.php';
require_once __DIR__.'/classes/ReservationService/Factory.php'; // skrót do zestawienia dekoratorów

$parkingId = (int)($_GET['parking'] ?? 0);
$spots     = ParkingSpot::getByParking($parkingId);
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $svc = ReservationServiceFactory::buildService();        // Logging + Auto-payment
    $from = new DateTime($_POST['start'].' '.$_POST['time_start']);
    $to   = new DateTime($_POST['start'].' '.$_POST['time_end']);
    $svc->make($_SESSION['user_id'], (int)$_POST['spot'], $from, $to);
    $msg = 'Rezerwacja utworzona.';
}
?>
<!DOCTYPE html><html lang="pl"><head><meta charset="utf-8"><title>Rezerwacja</title></head><body>
<h1>Rezerwacja – parking #<?= $parkingId ?></h1>
<?php if ($msg) echo "<p style='color:green'>$msg</p>"; ?>
<form method="post">
    <label>Miejsce:
        <select name="spot"><?php foreach ($spots as $s): ?>
            <option value="<?= $s['id'] ?>"><?= $s['number'] ?></option>
        <?php endforeach; ?></select>
    </label><br>
    <label>Data: <input type="date" name="start" required></label><br>
    <label>Od:   <input type="time" name="time_start" required></label><br>
    <label>Do:   <input type="time" name="time_end" required></label><br>
    <button>Zarezerwuj</button>
</form>
</body></html>
