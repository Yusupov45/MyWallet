<?php
$classeslist = [
    'DBConn.php',
    'Session.php',
    'User.php',
    'Request.php',
    'Photo.php',
    'Profile.php'
];
foreach ($classeslist as $class) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/core/classes/'.$class;
}
?>