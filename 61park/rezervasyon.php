<?php
// session başlat
session_start();

// redirect
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
require_once('config.php');
$sql = "SELECT * FROM `otoparklar` WHERE `Adres` = 'Konaklar'";
$result = mysqli_query($link, $sql);
echo "<h1>Otoparklar</h1>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<ul><li>{$row["OtoparkAd"]}, Saatlik Ücreti: {$row["Ucret"]} TL <button>Rezerve et</button><p></li></ul>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>61Park | Giriş</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
    </div>
</body>
</html>
