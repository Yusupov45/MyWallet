<?php
$obUser = new User();
if ($obUser->isLogin()) {
    echo "<h3 class='name-user'>".$obUser->getCurrentUser()['nameUser']."</h3>";
    echo "<a href='../registration/logout.php' class='come-in'> Выйти </a>";
}
elseif (explode("?", $_SERVER['REQUEST_URI'])[0] == "/" || explode("?", $_SERVER['REQUEST_URI'])[0] == "/index.php" ) {
    echo "<a href='../registration/index.php' class='come-in'>Регистрация</a>";
}
else {
    echo "<a href='../index.php' class='come-in'>Войти</a>";
}
?>