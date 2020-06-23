<?php
ob_start();
session_start();
require_once '../../actions/dbConnect.php';

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="../../assets/css/admin_superadmin.css">

	<title>alumni create</title>
</head>
<body class="alumniAccount">



<div class="container-fluid mb-4">
	<a class="btn btn-light btn-lg mt-4"href="alumniSuperAdmin.php">SuperAdmin</a>
	<div class="row justify-content-around">
		<div class="col-sm-8 bg-dark rounded p-4">
			<h1 class="text-light">Create form alumni</h1>
			<form  action="../../actions/fCreateAlumni.php" method="post">
			
			  <div class="form-group ">
			  
			    	<label class="text-light" for="exampleFormControlInput1">First name</label>
				    <input class="form-control" name="firstname" type="text" placeholder="First name" value="">

				    <label class="text-light" for="exampleFormControlInput1">Last name</label>
				    <input class="form-control" name="lastname" type="text" placeholder="Last name" value="">

				    <label class="text-light" for="exampleFormControlInput1">E-mail</label>
				    <input class="form-control" name="email" type="text" placeholder="E-mail" value="">

					<label class="text-light" for="exampleFormControlInput1">Date of birth</label>
				    <input class="form-control" name="birth" type="date" placeholder="Date of birth" value="">

				    <label class="text-light" for="exampleFormControlInput1">Phone number</label>
				    <input class="form-control" name="phone" type="int" placeholder="Phone number" value="">	 

				    <label class="text-light" for="exampleFormControlInput1">Image</label>
				    <input class="form-control" name="img" type="text" placeholder="Image" value="">		
					
					<label class="text-light" for="exampleFormControlSelect1">Job Status</label>
					<ul>
				    	<li class="text-light">0: Unemployed </li>
				    	<li class="text-light">1: Employed</li>
				    </ul>
				    <select class="form-control" name="jobStatus" id="exampleFormControlSelect1" value="">
				      <option>0</option>
				      <option>1</option>
				    </select>

				    <label class="text-light" for="exampleFormControlTextarea1">Description</label>
				    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" placeholder="Description" rows="3" value=""></textarea>

			    	<label class="text-light" for="exampleFormControlInput1">Portfolio URL</label>
				    <input class="form-control" name="portfolioUrl" type="text" placeholder="Portfolio URL" value="">

				    <label class="text-light" for="exampleFormControlInput1">Location</label>
				    <input class="form-control" name="location" type="text" placeholder="Location" value="">					  
				    <label class="text-light" for="exampleFormControlTextarea1">Education</label>
				    <textarea class="form-control" name="education" id="exampleFormControlTextarea1" placeholder="Education" rows="3" value=""></textarea>

			  		<label class="text-light" for="exampleFormControlInput1">password</label>

				    <input class="form-control" name="password" type="text" placeholder="password" value="">
				
				    <label class="text-light" for="exampleFormControlInput1">Favorite Jobs</label>
				    <input class="form-control" name="favJobs" type="text" placeholder="favJobs" value="">

				    <label class="text-light" for="exampleFormControlSelect1">Admin</label>
				    <ul>
				    	<li class="text-light">0: Alumni</li>
				    	<li class="text-light">1: Admin</li>
				    	

				    </ul>
				    <select class="form-control" name="admin" id="exampleFormControlSelect1" value="">
				      <option>0</option>
				      <option>1</option> 
				      
				    </select>
					
			  	</div>
			  	<input  type="submit" class="btn btn-light btn-lg" name="submit">					  
			</form>

		</div>
		
	</div>
	
</div>

</body>
</html>
<?php ob_end_flush(); ?>




