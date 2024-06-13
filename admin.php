<?php
require_once 'functions/db.php';
$db = new Db();
$admin_info = $db->admin_info_page();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <title>Document</title>
</head>
<body>
<nav>
        <div class="navbar">
            <a href="market.php" class="nav-links">Главная</a>
            <a href="add_nft.php" class="nav-links">Добавить NFT</a>
            <a href="orders.php" class="nav-links">Заказы</a>
        </div>            
</nav>
<section class="dashboard">
    <h2>Статистика</h2>
    <div class="container">
        <div class="info">
            <div class="info-image">
                <img src="">
            </div>
            <div class="info-descr">
                <h3 class="descr-title">Прибыль</h3>
                <p class="descr-content"><ins><img class="ton" src="img/toncoin-logo.png"></ins> <?php echo $admin_info['total_price']; ?> TON</p>
            </div>
        </div>
        <div class="info">
            <div class="info-image">
                <img src="">
            </div>
            <div class="info-descr">
                <h3 class="descr-title">Новых пользователей</h3>
                <h3 class="descr-content">1</h3>
            </div>
        </div>
        <div class="info">
            <div class="info-image">
                <img src="">
            </div>
            <div class="info-descr">
                <h3 class="descr-title">Лучший автор</h3>
                <div class='creator'>
                        <div class="creator-avatar">
                            <img src="<?php echo $admin_info['artist_avatar']; ?>" class="toncoin">
                        </div>
                        <div class="creator-title">
                            <p class="owner"><?php echo $admin_info['artist_name']; ?></p>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>   
</body>
</html>