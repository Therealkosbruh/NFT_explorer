<?php
require 'db.php';
if(isset($_POST['addNft'])){
    $db = new Db();
    $collection_address = $_POST['collection_address'];
    $collection_name = $_POST['collection_name'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $img = $_POST['IMG'];
    $descr = $_POST['Descr'];
    $creator = $_POST['creator'];
    $db->addNft($collection_address, $collection_name, $descr, $img, $price, $creator, $type);
    echo'Успешно!';
    header("Location: ../add_nft.php");
}else{
    echo'Ошибка добавление, попробуйте снова!';
    header("Location: ../add_nft.php");
}