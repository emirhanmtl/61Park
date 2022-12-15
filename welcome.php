<?php
// session başlat
session_start();
 
// redirect
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>61Park Hoş Geldiniz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5">Merhaba, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. 61Park uygulamamıza hoş geldin.</h1>
    <p>
        <a href="logout.php" class="btn btn-danger ml-3">Çıkış Yap</a>
    </p>
</body>