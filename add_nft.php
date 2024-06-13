
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form.css">
    <title>Document</title>
</head>
<body>
<div class="container" id="add_nft_container">
    <div class="container-head" id="addhead">
        <a href="admin.php"><img src="img/logo.png" class="logo"></a>
    </div>
    <form action="functions/add_nft_func.php" method="post">
        <div class="inputs">
        <input type="text" class="inptxt"  name="collection_address" placeholder="Адрес" required>
        <input type="text" class="inptxt"  name="collection_name" placeholder="Имя" required>
        <input type="text" class="inptxt"  name="price" placeholder="Цена" required>
        <input type="text" class="inptxt"  name="IMG" placeholder="Ссылка на изображение"required>
        <input type="text" class="inptxt"  name="Descr" placeholder="Описание"required>
        <select id="type" name="type" class="inptxt"required>
            <option value="1">Статическое</option>
            <option value="2">Анимированное</option>
        </select>
        <select id="type" name="creator" class="inptxt">
            <option value="1">Threshold Art</option>
            <option value="2">Eclypse</option>
        </select>
        </div>
        <button class="btn" name="addNft" type="submit">Создать</button>
    </form>
</div>
</body>
</html>
