<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="container-head">
            <img src="img/logo.png" class="logo">
            <h2 class="title">Добро пожаловать в NFT Explorer</h2>
            <div class="tab">
                <button class="switchbtn active" id="loginbtn">
                    Вход
                </button>
                <button class="switchbtn" id="regbtn">
                    Регистрация
                </button>
            </div>
        </div>
        <form id="loginform" method="post" action="functions/login.php">
            <div class="form-title">
                <h3>Войдите в совой аккаунт</h3>
            </div>
            <div class="inputs">
                <input type="text" name="loginlog" class="inptxt" placeholder="Логин" required>
                <input type="password" name="passwordlog" class="inptxt" placeholder="Пароль" required>
            </div>
           <div class="actions-section">
                <a href="market.php" class="link">Продолжить без регистрации</a>
           </div>
           <button class="btn" name="login" type="submit">Войти</button>
        </form>
        <div class="reg-container">
        <form id="registration" method="post" action="functions/registration.php">
            <div class="form-title">
                <h2>Регистрация</h2>
            </div>
            <div class="inputs">
                <input type="text" name="wallet" class="inptxt" placeholder="Адрес кошелька" required>
                <input type="text" name="login" class="inptxt" placeholder="Логин" required>
                <input type="password" name="password" class="inptxt" placeholder="Пароль" required>
                <input type="email" name="email" class="inptxt" placeholder="Email" required>
            </div>
           <button class="btn" name="register" type="submit">Создать</button>
        </form>
        </div>
    </div>
    <script>
        var lf  =document.getElementById("loginform");
        var rf  =document.getElementById("registration");

        var logintransit = document.getElementById("loginbtn");
        var regtransit = document.getElementById("regbtn");

        logintransit.onclick = function(){
            rf.style.display = "none";
            lf.style.display = "table";
            regtransit.style.background="transparent";
            logintransit.style.background = "#bc13fe";
        }

        regtransit.onclick = function(){
            lf.style.display = "none";
            rf.style.display = "table";
            rf.style.marginTop = "0";
            regtransit.style.background="#bc13fe";
            logintransit.style.background="transparent";

        }
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->
</body>
</html>