<?php
class connectionDB {
    private $dbname = "poophp";
    private $username = "root";
    private $password = "";
    private $PDO;

    public function __construct() {
    }

    public function connection(): PDO {
        $this->PDO = new PDO("mysql:host=localhost;dbname=$this->dbname", $this->username, $this->password);
        $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $this->PDO;
    }
}
