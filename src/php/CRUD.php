<?php
require "./connectionDB.php";

class CRUD extends connectionDB {
    private $PDO;

    public function __construct()
    {
        try {
            $this->PDO = parent::connection();
        } catch (PDOException $e) {
            die("Error de conexion: " . $e->getMessage());
        }
    }

    /**
     * Save data.
     * @param array $data
     * @return bool
     */
    public function saveData($data = []): bool
    {
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

    /**
     * Get data.
     * @return array
     */
    public function getAllData(): array
    {    
        try {
            $query = 'SELECT * FROM clientes';
            $statement = $this->PDO->query($query);
            $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            die("Error al traer todos los datos: " . $e->getMessage());
        }
    }

    /**
     * Get data by ID.
     * @param int $id
     * @return array
     */
    public function getDataById($id): array
    {
        try {
            $query = "SELECT * FROM clientes WHERE id=" . $id;
            $statement = $this->PDO->query($query);
            $data = $statement->fetch(PDO::FETCH_OBJ);
            return $data;
        } catch (PDOException $e) {
            die("Error al obtener el recurso: " . $e->getMessage());
        }
    }

    /**
     * Delete data.
     * @param int $id
     * @return bool
     */
    public function deleteData(int $id): bool
    {
        try {
            $query = "DELETE FROM clientes WHERE id=" . $id;
            $statement = $this->PDO->prepare($query);
            $value = $statement->execute();
            return $value;
        } catch (PDOException $e) {
            die("Erro al eliminar el registro: " . $e->getMessage());
        }
    }

    /**
     * Update data.
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function updateData($data = [], int $id): bool
    {
        try {
            $query = "UPDATE clientes SET (full_name = ?, CI = ?, email = ?) WHERE id=" . $id;
            $statement = $this->PDO->prepare($query);
            $statement->bindParam(1, $data['name']);
            $statement->bindParam(2, $data['CI']);
            $statement->bindParam(3, $data['email']);
            $value = $statement->execute();
            return $value;
        } catch (PDOException $e) {
            die("Error al actualizar el registro: ". $e->getMessage());
        }
    }
}
