<?php  
 ob_start();
 session_start();
require_once '../../actions/dbConnect.php';




if(!isset($_SESSION["business"]))
{ 
  header("Location: ../index.php");
  exit;
}


$business = $_SESSION['business'];
$sql = "SELECT * FROM business WHERE businessId = '$business'";
$row = mysqli_query($connect, $sql);

$business = $row->fetch_assoc();
$id = $business['businessId'];





?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $business['username']?>´s Account</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="../../assets/css/admin_superadmin.css">
  <link rel="stylesheet" type="text/css" href="../../assets/css/navbar.css">
  <link rel="stylesheet" type="text/css" href="../../assets/css/index.css">
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500&display=swap" rel="stylesheet">
</head>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500&display=swap');
  </style>
<body>
  <div class="box">
    
<a href="../index.php" class="mediaNav">
  <img src="../../assets/img/Logo.png" alt="" width="200" height="100">
  </a>
  
  <a href="https://codefactory.wien/de/home/" class="noBG mediaNav">
    <img class="noBG" src="../../assets/img/cropped-Logo-2.png" alt="" width="250" height="100" >
  </a>

<div class="right">
 
  <a href="studentPortal.php" class="inline padding linkB">Student Portal</a>
  <a href="jobwallBusiness.php" class="inline padding linkB">Job Wall</a>

  <div class="dropdownB inline padding blue">
    <a href="#" class="dropbtn">My Account</a>
    <div class="dropdown-content">
      <a href="../logout.php?logout">Log out</a>
    </div>
  </div>
 </div>
</div>
<br>
<div class="container-fluid businessAccount">
  <div class="row justify-content-around">
    <div class="col-sm-8 bg-light rounded mt-5 mb-5">
      <h1 class="m-3">Your data table, please fill in </h1>
      <img style="width: 10rem;" src="<?php echo $business['img'] ?>"  alt="">
    	<form action="../../actions/OeditB.php" method="post">
    		<input type="hidden" name="businessId" id="<?php echo $business['businessId']; ?>" value="<?php echo $business['businessId'] ?>">
        <label class="text-dark" for="exampleFormControlInput1">Username:</label>
    		<input class="form-control" type="text" name="username" value="<?php echo $business['username'] ?>">
        <label class="text-dark" for="exampleFormControlInput1">Company:</label>
    		<input class="form-control" type="text" name="company" value="<?php echo $business['company'] ?>">
        <label class="text-dark" for="exampleFormControlInput1">E-mail:</label>
    		<input class="form-control" type="text" name="email" value="<?php echo $business['email'] ?>">
        <label class="text-dark" for="exampleFormControlInput1">Phone number:</label>
    		<input class="form-control" type="text" name="phone" value="<?php echo $business['phone'] ?>">
        <label class="text-dark" for="exampleFormControlInput1">Image:</label>
    		<input class="form-control" type="text" name="img" value="<?php echo $business['img'] ?>">
        <label class="text-dark" for="exampleFormControlInput1">Job position:</label>
    		<input class="form-control" type="text" name="jobPosition" value="<?php echo $business['jobPosition'] ?>">
        <label class="text-dark" for="exampleFormControlInput1">Location:</label>
    		<input class="form-control" type="text" name="location" value="<?php echo $business['location'] ?>">
        <label class="text-dark" for="exampleFormControlInput1">Sectors:</label>
    		<input class="form-control" type="text" name="sectors" value="<?php echo $business['sectors'] ?>">
        <label class="text-dark" for="exampleFormControlInput1">Password:</label>
    		<input class="form-control" type="text" name="password" value="<?php echo $business['password'] ?>">
    		<input class="btn btn-dark btn-lg m-4" type="submit" name="" value="Edit">
    	</form>
      </div>
    
  </div>
  
</div>


</body>
</html>
