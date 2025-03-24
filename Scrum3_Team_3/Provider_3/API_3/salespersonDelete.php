<?php
if ($_POST) {
    require_once '../classes/DB.php';

    $id = $_POST['id'];

    $db = new DB();

    if ($db->deleteSalesperson($id)) {
        $array = array('message' => 'Salesperson deleted successfully!');
    } else {
        $array = array('message' => 'Salesperson not found.');
    }

    header('Content-Type: application/json');
    print(json_encode($array));
}
?>
