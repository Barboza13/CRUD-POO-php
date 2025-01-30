<?php
require "./connectionDB.php";

class ClienteController extends connectionDB
{
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
     * Save Data.
     * @param array $data
     * @return array
     */
    public function saveData(array $data): array
    {
        $data_time = new DateTime();
        $timestamp = $data_time->format("Y-m-d H:i:s");

        try {
            $query = "INSERT INTO clientes (full_name, CI, email, created_at) VALUES (?, ?, ?, ?)";
            $statement = $this->PDO->prepare($query);
            $statement->bindParam(1, $data['full_name'], PDO::PARAM_STR);
            $statement->bindParam(2, $data['CI'], PDO::PARAM_STR);
            $statement->bindParam(3, $data['email'], PDO::PARAM_STR);
            $statement->bindParam(4, $timestamp, PDO::PARAM_STR);
            $statement->execute();

            return [
                "status" => true,
                "data" => $data,
                "message" => "¡Cliente guardado exitosamente!"
            ];
        } catch (PDOException $e) {
            return [
                "status" => false,
                "message" => "¡Ocurrio un error al guardar el cliente!",
                "error" => $e->getMessage()
            ];
        } finally {
            $statement = null; # Close connection.
        }
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

            return [
                "status" => true,
                "data" => $data,
                "message" => "¡Datos obtenidos con exito!"
            ];
        } catch (PDOException $e) {
            return [
                "status" => false,
                "message" => "¡Error al obtener los clientes!",
                "error" => $e->getMessage()
            ];
        } finally {
            $statement = null; # Close connection.
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
            die("Error al actualizar el registro: " . $e->getMessage());
        }
    }
}
