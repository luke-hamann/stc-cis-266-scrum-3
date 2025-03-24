<?php
if ($_POST) {
    require_once '../classes/DB.php';

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $customer = new Customer(0, $firstName, $lastName, $phone, $email, $address);

    $db = new DB();
    $id = $db->insertCustomer($customer);

    if ($id) {
        $array = [
            'message' => 'Customer created successfully!',
            'id' => $id
        ];
    } else {
        $array = ['message' => 'Customer not created.'];
    }

    header('Content-Type: application/json');
    print(json_encode($array));
}
?>
