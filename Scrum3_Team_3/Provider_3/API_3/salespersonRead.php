<?php
if ($_GET) {
    require_once '../classes/DB.php';

    $id = $_GET['id'];

    $db = new DB();
    $salesperson = $db->readSalesperson($id);

    if ($salesperson == null) {
        $array = array('message' => 'Salesperson not found.');
    } else {
        $array = array(
            'message' => 'Salesperson found!',
            'salesperson' => array(
                'id' => $salesperson->getId(),
                'firstName' => $salesperson->getFirstName(),
                'lastName' => $salesperson->getLastName(),
                'hireDate' => $salesperson->getHireDate(),
                'salary' => $salesperson->getSalary(),
                'commissionPercent' => $salesperson->getCommissionPercent()
            )
        );
    }

    header('Content-Type: application/json');
    print(json_encode($array));
}
?>
