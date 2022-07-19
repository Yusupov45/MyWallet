<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/core/settings.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/core/classes/requireClasses.php';
session_start();
try{
    $db = new DBConn();
} catch (PDOException $e) {
    echo "Ошибка в подключении к бд";
    die();
}

$requestResult = Request::acceptRequest();

$obUser = new User();

if ($obUser->isLogin() && explode("?", $_SERVER['REQUEST_URI'])[0] != "/personalarea/" && explode("?", $_SERVER['REQUEST_URI'])[0] != "/personalarea/index.php") {
    header("Location: ../personalarea/index.php");
}

if (!$obUser->isLogin() && (explode("?", $_SERVER['REQUEST_URI'])[0] == "/personalarea/" || explode("?", $_SERVER['REQUEST_URI'])[0] == "/personalarea/index.php")) {
    header("Location: ../index.php");
}


if ($obUser->isLogin()) {
    $obProfile = new Profile();
    $profile = $obProfile->GetProfile($obUser->getCurrentUser()['login']);
}

?>