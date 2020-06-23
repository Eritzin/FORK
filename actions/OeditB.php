<?php
	require_once 'dbConnect.php';

	if($_POST){
		$id = $_POST["businessId"];
		$username = $_POST["username"];
		$company = $_POST["company"];
		$email = $_POST["email"];
		$phone = $_POST["phone"];
		$img = $_POST["img"];
		$jobPosition = $_POST["jobPosition"];
		$location = $_POST["location"];
		$sectors = $_POST["sectors"];
		$password = $_POST["password"];
	}


		$sql = "UPDATE `business` SET `username`= '$username',`company`= '$company',`email`= '$email', `phone`= '$phone',`img`= '$img',`jobPosition`= '$jobPosition',`location`= '$location',`sectors`= '$sectors',`password`= '$password' WHERE businessId = '$id'";


		if (mysqli_query($connect, $sql)){
			echo "success";
			
		}else{
			echo "error";
		}
	

header("Location: ../pages/business/businessAccount.php");
?>