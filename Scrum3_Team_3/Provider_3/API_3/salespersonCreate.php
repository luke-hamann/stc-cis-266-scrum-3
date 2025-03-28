<?php
if ($_POST) {
    require_once '../classes/DB.php';

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $hireDate = $_POST['hireDate'];
    $salary = $_POST['salary'];
    $commissionPercent = $_POST['commissionPercent'];

    $salesperson = new Salesperson(0, $firstName, $lastName, $hireDate, $salary, $commissionPercent);

    $db = new DB();
    $id = $db->insertSalesperson($salesperson);

    if ($id) {
        $array = [
            'message' => 'Salesperson created successfully!',
            'id' => $id
        ];
    } else {
        $array = ['message' => 'Salesperson not created.'];
    }

    header('Content-Type: application/json');
    print(json_encode($array));
}
?>
