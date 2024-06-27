<?php
session_start();
require_once 'functions/db.php';
$db = new Db();
if (isset($_SESSION['wallet'])&& isset($_SESSION['collection_address'])) {
    $wallet = $_SESSION['wallet'];
    $collection_address = $_SESSION['collection_address'];
    // echo "Wallet: " . $wallet . "<br>";
    // echo "Collection Address: " . $collection_address;
    $db->new_order($wallet,$collection_address);
    $new_status = 2;
    $db->update_status($collection_address,$new_status);
} else {
    echo "Сессионные переменные не найдены.";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/inc.css">
    <title>Document</title>
</head>
<body>
<div class="success-container">
    <div class="title">
        <div class="title-img">
            <img class="logo" src="img/logo.png">
        </div>
        <h1>Поздравляем</h1>
        <p class="message">Ваша заявка Успешно отправлена администратору.</p>
    </div>
    <div class="page-img">
        <img class="result_img" src="img/success.webp">
    </div>
    <div class="btncont">
    <a href="market.php" class="btn buy" id="transitbtn">На главную</a>
    </div>
</div>
</body>
</html>