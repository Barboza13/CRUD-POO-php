<?php
require "./connectionDB.php";

class CRUD extends connectionDB {
    private $PDO;

    public function __construct() {
        try {
            $this->PDO = parent::connection();
        } catch (PDOException $e) {
            die("Error de conexion: " . $e->getMessage());
        }
    }

    public function saveData($data = []) {
        try {
            $query = "INSERT INTO clientes (full_name, CI, email) VALUES (?, ?, ?)";
            $statement = $this->PDO->prepare($query);
            $statement->bindParam(1, $data['full_name'], PDO::PARAM_STR);
            $statement->bindParam(2, $data['CI'], PDO::PARAM_STR);
            $statement->bindParam(3, $data['email'], PDO::PARAM_STR);
            $value = $statement->execute();
        } catch (PDOException $e) {
            die("Error al guardar:" . $e->getMessage());
        } finally {
            $statement = null;
        }

        return $value;
    }

    public function getAllData() {
        $query = 'SELECT * FROM clientes';
        $statement = $this->PDO->query($query);
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getDataById($id) {
        $query = "SELECT * FROM clientes WHERE id=" . $id;
        $statement = $this->PDO->query($query);
        $data = $statement->fetch(PDO::FETCH_OBJ);
        return $data;
    }

    public function deleteData($id) {
        $query = "DELETE FROM clientes WHERE id=" . $id;
        $statement = $this->PDO->prepare($query);
        $value = ($statement->execute()) ? true : false;
        return $value;
    }

    public function updateData($data = [], $id) {
        $query = "UPDATE clientes SET (full_name = ?, CI = ?, email = ?) WHERE id=" . $id;
        $statement = $this->PDO->prepare($query);
        $statement->bindParam(1, $data['name']);
        $statement->bindParam(2, $data['CI']);
        $statement->bindParam(3, $data['email']);
        $value = ($statement->execute()) ? true : false;
        return $value;
    }
}
