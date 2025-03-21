<?php
if ($_GET) {
    require_once '../classes/DB.php';

    $id = $_GET['id'];

    $db = new DB();
    $car = $db->readCar($id);

    if ($car == null) {
        $array = array('message' => 'Car not found.');
    } else {
        $array = array(
            'message' => 'Car found.',
            'car' => array(
                'id' => $car->getId(),
                'make' => $car->getMake(),
                'model' => $car->getModel(),
                'year' => $car->getYear(),
                'color' => $car->getColor(),
                'price' => $car->getPrice()
            )
        );
    }

    header('Content-Type: application/json');
    print(json_encode($array));
}
?>
