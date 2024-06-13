<?php
require_once('db.php');

if(isset($_POST['register'])){
    $wallet = $_POST['wallet'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $db = new Db();
    $db->Sign_up($wallet, $login, $password,$email);
    header("Location: ../auth.php");
    exit();
}