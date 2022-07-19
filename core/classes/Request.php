<?php

class Request
{
    public static function acceptRequest() {
        $obUser = new User();
        if($_POST) {
            switch ($_POST['id_form']) {
                case "login":
                    return $obUser->login($_POST['login'], $_POST['password']);
                case "registration":
                    return $obUser->registration($_POST['login'], $_POST['name'], $_POST['password'], $_FILES['avatar']);
                case "transaction":
                    return $obUser->transaction($_POST['sum'], $_POST['recipient']);
            }
        }
    }

}