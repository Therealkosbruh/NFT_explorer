<?php
require_once 'db.php';
session_start();

if (isset($_POST['log_out'])) {
    $db = new Db();
    $db->Log_out();
    header("Location: ../index.html");
    exit();
}

