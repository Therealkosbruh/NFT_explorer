<?php
session_start();
require_once 'functions/db.php';
$db = new Db();
$role = 0;
if (isset($_SESSION['wallet']) && isset($_SESSION['role'])) {
    $wallet = $_SESSION['wallet'];
    $role = $_SESSION['role'];
    echo(".$wallet.");
    if (isset($_POST['buy_btn'])) {
        $_SESSION['collection_address'] = $_POST['collection_address'];
    }else{
    }
} else {
    echo "Сессия не найдена.";
}
$notifications = $db->get_user_notifications($wallet);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/market.css">
    <script src="https://unpkg.com/@tonconnect/ui@latest/dist/tonconnect-ui.min.js"></script>
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
                <button class="notification_btn"><i class='bx bxs-bell'></i></button>
                <button id="profil_btn" class="redbtn" onclick="redirectToProfile()"><i class='bx bxs-user'></i></button>
            </div>
        </div>
        <?php
        if(count($notifications)>0){
            foreach($notifications as $notification){
                echo'
            <div id="notificationContainer" class="notification-container">
            <div class="notification">
              <img src="img/logo.png" class="notification-icon">
              <div class="notification-content">
                <h3 class="notification-title">Уведомление о заказе</h3>
                <p class="notification-message">'.$notification["message_text"].'</p>
                <h1 id="nonfc">У вас нет активных уведомлений</h1>
              </div>
            </div>
                ';
            }
        }else{
            echo'
            <div id="notificationContainer" class="notification-container">
            <div class="notification">
              <div class="notification-content">
                <h1 id="nonfc">У вас нет активных уведомлений</h1>
              </div>
            </div>
        </div>
            ';
        }
        ?>
    </header>
    <h2 class="headline">Каталог NFT</h2>
    <div id="ton-connect"></div>
    <button class="btn buy" onclick="discon()" id="discbtn">Переподключить кошелек</button>
    <div class="buy-form">
        <div class="transaction-form">
            <h2>Оплата</h2>
            <div class="data">
                <div class="nft-content" id="transactionNftcard">
                    <img src="" class="tokenimg" id="nftImage">       
                </div>
                <div class="transaction-data">
                    <h4 class="wallet" id="NFTname"></h4>
                    <h4 class="wallet" id="senderwallet"></h4>
                    <h4 class="wallet" id="collectionaddress"></h4>
                    <p class="wallet" id="nft_form_descr"></p>
                    <h4 class="wallet" id="nftprice"></h4>
                </div>
                <div class="button-section">
                    <button class="btn buy" id="transact_btn" type="submit" onclick="transaction()">Оплатить</button>
                </div>
            </div>
            <i class='bx bx-x-circle' id="close-cart"></i>
        </div>
    </div>
    <section class="market">
        <div class="nft-container">

            <?php
                // require_once'functions/db.php';
                // $db = new Db();
                $nfts = $db->get_nft_list();
                foreach($nfts as $nft){
                    echo'
        <form method="post" action="market.php">
            <div class="nft-card">
                <div class="main">
                    <div class="nft-content">
                        <img src="'.$nft['IMG'].'" class="tokenimg">
                    </div>
                    <div class="nft-descr">
                        <h3 class="nft-title">'.$nft['collection_name'].'</h3>
                        <p class="nft-price"><ins><img class="toncoin" src="img/toncoin-logo.png"></ins>'.$nft['Nft_price'].' TON</p>
                    </div>
                    <div class="info">
                        <button type="submit" name="buy_btn" class="btn buy buy_btn">Купить</button>
                        <input type="hidden" name="collection_address" value="'.$nft['collection_address'].'">
                    </div>
                    <div class="creator">
                        <div class="creator-avatar">
                            <img src="'.$nft['artist_avatar'].'" class="toncoin">
                        </div>
                        <div class="creator-title">
                            <p><ins class="crins">Creation of</ins> <a href="artist_prodile.php?artist_id='.$nft['Creator'].'" class="owner">'.$nft['artist_name'].'</a></p>
                        </div>
                        <p class="description">'.$nft['descr'].'</p>
                        <p class="description coladdr">'.$nft['collection_address'].'</p>
                    </div>
                </div>
            </div>
        </form>
    ';
                }
            ?>
                <div class="nft-card">
                <div class="main">
                <video autoplay loop muted plays-inline class="front-clip">
                     <source src="img/nft-lips.mp4" type="video/mp4">
                </video>
                    <div class="nft-descr">
                        <h3 class="nft-title">Взгляд Эллины</h3>
                        <p class="nft-price"><ins><img class="toncoin" src="img/toncoin-logo.png"></ins> 0.001 TON</p>
                    </div>
                    <div class="info">
                        <a href="#" class="btn buy" id="buy_btn">Купить</a>
                    </div>
                    <div class='creator'>
                        <div class="creator-avatar">
                            <img src="img/sticker.webp" class="toncoin">
                        </div>
                        <div class="creator-title">
                            <p><ins class="crins">Creation of</ins> <a href="" class="owner">Threshold Art</a></p>
                        </div>
                </div>
          </div>
          </div> 
        </div> 
</section>
<script>
    function redirectToProfile() {
       var role = <?php echo $role; ?>;
        
            switch(role) {
                case 0:
                    window.location.href = 'auth.php';
                    break;
                case 1:
                    window.location.href = 'user_profil.php';
                    break;
                case 2:
                    window.location.href = 'admin.php';
                    break;
            }
          } 
</script>
<script src="js/tontransfer.js"></script>
<script src="js/transaction.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>  
</body>
</html>