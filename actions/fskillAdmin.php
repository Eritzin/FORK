<?php 
ob_start();
session_start();
require_once 'dbConnect.php';

if(!isset($_SESSION["admin"]))
{
	header("Location: ../pages/index.php");
}

if($_POST){
		$id = $_POST["id"];
		$html = (isset($_POST["html"])) ? 1 : 0;
		$css = (isset($_POST["css"])) ? 1 : 0;
		$javascript = (isset($_POST["javascript"])) ? 1 : 0;
		$bootstrap = (isset($_POST["bootstrap"])) ? 1 : 0;
		$mysql = (isset($_POST["mysql"])) ? 1 : 0;
		$php = (isset($_POST["php"])) ? 1 : 0;
		$symfony = (isset($_POST["symfony"])) ? 1 : 0;
		$python = (isset($_POST["python"])) ? 1 : 0;
		$java = (isset($_POST["java"])) ? 1 : 0;
		$typescript = (isset($_POST["typescript"])) ? 1 : 0;
		$cPP = (isset($_POST["cPP"])) ? 1 : 0;
		$jquery = (isset($_POST["jquery"])) ? 1 : 0;
		$latex = (isset($_POST["latex"])) ? 1 : 0;
		$angular = (isset($_POST["angular"])) ? 1 : 0;



	if($html == "1"){
 	mysqli_query($connect, "UPDATE `skill` SET `html`= '1' WHERE skillId = '$id' ");
	} else {
 	mysqli_query($connect, "UPDATE `skill` SET `html`= '0' WHERE skillId = '$id'");
	}

	if($css == "1"){
 	mysqli_query($connect, "UPDATE `skill` SET `css`= '1' WHERE skillId = '$id' ");
	} else {
 	mysqli_query($connect, "UPDATE `skill` SET `css`= '0' WHERE skillId = '$id'");
	}

	if($javascript == "1"){
 	mysqli_query($connect, "UPDATE `skill` SET `javascript`= '1' WHERE skillId = '$id' ");
	} else {
 	mysqli_query($connect, "UPDATE `skill` SET `javascript`= '0' WHERE skillId = '$id'");
	}

	if($bootstrap == "1"){
 	mysqli_query($connect, "UPDATE `skill` SET `bootstrap`= '1' WHERE skillId = '$id' ");
	} else {
 	mysqli_query($connect, "UPDATE `skill` SET `bootstrap`= '0' WHERE skillId = '$id'");
	}

	if($mysql == "1"){
 	mysqli_query($connect, "UPDATE `skill` SET `mysql`= '1' WHERE skillId = '$id' ");
	} else {
 	mysqli_query($connect, "UPDATE `skill` SET `mysql`= '0' WHERE skillId = '$id'");
	}

	if($php == "1"){
 	mysqli_query($connect, "UPDATE `skill` SET `php`= '1' WHERE skillId = '$id' ");
	} else {
 	mysqli_query($connect, "UPDATE `skill` SET `php`= '0' WHERE skillId = '$id'");
	}

	if($symfony == "1"){
 	mysqli_query($connect, "UPDATE `skill` SET `symfony`= '1' WHERE skillId = '$id' ");
	} else {
 	mysqli_query($connect, "UPDATE `skill` SET `symfony`= '0' WHERE skillId = '$id'");
	}

	if($python == "1"){
 	mysqli_query($connect, "UPDATE `skill` SET `python`= '1' WHERE skillId = '$id' ");
	} else {
 	mysqli_query($connect, "UPDATE `skill` SET `python`= '0' WHERE skillId = '$id'");
	}

	if($java == "1"){
 	mysqli_query($connect, "UPDATE `skill` SET `java`= '1' WHERE skillId = '$id' ");
	} else {
 	mysqli_query($connect, "UPDATE `skill` SET `java`= '0' WHERE skillId = '$id'");
	}

	if($typescript == "1"){
 	mysqli_query($connect, "UPDATE `skill` SET `typescript`= '1' WHERE skillId = '$id' ");
	} else {
 	mysqli_query($connect, "UPDATE `skill` SET `typescript`= '0' WHERE skillId = '$id'");
	}

	if($cPP == "1"){
 	mysqli_query($connect, "UPDATE `skill` SET `c++`= '1' WHERE skillId = '$id' ");
	} else {
 	mysqli_query($connect, "UPDATE `skill` SET `c++`= '0' WHERE skillId = '$id'");
	}

	if($jquery == "1"){
 	mysqli_query($connect, "UPDATE `skill` SET `jquery`= '1' WHERE skillId = '$id' ");
	} else {
 	mysqli_query($connect, "UPDATE `skill` SET `jquery`= '0' WHERE skillId = '$id'");
	}

	if($latex == "1"){
 	mysqli_query($connect, "UPDATE `skill` SET `latex`= '1' WHERE skillId = '$id' ");
	} else {
 	mysqli_query($connect, "UPDATE `skill` SET `latex`= '0' WHERE skillId = '$id'");
	}

	if($angular == "1"){
 	mysqli_query($connect, "UPDATE `skill` SET `angular`= '1' WHERE skillId = '$id' ");
	} else {
 	mysqli_query($connect, "UPDATE `skill` SET `angular`= '0' WHERE skillId = '$id'");
	}
}
	

header("refresh:2;url=../pages/alumni/alumniSuperAdmin.php");
 ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="../assets/css/admin_superadmin.css">
	<title>skill</title>
</head>
<body class="alumniAccount">


 <div class="container">

 	<div class="row justify-content-around">
 		<div class="col-sm-8 bg-light rounded text-center centered-element massageUpdated">

 			<h1>The Acount is successfully updated.</h1>
 			<h4>automaticly transmitted to alumni page</h4>
 			<a class="btn btn-dark btn-lg m-4" href="../pages/alumni/alumniAdmin.php">Admin</a>
 		</div>
 		
 	</div>
 	
 </div>
</body>
</html>
<?php ob_end_flush(); ?>