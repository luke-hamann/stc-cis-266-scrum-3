<?php
if ($_GET) {
    require_once '../classes/DB.php';

    $id = $_GET['id'];

    $db = new DB();
    $customer = $db->readCustomer($id);

    if ($customer == null) {
        $array = ['message' => 'Customer not found.'];
    } else {
        $array = [
            'message' => 'Customer found!',
            'customer' => [
                'id' => $customer->getId(),
                'firstName' => $customer->getFirstName(),
                'lastName' => $customer->getLastName(),
                'phone' => $customer->getPhone(),
                'email' => $customer->getEmail(),
                'address' => $customer->getAddress()
            ]
        ];
    }

    header('Content-Type: application/json');
    print(json_encode($array));
}
?>
