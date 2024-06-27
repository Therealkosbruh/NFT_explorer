<?php
require_once 'functions/db.php';
session_start();

if (isset($_GET['artist_id'])) {
    $artistId = $_GET['artist_id'];
    $db = new Db();

    // Получаем информацию о создателе
    $creatorInfo = $db->get_creator_info($artistId);

    // Получаем список NFT, созданных артистом
    $nfts = $db->get_artist_nftlist($artistId);
} else {
    // Если artist_id не передан, перенаправляем на главную страницу
    header('Location: index.html');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/market.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>NFT Explorer</title>
</head>
<body>
    <header>
        <div class="nav">
            <div class="logo">
                <a href="index.html"><img src="img/logo.png"></a>    
            </div>
            <div class="icons">
                <a href="profile.html"><i class='bx bxs-user'></i></a>
                <i class='bx bxs-bell'></i>    
            </div>
        </div>
        <div class="cart">
            <div class="cart-title">
                <h2>Избранное</h2>
            </div>
            <i class='bx bx-x-circle' id="close-cart"></i>
        </div>
    </header>
    <section class="profileinfo">
        <div class="userinfo">
        <?php if ($creatorInfo): ?>
            <div class="userimg">
                <!-- <img src="img/sticker.webp" class="avatar"> -->
                <img src="<?php echo $creatorInfo['artist_avatar']; ?>" class="avatar">
            </div>
            <div class="userinfoo">
                <h3 class="usertitles nick"><?php echo $creatorInfo['artist_name']; ?></h3>
                <h3 class="usertitles">Художник</h3>
                <!-- <button class="btn buy">Подписаться</button> -->
            </div>
            <?php endif; ?>
            <div class="accountinfo">
                <ul class="data-user">
                    <li><a><strong id="nft_count_display"></strong><span>Колличество работ</span></a></li>
                </ul>
            </div>
        </div>
    </section>
    <h2 class="headline">Каталог NFT</h2>
    <section class="market">
        <div class="nft-container">
   <?php
   foreach($nfts as $nft){
    echo'
    <div class="nft-card">
    <div class="main">
        <div class="nft-content">
            <img src="'.$nft['IMG'].'" class="tokenimg">
        </div>
        <div class="nft-descr">
            <h3 class="nft-title">'.$nft['collection_name'].'</h3>
            <p class="nft-price"><ins><img class="toncoin" src="img/toncoin-logo.png"></ins> '.$nft['Nft_price'].' TON</p>
        </div>
        <div class="info">      
        </div>
        <div class="creator">
            <div class="creator-avatar">
                <img src="'.$nft['artist_avatar'].'" class="toncoin">
            </div>
            <div class="creator-title">
                <p><ins class="crins">Creation of</ins> <a href="" class="owner">'.$nft['artist_name'].'</a></p>
            </div>
    </div>
</div>
</div>
    ';
   }
   ?>   
    </div>  
</section>
    <script>

        document.addEventListener('DOMContentLoaded',event=>{
            const card_count = document.querySelectorAll('.nft-card').length;
            document.getElementById('nft_count_display').textContent = card_count;
        });
    </script>
</body>
</html>