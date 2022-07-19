<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/core/header.php';
?>

    <div class="container">
        <h1>Авторизация</h1>
        <form action="" method="post" class="form mt-100">
            <input type="hidden" name="id_form" value="login">
            <h3>Введите логин и пароль:</h3>
            <label>
                Логин
                <input type="text" name="login" class="input">
            </label>

            <label>
                Пароль
                <input type="password" name="password" class="input">
            </label>

            <input type="submit" value="Войти" class="submit">

            <?php
            if ($requestResult === false) {
                echo "<div class='error-massage'>Неверный логин или пароль</div>";
            }
            ?>
        </form>
    </div>

<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/core/footer.php';
?>
