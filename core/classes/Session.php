<?php

class Session
{
    public static function add($arparametres) {
        if (!is_array($arparametres)) {
            return false;
        }
        foreach ($arparametres as $key => $value) {
            $_SESSION[$key] = $value;
        }
        return true;
    }

    public static function delete($key) {
        unset($_SESSION[$key]);
    }

    public static function getSession() {
        return $_SESSION;
    }
}