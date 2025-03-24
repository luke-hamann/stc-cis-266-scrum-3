<?php
if ($_POST) {
    require_once '../classes/DB.php';

    $id = $_POST['id'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $color = $_POST['color'];
    $price = $_POST['price'];

    $car = new Car($id, $make, $model, $year, $color, $price);

    $db = new DB();

    if ($db->updateCar($car)) {
        $array = ['message' => 'Car updated successfully!'];
    } else {
        $array = ['message' => 'Car not found.'];
    }

    header('Content-Type: application/json');
    print(json_encode($array));
}
?>
