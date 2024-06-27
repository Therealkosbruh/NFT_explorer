<?php
include 'functions/db.php';
$status = 3;
$db = new Db();

if($_SERVER['REQUEST_METHOD']==='POST'){
    $nft_address = $_POST['collection_address'];
    $new_owner = $_POST['reciever_address'];
    $new_status = $status;

    $db->update_owner($new_owner, $nft_address);
    $db->update_status($nft_address, $new_status);
    $db->close_order($nft_address);
    //echo 'success';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/@tonconnect/ui@latest/dist/tonconnect-ui.min.js"></script>
    <title>Document</title>
</head>
<body>
<nav>
        <div class="navbar">
            <a href="market.php" class="nav-links">Главная</a>
            <a href="addNFT.php" class="nav-links">Добавить NFT</a>
            <a href="ordersNFT.php" class="nav-links">Заказы</a>
        </div>            
</nav>
        <div class="sec-head">
            <h2 class="headline">Оплаченные NFT</h2>
        </div>
        <div id="ton-connect"></div>
    <section class="orders">
        <div class="table-container">
        <table class="orders-table">
            <tr>
                <th class="table-headline"> </th>
                <th class="table-headline">Коллекция</th>
                <th class="table-headline">Покупатель</th>
                <th class="table-headline">Действие</th> 
            </tr>   
             <?php
            $orderlist = $db->get_order_list();
            foreach($orderlist as $order){
                echo'
                <tr>
                <th><img src="'.$order['IMG'].'" class="table-img"></th>
                <th>
                    <h2>'.$order['collection_name'].'</h2>
                    <h3 class="TradeData" id="colladdr">'.$order['nft_address'].'</h3>
                </th>  
                <th>
                    <h2 class="newrec">'.$order['user_login'].'</h2>
                    <h3 class="TradeData" id="NewOwnerAddress">'.$order['receiver_address'].'</h3>
                </th>
                <th>
                    <input type="hidden" name="nft_address" value="' . $order['nft_address'] . '">
                    <input type="hidden" name="new_owner" value="' . $order['receiver_address'] . '">
                    <input type="hidden" name="new_status" value="' . $status . '">
                    <button class="btn buy buy_btn" onclick="Nft_transfer()">Передать</button>
                </th>
            </tr>
                ';
            }             
             ?>
        </table>
        </div>
    </section>
    <div class="buy-form">
        <div class="transaction-form">
            <h2>Смена Владельца</h2>
            <div class="data">
                <div class="nft-content" id="transactionNftcard">
                    <img src="" class="tokenimg" id="nftImage">       
                </div>
                <div class="transaction-data">
                    <h4 class="wallet" id="NFTname"></h4>
                   <h4 class="wallet" id="RecieverName"></h4>
                </div>
                <form action="orders.php" method="post">
                    <input type="hidden" name="collection_address" value="">
                    <input type="hidden" name="reciever_address" value="">
                    <div class="button-section">
                        <button class="btn buy" id="transact_btn" type="submit">Передать</button>
                    </div>
                </form>
            </div>
            <i class='bx bx-x-circle' id="close-cart"></i>
        </div>
    </div>
<script src="js/nft_transfer.js"></script>
</body>
</html>
