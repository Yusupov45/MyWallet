<?php

class DBConn extends PDO
{
    private $tablename = "users";

    function __construct() {
        global $arSettings;
        $DB = $arSettings['DB'];
        parent::__construct("mysql:host=$DB[host];dbname=$DB[databaseName]", "$DB[login]","$DB[password]");

    }

    protected function getUserByLogin($login) {
        $sql = "SELECT * FROM `$this->tablename` WHERE `login` = '$login'";
        $sth = $this->prepare($sql);
        $sth->execute();
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    protected function Insert($login,$name,$password,$avatar) {
        $money = 0;
        $numberCheck = 100000 + $this->getLastID()['Id'];
        $sql = "INSERT INTO $this->tablename (`login`, `password`, `name`, `money`, `number_check`, `avatar`) VALUES ('$login', '$password', '$name', '$money', '$numberCheck', '$avatar')";
        $sth = $this->prepare($sql);
        return $sth->execute();
    }

    protected function getLastID() {
        $sql = "SELECT `Id` FROM $this->tablename ORDER BY `Id` DESC LIMIT 1 ";
        $sth = $this->prepare($sql);
        $sth->execute();
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    protected function getById($Id) {
        $sql = "SELECT * FROM `$this->tablename` WHERE `Id` = '$Id'";
        $sth = $this->prepare($sql);
        $sth->execute();
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    protected function doTransation($sum, $recipient, $sender) {
        $sql1 = "UPDATE `$this->tablename` SET `money` = `money` - '$sum' WHERE `login` = '$sender'";
        $sql2 = "UPDATE `$this->tablename` SET `money` = `money` + '$sum' WHERE `number_check` = '$recipient'";
        $sth1 = $this->prepare($sql1);
        $sth2 = $this->prepare($sql2);
        return $sth1->execute() && $sth2->execute();
    }

    protected function getUserByCheck($number_check) {
        $sql = "SELECT * FROM `$this->tablename` WHERE `number_check` = '$number_check'";
        $sth = $this->prepare($sql);
        $sth->execute();
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
}
?>