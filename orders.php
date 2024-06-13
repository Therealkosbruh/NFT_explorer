<?php
include 'functions/db.php';
$status = 3;
$db = new Db();

if($_SERVER['REQUEST_METHOD']==='POST'){
    //$db = new Db();
    $nft_address = $_POST['nft_address'];
    $new_owner = $_POST['new_owner'];
    $new_status = $status;

    $db->update_owner($new_owner, $nft_address);
    $db->update_status($nft_address, $new_status);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
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
             //include 'functions/db.php';
            //$db = new Db();
            //add order id if form and in selector query
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
                    <h2>'.$order['user_login'].'</h2>
                    <h3 class="TradeData" id="NewOwnerAddress">'.$order['receiver_address'].'</h3>
                </th>
                <th>
                <input type="hidden" name="nft_address" value="' . $order['nft_address'] . '">
                <input type="hidden" name="new_owner" value="' . $order['receiver_address'] . '">
                <input type="hidden" name="new_status" value="' . $status . '">
                <button type="submit" class="btn buy">Передать</button>
                </th>
            </tr>
                ';
            }             
             ?>
            <!-- <tr>
                <th><img src="img/front_part-transformed.png" class="table-img"></th>
                <th>
                    Взгляд Эллины
                    <h3 class="TradeData" id="colladdr">EQAw7kweW05cNiqpnEKrKKrinWAj2D-FCQmfO7IUnw_bpcJz</h3>
                </th>  
                <th>
                    <img src="">
                    Therealkos
                    <h3 class="TradeData" id="NewOwnerAddress">0QD7xTXSW8JX1u912sf69JXNXnBeAg1mRHGS_YoXy8ZXqk1X</h3>
                </th>
                <th><button id="transferCollection" class="btn buy">Передать</button></th>
            </tr> -->
        </table>
        </div>
    </section>
<script src="js/nft_transfer.js"></script>
</body>
</html>