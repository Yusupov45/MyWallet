<?php

class User extends DBConn
{
    public function login($login, $password) {
        if (empty($login) || empty($password)) {
            return false;
        }

        $DBUser = $this->getUserByLogin($login);

        if ($DBUser['password'] == md5($password)) {
            Session::add([
                'idUser' => $DBUser['Id'],
                'nameUser' => $DBUser['name'],
                'login' => $login
            ]);
        }
        else {
            return false;
        }
        return true;
    }

    public function getCurrentUser() {
        return Session::getSession();
    }

    public function isLogin() {
        $arSession = Session::getSession();
        if ($arSession['login']) {
            $arUser = $this->getById($arSession['idUser']);
            if($arUser['login'] == $arSession['login']) {
                return true;
            }
        }
        else {
            return false;
        }
    }

    public function logout() {
        Session::delete('login');
        Session::delete('nameUser');
        Session::delete('idUser');
    }

    public function registration($login, $name, $password, $avatar) {
        $result = [];
        if ($this->getUserByLogin($login)) {
            $result['status'] = false;
            $result['message'] = 'Данный логин уже существует';
        }
        elseif (empty($login) || empty($name) || empty($password) || empty($avatar['name'])) {
            $result['status'] = false;
            $result['message'] = 'Введены не все данные';
        }
        else {
            $resultphoto = Photo::photoProcessing($avatar);
            if ($resultphoto['status']) {
                $password = md5($password);
                $result['status'] = $this->Insert($login,$name,$password,$resultphoto['path']);
            }
            else {
                $result = $resultphoto;
            }
        }
        return $result;
    }

    public function transaction($sum, $recipient) {
        $result = [];
        if (empty($recipient) || empty($sum)) {
            $result['status'] = false;
            $result['message'] = 'Введены не все данные';
            return $result;
        }

        if (!$this->getUserByCheck($recipient)) {
            $result['status'] = false;
            $result['message'] = 'Указанный вами счет не существует';
            return $result;
        }

        if ($sum <= 0) {
            $result['status'] = false;
            $result['message'] = 'Указана неверная сумма';
            return $result;
        }

        $profile = $this->getUserByLogin($this->getCurrentUser()['login']);
        if ($profile['money'] < $sum) {
            $result['status'] = false;
            $result['message'] = 'Недостаточно средств';
            return $result;
        }

        if ($this->doTransation($sum, $recipient, $profile['login'])) {
            $result['status'] = true;
            $result['message'] = 'Успешный перевод';
        }
        return $result;


    }

}