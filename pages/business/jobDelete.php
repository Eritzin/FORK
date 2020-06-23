
<?php 
ob_start();
session_start();
require_once '../../actions/dbConnect.php';
if(!isset($_SESSION['business']))
    {
      header("Location:businessSignup.php");
       exit;
    }

if ($_GET["id"]) {
   $id = $_GET["id"];
    
   $sql = "SELECT * FROM jobs WHERE jobsId = {$id}" ;
   $result = $connect->query($sql);
   $data = $result->fetch_assoc();

   $connect->close();
?>

<!DOCTYPE html>
<html>
<head>
   <title >Delete Job</title>
</head>
<body>
 <h3>Do you really want to delete this job?</h3>
 <input type="hidden" name= "id" value="<?php echo $data['jobsId'] ?>" />

</body>
</html>

<?php
}
?>
