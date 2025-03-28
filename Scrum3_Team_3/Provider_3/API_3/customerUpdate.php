<?php
if ($_POST) {
    require_once '../classes/DB.php';

    $id = $_POST['id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $customer = new Customer($id, $firstName, $lastName, $phone, $email, $address);

    $db = new DB();

    if ($db->updateCustomer($customer)) {
        $array = ['message' => 'Customer updated successfully!'];
    } else {
        $array = ['message' => 'Customer not found.'];
    }

    header('Content-Type: application/json');
    print(json_encode($array));
}
?>
