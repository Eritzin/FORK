<?php
ob_start();
session_start();

require_once '../../actions/dbConnect.php';


if(!isset($_SESSION["alumni"]))
{	
	header("Location: ../index.php");
	exit;
}


$alumni = $_SESSION['alumni'];

$sql = "SELECT * FROM alumni WHERE alumniId = $alumni";
$row = mysqli_query($connect, $sql);

$alumni = $row->fetch_assoc();
$id = $alumni['alumniId'];



$sql3 = "SELECT skill_name FROM skill";
$result3 = mysqli_query($connect, $sql3);


?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $alumni['firstname']?>´s Account</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="../../assets/css/navbar.css">
	<link rel="stylesheet" type="text/css" href="../../assets/css/index.css">
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../../assets/css/admin_superadmin.css">
</head>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500&display=swap');
  </style>
<body>


  <div class="box">
    
<a href="../index.php" class="mediaNav">
  <img src="../../assets/img/Logo.png" alt="" width="200" height="100">
  </a>
  
  <a href="https://codefactory.wien/de/home/" class="mediaNav">
    <img src="../../assets/img/cropped-Logo-2.png" alt="" width="250" height="100" class="noBG">
  </a>

<div class="right">
  <div class="dropdown inline padding">
    <a href="../index.php" class="dropbtn ">About us</a>
    <div class="dropdown-content">
      <a href="successStories.php">Success stories</a>
      <a href="../careerOpportunities.php">Career</a>
      <a href="../events.php">Events</a>
    </div>
  </div>


  <a href="jobwallAlumni.php" class="inline padding link">Job Wall</a>

  <div class="dropdown inline padding red">
    <a href="#" class="dropbtn">My Account</a>
    <div class="dropdown-content">
      <a href="../logout.php?logout">Log out</a>
    </div>
  </div>
 </div>
</div>

<br>
<div class="container-fluid alumniAccount">
	<div class="row justify-content-around">
		<div class="col-sm-8 bg-light rounded mt-5 mb-5">
			<h1 class="m-3">Your data table, please fill in </h1>
			<img style="width: 10rem;" src="<?php echo $alumni['img'] ?>"  alt="">
			<form action="../../actions/OeditA.php" method="post">
			<input type="hidden" name="id" value="<?php echo $alumni['alumniId'] ?>">
			<label class="text-dark" for="exampleFormControlInput1">First name:</label>
			<input class="form-control" type="text" name="firstname" value="<?php echo $alumni['firstname'] ?>">
			<label class="text-dark" for="exampleFormControlInput1">Last name:</label>
			<input class="form-control" type="text" name="lastname" value="<?php echo $alumni['lastname'] ?>">
			<label class="text-dark" for="exampleFormControlInput1">E-mail:</label>
			<input class="form-control" type="text" name="email" value="<?php echo $alumni['email'] ?>">
			<label class="text-dark" for="exampleFormControlInput1">Date of birth:</label>
			<input class="form-control" type="date" name="birth" value="<?php echo $alumni['birth'] ?>">
			<label class="text-dark" for="exampleFormControlInput1">Phone:</label>
			<input class="form-control" type="text" name="phone" value="<?php echo $alumni['phone'] ?>">
			<label class="text-dark" for="exampleFormControlInput1">Image:</label>
			<input class="form-control" type="text" name="img" value="<?php echo $alumni['img'] ?>">
			<label class="text-dark" for="exampleFormControlInput1">Job status:</label>
			<select class="form-control" name="jobStatus">
	  		<option value="0">unavailable</option>
	  		<option value="1">avilable</option>
	  		</select>
	  		<label class="text-dark" for="exampleFormControlInput1">Description:</label>
			<input class="form-control" type="text" name="description" value="<?php echo $alumni['description'] ?>">
			<label class="text-dark" for="exampleFormControlInput1">Portfolio URL:</label>
			<input class="form-control" type="text" name="portfolioUrl" value="<?php echo $alumni['portfolioUrl'] ?>">
			<label class="text-dark" for="exampleFormControlInput1">Location:</label>
			<input class="form-control" type="text" name="location" value="<?php echo $alumni['location'] ?>">
			<label class="text-dark" for="exampleFormControlInput1">Education:</label>
			<input class="form-control" type="text" name="education" value="<?php echo $alumni['education'] ?>">
			<br>
			<hr>
			<h1 class="m-3">Your skill table, please fill in </h1>

				<?php

				while($row3 = $result3->fetch_assoc()){
					$sql2 = "SELECT * FROM skill INNER JOIN skill_alumni ON skillId = fk_skillId WHERE (fk_alumniId =".$id." AND skill_name='".$row3['skill_name']."')";
					$result2 = mysqli_query($connect, $sql2);
	   
                     if($result2->num_rows>0){ // check if the skill was selected. 
                         echo " <div class=\"form-check\">
                              <input type='checkbox' id='".$row3['skill_name']."' class='value form-check-input-lg' name='".$row3['skill_name']."' value =1 checked>
                              <label class='form-check-label col-form-label-lg' for='".$row3['skill_name']."'>".$row3['skill_name']."</label>  
                         </div>";
                          }else{  

            	           echo " <div class=\"form-check\"> 
            	               <input type='checkbox' id='".$row3['skill_name']."' class='value form-check-input-lg' name='".$row3['skill_name']."' value =1 >
                               <label class='form-check-label col-form-label-lg' for='".$row3['skill_name']."'>".$row3['skill_name']."</label>  
                           </div>";
        	
                        };

                     }
				?>

			
				<input class="btn btn-dark btn-lg m-4" type="submit" value="Submit">

			</form>


		</div>
		
	</div>
	
</div>

</body>
</html>