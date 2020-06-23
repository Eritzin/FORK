<?php  
require_once 'jFetch.php';

$firstname = $_POST['firstname'];

$con = new DB();
$data = $con->searchData($firstname);

echo json_encode($data);

?>