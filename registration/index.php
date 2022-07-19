<?php
require_once "../core/header.php";
?>

<div class="container">
    <h1>Регистрация</h1>
    <form action="" method="post" enctype="multipart/form-data" class="form mt-100">
        <input type="hidden" name="id_form" value="registration" >

        <label>
            Имя
            <input type="text" name="name" class="input">
        </label>

        <label>
            Логин
            <input type = "text" name = "login" class="input">
        </label>

        <label>
            Пароль
            <input type = "password" name = "password" class="input">
        </label>

        <label>
            Аватарка
            <input type="file" name = "avatar" class="input">
        </label>

        <input type="submit" value = "Зарегистрироваться" class="submit">

        <div>Все поля обязательны. Размер фото не больше 250Кб. Форматы jpg/png</div>

        <?php
        if ($requestResult['status'] === false) {
            echo "<div class='error-massage'>".$requestResult['message']."</div>";
        }
        elseif ($requestResult['status'] === true) {
            echo "<div class='success'>"."Успешная регистрация!"."</div>";
        }
        ?>
    </form>
</div>
