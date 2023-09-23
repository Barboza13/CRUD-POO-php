<?php
require "./CRUD.php";

$CRUD = new CRUD();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        "full_name" => $_POST['full_name'],
        "CI" => $_POST['CI'],
        "email" => $_POST['email']
    ];
    
    if ($CRUD->saveData($data)) {
        echo "Datos guardados.";
    }
} else {
    $data = $CRUD->getAllData();
    $jsonData = json_encode($data);
    header('Content-Type: application/json');
    echo $jsonData;
}
