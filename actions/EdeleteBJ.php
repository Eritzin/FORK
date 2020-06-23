<?php 
ob_start();
session_start();
require_once 'dbConnect.php';



//echo "<h1>".$id."</h1>";
if ($_POST) {
   $id = $_POST['id'];
   echo "<h1>".$id."</h1>";
   $sql = "DELETE FROM jobs WHERE jobsId ='".$id."'";
   echo "<h1>". $sql."</h1>";
    if($connect->query($sql) === TRUE) {

       header("Location:../pages/business/jobwallBusiness.php");
  
   } else {
       echo "Error updating record : " . $connect->error;
   }

   $connect->close();
}

?>