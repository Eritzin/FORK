<?php
ob_start();
session_start();
require_once '../../actions/dbConnect.php';


$error = false;
$emailError = "";
$passwordError = "";
$email = "";
$password = "";

//-------------------------------

if(isset($_POST['btn-signin']))
{
	$email = trim($_POST['email']);
	$email = strip_tags($email);
	$email = htmlspecialchars($email);

	$password = trim($_POST['password']);
	$password = strip_tags($password);
	$password = htmlspecialchars($password);

//-------------------------------

	if(empty($email))
	{
		$error = true;
		$emailError = "Please enter your email address";
	}
	elseif(!filter_var($email,FILTER_VALIDATE_EMAIL))
	{
		$error = true;
		$emailError = "Please enter a valid email address";
	}

	//-------------------------------

		if(empty($password))
		{
			$error = true;
			$passwordError = "Enter a password";
		}
		else if (strlen($password) < 6)
		{
			$error = true;
			$passwordError = "Your Password is atleast 6 characters long!";
		}

	//-------------------------------

	if(!$error)
	{
		// $password = hash('sha256',$password);

		$result = mysqli_query($connect, "SELECT alumniId, email, password, admin FROM alumni WHERE email = '$email'");
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$count = mysqli_num_rows($result);

		if($count)
		{
			if($row["admin"] == 1)
			{
				$_SESSION["alumni"] = $row["alumniId"];
				header("Location: alumni/alumniAccount.php");
			}
			elseif($row["admin"] == 2)
			{
				$_SESSION["alumni"] = $row["alumniId"];
				header("Location: alumni/alumniAccount.php");
			}
			else
			{
			$_SESSION['alumni'] = $row['alumniId'];
			header("Location: alumni/alumniAccount.php");	
			}
			$errMSG = "logged in.";	
		}
		else
		{
			$result = mysqli_query($connect, "SELECT businessId, email, password FROM business WHERE email = '$email'");
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$count = mysqli_num_rows($result);
		}


		if($count == 1 && $row['password'] == $password)
		{
			if($row["businessId"])
			{
				$_SESSION["business"] = $row["businessId"];
				header("Location: business/businessAccount.php");
				
			}
			else
			{
				$_SESSION["alumni"] = $row["alumniId"];
				header("Location: alumni/alumniAccount.php");
			}

		}
		else
		{
			$errMSG = "This user is not registered, try again...";
			echo $count;
			echo $password;
		}
	}
}




?>

<!DOCTYPE html>
<html>
<head>
	<title>superadmin</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="../../assets/css/admin_superadmin.css">
		<link rel="stylesheet" type="text/css" href="../../assets/css/navbar.css">
</head>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500&display=swap');
  </style>
<body>
	<div class="box">
    
<a href="../index.php">
  <img src="../../assets/img/Logo.png" alt="" width="200" height="100">
  </a>

