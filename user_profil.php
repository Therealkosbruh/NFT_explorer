<?php
require_once 'functions/User.php';
require_once 'functions/db.php';
session_start();

if(isset($_SESSION['wallet'])){
    $db = new Db();
    $user = new User($_SESSION['wallet']);
    $login = $user->getLogin();
    $role = $user->getRoleName();
    $userNfts = $db->get_user_nfts($_SESSION['wallet']);
}else{
    header("index.html");
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
            <div class="userimg">
                <img src="img/avatarka.jpg" class="avatar">
            </div>
            <div class="userinfoo">
                <h3 class="usertitles nick"><?php echo ($login)?></h3>
                <h3 class="usertitles"><?php echo ($role)?></h3>
            </div>
            <div class="accountinfo">
                <ul class="data-user">
                    <li><a><strong id="nft_count_display"></strong><span>Купленных NFT</span></a></li>
                   </ul>
            </div>
            <form action="functions/log_out.php" method="post">
                <button type="submit" name="log_out" class="btn buy">Выйти</button>        
            </form>   
        </div>
    </section>
    <h2 class="headline">Каталог NFT</h2>
    <section class="market">
        <div class="nft-container">
            <?php
            if(count($userNfts)>0){
                foreach($userNfts as $nft){
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
            }else{
                echo'<h1 class="No_nft">У пользователя пока что нет купленных NFT</h1>';
            }
            ?>
</div>
</div>
        </div>  
    </section>

    <script>
        document.addEventListener('DOMContentLoaded',event=>{
            const card_count = document.querySelectorAll('.nft-card').length;
            document.getElementById('nft_count_display').textContent = card_count;
        });
    </script>
    <script src="js/transaction.js"></script>
</body>
</html>