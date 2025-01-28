<?php
require './ClienteController.php';

header("Content-Type: application/json"); # Establece que el tipo de respuesta va a ser en formato json.
header("Access-Control-Allow-Origin: *"); # Permite que cualquier origen (dominio) pueda acceder a la API.
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE"); # Establece los metodos permitidos para acceder a la API.
header("Access-Control-Allow-Headers: Content-Type"); # Establece los headers permitidos para acceder a la API.

$client_controller = new ClienteController();
$request_type = $_SERVER["REQUEST_METHOD"];

switch ($request_type) {
    case "GET":
        $id = $_GET["id"];

        if (isset($id)) {
            $data = $client_controller->getDataById($id);
            $response_code = ($data["status"]) ? 200 : 404;

            http_response_code($response_code);
            $json_data = json_encode($data);
            echo $json_data;

            exit;
        }

        $data = $client_controller->getAllData();
        $response_code = ($data["status"]) ? 200 : 404;

        http_response_code($response_code); # Se asigna un codigo de respuesta http.
        $json_data = json_encode($data);
        echo $json_data;

        exit;
    case "POST":
        $data = [
            "full_name" => $_POST['full_name'],
            "CI" => $_POST['CI'],
            "email" => $_POST['email']
        ];

        $data = $client_controller->saveData($data);
        $response_code = ($data["status"]) ? 201 : 404;

        http_response_code($response_code); # Se asigna un codigo de respuesta http.
        $json_data = json_encode($data);
        echo $json_data;

        exit;
    case "PUT";
        break;
    case "DELETE";
        break;
    default:
        http_response_code(405);
        $json_data = json_encode([
            "data" => [],
            "status" => 405,
            "message" => "¡Metodo no permitido!"
        ]);
        echo $json_data;

        exit;
}
