<?php
require_once 'db.php';
session_start();
if (isset($_POST['login'])) {
    $login = $_POST['loginlog'];
    $password = $_POST['passwordlog'];

    $db = new Db();
    $result = $db->Sign_in($login, $password);

    if ($result) {
        $_SESSION['wallet'] = $result['wallet_id'];
        $_SESSION['role'] = $result['user_role'];
        header("Location: ../market.php");
        exit();
    } else {
        echo "Неверный логин или пароль. Повторите попытку";
        header("Location: ../auth.php");
    }
}