<div class="right">
  <div class="dropdown inline padding">
      <a href="../logout.php?logout">Log out</a>
    </div>
  </div>
 </div>
	<h1 class="display-2 text-center">Super Admin Page</h1>
	<div class="container-fluid text-center mb-4">
		<h1>Alumni Account</h1>
		<a type="button" class="btn btn-dark btn-lg" href="alumniCreate.php">create an alumni account</a>
	</div>
	

	<div class="container-fluid alumniAccount">
		<div class="row justify-content-around">

        <?php
        $sql = "SELECT alumni.alumniId, alumni.firstname, alumni.lastname, alumni.email, alumni.birth, alumni.phone, alumni.img, alumni.jobStatus, alumni.description, alumni.portfolioUrl, alumni.location, alumni.education, alumni.password, alumni.favJobs, alumni.admin, skill.skillId, skill.html, skill.css, skill.javascript, skill.bootstrap, skill.mysql, skill.php, skill.symfony,skill.python, skill.java, skill.typescript,skill.jquery, skill.latex, skill.angular   FROM alumni
			inner JOIN skill on skillid = fk_skillId";


		$res=mysqli_query($connect, $sql);
	

         if ($res->num_rows == 0){
			echo "No result";
		 }elseif($res->num_rows == 1){
		 	$row = $res->fetch_assoc();
		  	 echo  $row["alumniId"]." ".$row["firstname"]. " ". $row["lastname"]. "  ". $row["email"]. " ".$row["birth"]. " ".$row["phone"]." ".$row["img"]. " ".$row["jobStatus"]. "  ".$row["description"]. "  ".$row["portfolioUrl"]."   ".$row["location"]."   ".$row["education"]."   ".$row["password"]." ".$row["favJobs"]." ".$row["admin"];
		 }
		else {
		 $alumniRow=$res->fetch_all(MYSQLI_ASSOC);			
		foreach ($alumniRow as $key => $value) {
		
		echo '


		<div class="card m-4" style="width: 18rem;">
				  <img src='.$value["img"].' class="card-img-top" alt="...">
				  <div class="card-body">
				    <h3 class="card-title">First name:</h3>
				    <h4> '.$value["firstname"].'</h4><br> 
				    <h3 class="card-title">Last name:</h3> 
				    <h4>'.$value["lastname"].'</h4><br> 
				    <hr>
			    	<h5>E-mail:</h5> <h6>'.$value["email"].'</h6>
			    	<h5>Date of Birth:</h5><h6>'. $value["birth"]. '</h6>
			    	<h5>Phone number:</h5><h6>'. $value["phone"]. '</h6>
			    	<h5>Job Status:</h5><h6>'. $value["jobStatus"]. '</h6>
			    	<h5>Description:</h5><h6>'. $value["description"]. '</h6>
			    	<h5>Portfolio URL:</h5><h6>'. $value["portfolioUrl"]. '</h6>
			    	<h5>Location:</h5><h6>'. $value["location"]. '</h6>
			    	<h5>Educatoin:</h5><h6>'. $value["education"]. '</h6>
			    	<h5>Password:</h5><h6>'. $value["password"]. '</h6>
			    	<h5>Favorite Jobs:</h5><h6>'. $value["favJobs"]. '</h6>
			    	<h5>Admin:</h5><h6>'. $value["admin"]. '</h6>
			    	<h5>Skill Id:</h5><h6>'. $value["skillId"]. '</h6>
				    <hr>


					'?>
					<h5>Account Status: </h5>
					<?php if($value['admin'] ==2){ 
						echo ' <h6>Superadmin</h6>';
					}elseif($value['admin'] ==1){
						echo ' <h6>Admin</h6>';
					}else{
						echo ' <h6>Alumni</h6>';
					}?>

					<hr>
					<label for="html">HTML</label>
					<input type="checkbox" id="html" name="html"  value='' <?php  if($value['html'] == 1) echo 'checked="checked"'; ?> ><br>
					<label for="css">CSS</label>
					<input type="checkbox" id="html" name="html"  value='' <?php  if($value['css'] == 1) echo 'checked="checked"'; ?> ><br>
					<label for="javascript">Javascript</label>
					<input type="checkbox" id="html" name="html"  value='' <?php  if($value['javascript'] == 1) echo 'checked="checked"'; ?> ><br>
					<label for="bootstrap">Bootstrap</label>
					<input type="checkbox" id="html" name="html"  value='' <?php  if($value['bootstrap'] == 1) echo 'checked="checked"'; ?> ><br>
					<label for="mysql">MySQL</label>
					<input type="checkbox" id="html" name="html"  value='' <?php  if($value['mysql'] == 1) echo 'checked="checked"'; ?> ><br>
					<label for="php">PHP</label>
					<input type="checkbox" id="html" name="html"  value='' <?php  if($value['php'] == 1) echo 'checked="checked"'; ?> ><br>
					<label for="symfony">Symfony</label>
					<input type="checkbox" id="html" name="html"  value='' <?php  if($value['symfony'] == 1) echo 'checked="checked"'; ?> ><br>
					<label for="python">Python</label>
					<input type="checkbox" id="html" name="html"  value='' <?php  if($value['python'] == 1) echo 'checked="checked"'; ?> ><br>
					<label for="java">Java</label>
					<input type="checkbox" id="html" name="html"  value='' <?php  if($value['java'] == 1) echo 'checked="checked"'; ?> ><br>
					<label for="typescript">Typescript</label>
					<input type="checkbox" id="html" name="html"  value='' <?php  if($value['typescript'] == 1) echo 'checked="checked"'; ?> ><br>
					<label for="jquery">JQuery</label>
					<input type="checkbox" id="html" name="html"  value='' <?php  if($value['jquery'] == 1) echo 'checked="checked"'; ?> ><br>
					<label for="latex">LaTex</label>
					<input type="checkbox" id="html" name="html"  value='' <?php  if($value['latex'] == 1) echo 'checked="checked"'; ?> ><br>
					<label for="angular">Angular</label>
					<input type="checkbox" id="html" name="html"  value='' <?php  if($value['angular'] == 1) echo 'checked="checked"'; ?> ><br><br>

					<?php 
						if($value['admin'] == 0 ){
							echo'<a class="btn btn-dark btn-lg" href="../../actions/fDeleteAlumni.php?id='.$value["alumniId"].'">Delete</a>
							<a class="btn btn-dark btn-lg" href="alumniUpdate.php?id='.$value["alumniId"].'">Update</a>';
						}elseif($value['admin'] == 1){
							echo'<a class="btn btn-dark btn-lg" href="../../actions/fDeleteAlumni.php?id='.$value["alumniId"].'">Delete</a>
							<a class="btn btn-dark btn-lg" href="alumniUpdate.php?id='.$value["alumniId"].'">Update</a>';
						}

					echo'
					
			      
				  </div>
				</div>
				'; 
			}
		}
		?>
		</div>
	</div>

	<br>

	<div class="container text-center mb-4">
		<h1>Business account</h1>
		<a type="button" class="btn btn-dark btn-lg" href="../business/businessCreate.php">create a business account</a>
	</div>
	
	<div class="container-fluid businessAccount">
		<div class="row justify-content-around">

        <?php
        $bsql = "SELECT business.businessId, business.username, business.company, business.email, business.phone, business.img, business.jobPosition, business.location, business.sectors, business.favorites, business.password,skill.skillId, skill.html, skill.css, skill.javascript, skill.bootstrap, skill.mysql, skill.php, skill.symfony,skill.python, skill.java, skill.typescript,skill.jquery, skill.latex, skill.angular   FROM business
			inner JOIN skill on skillid = fk_skillId";

		$bres=mysqli_query($connect, $bsql);	

         if ($bres->num_rows == 0){
			echo "No result";
		 }elseif($bres->num_rows == 1){
		 	$row = $bres->fetch_assoc();
		  	 echo  $row["businessId"]." ".$row["username"]. " ". $row["company"]. " ".$row["email"]. " ". $row["phone"]. " ". $row["img"]. " ".$row["jobPosition"]. " ".$row["location"]." ".$row["sectors"]. " ".$row["favorites"]." ".$row["password"]."<a href='../../actions/fDeleteBusiness.php?id=".$value["businessId"]."'>Delete</a><a href='../business/businessUpdate.php?id=".$value["businessId"]."'>Update</a>";
		 }
		else {
		 $businessRow=$bres->fetch_all(MYSQLI_ASSOC);			
		foreach ($businessRow as $key => $value) {
		echo '<div class="card m-4" style="width: 18rem;">
			  <img src='.$value["img"].' class="card-img-top" alt="...">

			  <div class="card-body">
			    <h5 class="card-title">Username: </h5>
			    <h6>'.$value["username"].'</h6>
			    <hr>
			    <h5>Company:</h5><h6>'.$value["company"].'</h6>
			    <h5>E-mail:</h5><h6>'.$value["email"].'</h6>
			    <h5>Phone number:</h5><h6>'.$value["phone"].'</h6>
			    <h5>Job position:</h5><h6>'. $value["jobPosition"].'</h6>
			    <h5>Location:</h5><h6>'. $value["location"].'</h6>
			    <h5>Sectors:</h5><h6>'. $value["sectors"]. '</h6>
			    <h5>Favorites:</h5><h6>'. $value["favorites"]. '</h6>
			    <h5>Password:</h5><h6>'. $value["password"].'</h6>
			    <h5>Skill Id:</h5><h6>'. $value["skillId"].'</h6>
			    <hr>
			    '?>
				<label for="html">HTML</label>
				<input type="checkbox" id="html" name="html"  value='' <?php  if($value['html'] == 1) echo 'checked="checked"'; ?> ><br>
				<label for="css">CSS</label>
				<input type="checkbox" id="html" name="html"  value='' <?php  if($value['css'] == 1) echo 'checked="checked"'; ?> ><br>
				<label for="javascript">Javascript</label>
				<input type="checkbox" id="html" name="html"  value='' <?php  if($value['javascript'] == 1) echo 'checked="checked"'; ?> ><br>
				<label for="bootstrap">Bootstrap</label>
				<input type="checkbox" id="html" name="html"  value='' <?php  if($value['bootstrap'] == 1) echo 'checked="checked"'; ?> ><br>
				<label for="mysql">MySQL</label>
				<input type="checkbox" id="html" name="html"  value='' <?php  if($value['mysql'] == 1) echo 'checked="checked"'; ?> ><br>
				<label for="php">PHP</label>
				<input type="checkbox" id="html" name="html"  value='' <?php  if($value['php'] == 1) echo 'checked="checked"'; ?> ><br>
				<label for="symfony">Symfony</label>
				<input type="checkbox" id="html" name="html"  value='' <?php  if($value['symfony'] == 1) echo 'checked="checked"'; ?> ><br>
				<label for="python">Python</label>
				<input type="checkbox" id="html" name="html"  value='' <?php  if($value['python'] == 1) echo 'checked="checked"'; ?> ><br>
				<label for="java">Java</label>
				<input type="checkbox" id="html" name="html"  value='' <?php  if($value['java'] == 1) echo 'checked="checked"'; ?> ><br>
				<label for="typescript">Typescript</label>
				<input type="checkbox" id="html" name="html"  value='' <?php  if($value['typescript'] == 1) echo 'checked="checked"'; ?> ><br>
				<label for="jquery">JQuery</label>
				<input type="checkbox" id="html" name="html"  value='' <?php  if($value['jquery'] == 1) echo 'checked="checked"'; ?> ><br>
				<label for="latex">LaTex</label>
				<input type="checkbox" id="html" name="html"  value='' <?php  if($value['latex'] == 1) echo 'checked="checked"'; ?> ><br>
				<label for="angular">Angular</label>
				<input type="checkbox" id="html" name="html"  value='' <?php  if($value['angular'] == 1) echo 'checked="checked"'; ?> ><br><br>


			    <?php
			    echo'
			    <a class="btn btn-dark btn-lg" href="../../actions/fDeleteBusiness.php?id='.$value["businessId"].'">Delete</a>
			    <a class="btn btn-dark btn-lg" href="../business/businessUpdate.php?id='.$value["businessId"].'">Update</a>
			  </div>
			</div>
			';
			}
		}
		?>
		</div>
	</div>
		<br>
		
	<div class="container-fluid text-center mb-4">
		<h1>Jobs</h1>
		<a type="button" class="btn btn-dark btn-lg" href="../business/jobCreate.php">create a job account</a>
	</div>
	
	<div class="container-fluid jobAccount">
		<div class="row justify-content-around">

        <?php
        $jsql = "SELECT jobs.jobsId, jobs.jobTitle, jobs.description, jobs.jLocation, jobs.technologies, jobs.salary, jobs.hours, jobs.active, jobs.timestamp, jobs.moreSkills,skill.skillId, skill.html, skill.css, skill.javascript, skill.bootstrap, skill.mysql, skill.php, skill.symfony,skill.python, skill.java, skill.typescript,skill.jquery, skill.latex, skill.angular, business.username, business.businessId from jobs
        inner JOIN skill on skillId = fk_skillId
        inner JOIN business on businessId = fk_businessId";

		$jres=mysqli_query($connect, $jsql);

         if ($jres->num_rows == 0){
			echo "No result";
		 }elseif($jres->num_rows == 1){
		 	$row = $jres->fetch_assoc();
		  	 echo  $row["jobsId"]." ".$row["jobTitle"]. " ". $row["description"]. " ".$row["jLocation"]. " ". $row["technologies"]. " ".$row["salary"]. " ".$row["hours"]." ".$row["active"]. " ".$row["timestamp"]." ".$row["moreSkills"];
		 }
		else {
		$jobRow=$jres->fetch_all(MYSQLI_ASSOC);			
		foreach ($jobRow as $key => $value) {
		echo '
			<div class="card m-4" style="width: 18rem;">
			  <div class="card-body">
			    <h5 class="card-title">Job: </h5>
			    <h6>'.$value["jobTitle"].'</h6>
				<hr><hr>
				<h5>Job article nr.: </h5><h6>'.$value["jobsId"].'</h6>
				<h5>Description: </h5><h6>'.$value["description"].'</h6>
				<h5>Location: </h5><h6>'.$value["jLocation"].'</h6>
				<h5>Technologies: </h5><h6>'.$value["technologies"].'</h6>
				<h5>Salary: </h5><h6>'. $value["salary"]. '</h6>
				<h5>Hours: </h5><h6>'. $value["hours"]. '</h6>
				<h5>Active: </h5><h6>'. $value["active"]. '</h6>
				<h5>Timestamp: </h5><h6>'. $value["timestamp"]. '</h6>
				<h5>More Skills: </h5><h6>'. $value["moreSkills"].'</h6>
				<h5>Business ID: </h5><h6>'. $value["businessId"].'</h6>
				<h5>Username Business:</h5><h6>'. $value["username"].'</h6>
				
				'?>
				<label for="html">HTML</label>
				<input type="checkbox" id="html" name="html"  value='' <?php  if($value['html'] == 1) echo 'checked="checked"'; ?> ><br>
				<label for="css">CSS</label>
				<input type="checkbox" id="html" name="html"  value='' <?php  if($value['css'] == 1) echo 'checked="checked"'; ?> ><br>
				<label for="javascript">Javascript</label>
				<input type="checkbox" id="html" name="html"  value='' <?php  if($value['javascript'] == 1) echo 'checked="checked"'; ?> ><br>
				<label for="bootstrap">Bootstrap</label>
				<input type="checkbox" id="html" name="html"  value='' <?php  if($value['bootstrap'] == 1) echo 'checked="checked"'; ?> ><br>
				<label for="mysql">MySQL</label>
				<input type="checkbox" id="html" name="html"  value='' <?php  if($value['mysql'] == 1) echo 'checked="checked"'; ?> ><br>
				<label for="php">PHP</label>
				<input type="checkbox" id="html" name="html"  value='' <?php  if($value['php'] == 1) echo 'checked="checked"'; ?> ><br>
				<label for="symfony">Symfony</label>
				<input type="checkbox" id="html" name="html"  value='' <?php  if($value['symfony'] == 1) echo 'checked="checked"'; ?> ><br>
				<label for="python">Python</label>
				<input type="checkbox" id="html" name="html"  value='' <?php  if($value['python'] == 1) echo 'checked="checked"'; ?> ><br>
				<label for="java">Java</label>
				<input type="checkbox" id="html" name="html"  value='' <?php  if($value['java'] == 1) echo 'checked="checked"'; ?> ><br>
				<label for="typescript">Typescript</label>
				<input type="checkbox" id="html" name="html"  value='' <?php  if($value['typescript'] == 1) echo 'checked="checked"'; ?> ><br>
				<label for="jquery">JQuery</label>
				<input type="checkbox" id="html" name="html"  value='' <?php  if($value['jquery'] == 1) echo 'checked="checked"'; ?> ><br>
				<label for="latex">LaTex</label>
				<input type="checkbox" id="html" name="html"  value='' <?php  if($value['latex'] == 1) echo 'checked="checked"'; ?> ><br>
				<label for="angular">Angular</label>
				<input type="checkbox" id="html" name="html"  value='' <?php  if($value['angular'] == 1) echo 'checked="checked"'; ?> ><br><br>


			    <?php
			    echo'
			    <a class="btn btn-dark btn-lg" href="../../actions/fDeleteJob.php?id='.$value["jobsId"].'">Delete</a>
			    <a class="btn btn-dark btn-lg" href="../business/jobUpdate.php?id='.$value["jobsId"].'">Update</a>
			  </div>
			</div>

			';
			}
		}
		?>
	
		</div>
	</div>
	<div class="container mb-5">
		
	</div>
</body>
</html>
<?php ob_end_flush(); ?>