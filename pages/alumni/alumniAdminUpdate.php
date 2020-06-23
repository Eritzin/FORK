<?php
ob_start();
session_start();
require_once '../../actions/dbConnect.php';

		if($_GET["id"]){
		
			$alumniId = $_GET["id"];
        
			$sql = "SELECT * FROM alumni WHERE alumniId = $alumniId";
			$result = mysqli_query($connect, $sql);

			$row =  $result->fetch_assoc();
		}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="../../assets/css/admin_superadmin.css">

	<title>Welcome </title>
</head>
<body >
		
	<div class="container-fluid alumniAccount ">
		<a class="btn btn-light btn-lg mt-4" href="alumniAdmin.php"> Back to Admin page</a>
			<div class="row justify-content-around ">			
				<div class="col-sm-8 bg-dark rounded mb-4">
					<h1 class="text-light">Update form alumni</h1>
					<form  action="../../actions/fadminUpdateAlumni.php" method="post">
					  <div class="form-group ">
							<input type="hidden" name="alumniId" value="<?php echo $row['alumniId'] ?>">
					    	<label class="text-light" for="exampleFormControlInput1">First name</label>
						    <input class="form-control" name="firstname" type="text" placeholder="First name" value="<?php echo $row['firstname'] ?>">

						    <label class="text-light" for="exampleFormControlInput1">Last name</label>
						    <input class="form-control" name="lastname" type="text" placeholder="Last name" value="<?php echo $row['lastname'] ?>">

						    <label class="text-light" for="exampleFormControlInput1">E-mail</label>
						    <input class="form-control" name="email" type="text" placeholder="E-mail" value="<?php echo $row['email'] ?>">

							<label class="text-light" for="exampleFormControlInput1">Date of birth</label>
						    <input class="form-control" name="birth" type="date" placeholder="Date of birth" value="<?php echo $row['birth'] ?>">

						    <label class="text-light" for="exampleFormControlInput1">Phone number</label>
						    <input class="form-control" name="phone" type="int" placeholder="Phone number" value="<?php echo $row['phone'] ?>">	 

						    <label class="text-light" for="exampleFormControlInput1">Image</label>
						    <input class="form-control" name="img" type="text" placeholder="Image" value="<?php echo $row['img'] ?>">		
							
							<label class="text-light" for="exampleFormControlSelect1">Job Status</label>
							<ul>
						    	<li class="text-light">0: Unemployed </li>
						    	<li class="text-light">1: Employed</li>
						    </ul>
						    <select class="form-control" name="jobStatus" id="exampleFormControlSelect1" value="<?php echo $row['jobStatus'] ?>">
						      <option>0</option>
						      <option>1</option>
						    </select>

						    <label class="text-light" for="exampleFormControlTextarea1">Description</label>
						    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" placeholder="Description" rows="3" value=""><?php echo $row['description'] ?></textarea>

					    	<label class="text-light" for="exampleFormControlInput1">Portfolio URL</label>
						    <input class="form-control" name="portfolioUrl" type="text" placeholder="Portfolio URL" value="<?php echo $row['portfolioUrl'] ?>">

						    <label class="text-light" for="exampleFormControlInput1">Location</label>
						    <input class="form-control" name="location" type="text" placeholder="Location" value="<?php echo $row['location'] ?>">					  
						    <label class="text-light" for="exampleFormControlTextarea1">Education</label>
						    <textarea class="form-control" name="education" id="exampleFormControlTextarea1" placeholder="Education" rows="3" value=""><?php echo $row['education'] ?></textarea>

					  		<label class="text-light" for="exampleFormControlInput1">password</label>
						    <input class="form-control" name="password" type="text" placeholder="password" value="<?php echo $row['password'] ?>">
							
							<label class="text-light" for="exampleFormControlInput1">Favorite Jobs</label>
						    <input class="form-control" name="favJobs" type="text" placeholder="Favorite Jobs" value="<?php echo $row['favJobs'] ?>">

						    <label class="text-light" for="exampleFormControlSelect1">Admin</label>
						    <ul>
						    	<li class="text-light">0: Alumni</li>
						    	
						    </ul>
						    <select class="form-control" name="admin" id="exampleFormControlSelect1" value="<?php echo $row['admin'] ?>">
						      <option>0</option>
						      
						    </select>

					
						    <input class="form-control" name="fk_skillId" type="hidden" placeholder="fk_skilled" value="<?php echo $row['fk_skillId'] ?>">							
					  	</div>					  	

					  	<input  type="submit" class="btn btn-light btn-lg mb-4" name="submit">
				</form>
				</div>			
			</div>			
		</div>
</body>
</html>
<?php ob_end_flush(); ?>