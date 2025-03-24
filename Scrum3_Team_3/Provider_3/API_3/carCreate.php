<?php
if ($_POST) {
    require_once '../classes/DB.php';

    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $color = $_POST['color'];
    $price = $_POST['price'];

    $car = new Car(0, $make, $model, $year, $color, $price);

    $db = new DB();
    $id = $db->insertCar($car);

    if ($id) {
        $array = [
            'message' => 'Car created successfully!',
            'id' => $id
        ];
    } else {
        $array = ['message' => 'Car could not be created.'];
    }

    header('Content-Type: application/json');
    print(json_encode($array));
}
?>
