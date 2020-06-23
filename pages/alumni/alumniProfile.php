<?php
ob_start();
session_start();

require_once '../../actions/dbConnect.php';

if(!isset($_SESSION["business"]))
{ 
  header("Location: ../index.php");
  exit;
}


if($_GET["id"]){
	$id = $_GET["id"];

	$sql = "SELECT * FROM alumni WHERE alumniId = $id";
	$result = mysqli_query($connect, $sql);

	$row = $result->fetch_assoc();
}

if($_GET["id"]){
	$id2 = $_GET["id"];

	$sql2 = "SELECT * FROM skill WHERE skillId = $id";
	$result2 = mysqli_query($connect, $sql2);

	$row2 = $result2->fetch_assoc();
}


?>




<!DOCTYPE html>
<html>
<head>
	<title> <?php echo $row['firstname']?>´s Profile</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../assets/css/alumniProfile/apStyle.css">
	<link rel="stylesheet" type="text/css" href="../../assets/css/navbar.css">
	<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500&display=swap" rel="stylesheet">
</head>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500&display=swap');
  </style>
<body>



  <div class="box">
    
<a href="../index.php">
  <img src="../../assets/img/Logo.png" alt="" width="200" height="100">
  </a>
  
  <a href="https://codefactory.wien/de/home/" class="noBG">
    <img class="noBG" src="../../assets/img/cropped-Logo-2.png" alt="" width="250" height="100" >
  </a>

<div class="right">
  <div class="dropdownB inline padding">
    <a href="../index.php" class="dropbtn">About us</a>
    <div class="dropdown-content">
      <a href="successStories.php">Success stories</a>
      <a href="../careerOpportunities.php">Career</a>
      <a href="../../events.php">Events</a>
    </div>
  </div>

  <a href="../business/studentPortal.php" class="inline padding linkB">Student Portal</a>
  <a href="../business/jobwallBusiness.php" class="inline padding linkB">Job Wall</a>

  <div class="dropdownB inline padding blue">
    <a href="../business/businessAccount.php" class="dropbtn">My Account</a>
    <div class="dropdown-content">
      <a href="../logout.php?logout">Log out</a>
    </div>
  </div>
 </div>
</div>


<hr>


<h1 class ="profile"><?php echo $row['firstname']?>´s Profile</h1>


<div class = "container">


	<div class ="top">
	
		<div class = "topleft">
			<img src=" <?php echo $row['img'] ?> " alt="">
		</div>

		<div class="topright">
				
			<p class = "name"><?php echo $row['firstname']?> <?php echo $row['lastname']?></p>
			<a class = "portfolio" href="<?php echo $row['portfolioUrl']?>">My Portfolio</a>
			

				<?php 
				if($row['jobStatus'] == 0)
				{
					echo "<a class = 'available' href ='https://codefactory.wien/en/contact-en/'>Contact me</a>";
				}
				else
				{
					echo "<p class= 'unavailable'>Unavailable</p>";
				}

				?>
				


			

		</div>

	</div>




	<div class = "bottom">
		<p class = "description">
			<?php echo $row['description']?>
		</p>

		<div class = "skills">

			<p>My Skills:</p>

			<div class ="list">
				
			
				<?php

				if($result2)
				{
					$names = mysqli_num_fields($result2);
					$value = mysqli_fetch_row($result2);

					for($i=0; $i<$names; $i++)
					{
						$meta = mysqli_fetch_field($result2);

						if($row2[$meta->name]==1)
						{
						echo '<div >'. $meta->name .'</div>';
						}
					}
				}

				?>
			</div>
		</div>
	</div>

	<div>

	</div>


	
</div>


</body>
</html>