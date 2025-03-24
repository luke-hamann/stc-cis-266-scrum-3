<?php
if ($_POST) {
    require_once '../classes/DB.php';

    $id = $_POST['id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $hireDate = $_POST['hireDate'];
    $salary = $_POST['salary'];
    $commissionPercent = $_POST['commissionPercent'];

    $salesperson = new Salesperson($id, $firstName, $lastName, $hireDate, $salary, $commissionPercent);

    $db = new DB();

    if ($db->updateSalesperson($salesperson)) {
        $array = array('message' => 'Salesperson updated successfully!');
    } else {
        $array = array('message' => 'Salesperson not found.');
    }

    header('Content-Type: application/json');
    print(json_encode($array));
}
?>
