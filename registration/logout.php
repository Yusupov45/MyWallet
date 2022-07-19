<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/core/header.php';
$obUser = new User();
$obUser->logout();
header("Location: ../index.php");