<?php

class Connexion {
    private $pdo;

    public function __construct() {
        $strConnection = 'mysql:host=localhost;dbname=nes'; // DSN
        $arrExtraParam = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"); // demande format utf-8
        $this->pdo = new PDO($strConnection, 'root', '', $arrExtraParam);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Demande la gestion d'exception car par défaut PDO ne la propose pas
    }

    public function getObjetPDO() {
        return $this->pdo;
    }
    public function getTabData($squery) {
        $sth = $this->pdo->prepare($squery);
        $sth->execute();
        $result = $sth->fetchAll();
        return $result;
    }

    public function Insertion($squery, $params) {
        $sth = $this->pdo->prepare($squery);
        $sth->execute($params);
    }

    public function VerifInfoConnexion($squery, $params) {
        $sth = $this->pdo->prepare($squery);
        $sth->execute($params);
        $result = $sth->fetchObject();
        return $result;
    }
}
?>