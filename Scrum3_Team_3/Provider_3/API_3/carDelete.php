<?php
if ($_POST) {
    require_once '../classes/DB.php';

    $id = $_POST['id'];

    $db = new DB();

    if ($db->deleteCar($id)) {
        $array = ['message' => 'Car deleted successfully!'];
    } else {
        $array = ['message' => 'Car not found.'];
    }

    header('Content-Type: application/json');
    print(json_encode($array));
}
?>
