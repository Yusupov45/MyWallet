<?php

class Profile extends DBConn
{
    public function GetProfile($login) {
        return parent::getUserByLogin($login);
    }
}