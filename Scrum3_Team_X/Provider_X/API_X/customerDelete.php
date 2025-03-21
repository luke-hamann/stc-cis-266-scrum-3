<?php
if ($_POST) {
    require_once '../classes/DB.php';

    $id = $_POST['id'];

    $db = new DB();

    if ($db->deleteCustomer($id)) {
        $array = array('message' => 'Customer deleted successfully!');
    } else {
        $array = array('message' => 'Customer not found.');
    }

    header('Content-Type: application/json');
    print(json_encode($array));
}
?>
