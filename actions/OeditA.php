<?php
	require_once 'dbConnect.php';

	if($_POST){
		$id = $_POST["id"];
		$firstname = $_POST["firstname"];
		$lastname = $_POST["lastname"];
		$email = $_POST["email"];
		$birth = $_POST["birth"];
		$phone = $_POST["phone"];
		$img = $_POST["img"];
		$jobStatus = $_POST["jobStatus"];
		$description = $_POST["description"];
		$portfolioUrl = $_POST["portfolioUrl"];
		$location = $_POST["location"];
		$education = $_POST["education"];
	}


		$sql = "UPDATE `alumni` SET `firstname`= '$firstname',`lastname`= '$lastname',`email`= '$email',`birth`= '$birth',`phone`= '$phone',`img`= '$img',`jobStatus`= '$jobStatus',`description`= '$description',`portfolioUrl`= '$portfolioUrl',`location`= '$location',`education`= '$education' WHERE alumniId = '$id'";

		$sql2 = "SELECT*FROM skill";
		$result2 = mysqli_query($connect, $sql2);
		while($row= $result2->fetch_assoc()){
			 $sql3 = "SELECT * FROM skill INNER JOIN skill_alumni ON skillId = fk_skillId WHERE (fk_alumniId =".$id." AND skill_name='".$row['skill_name']."')";
	         $result3 = mysqli_query($connect, $sql3);


		if(isset($_POST[$row['skill_name']])){
            if(!$result3->num_rows){
            	mysqli_query($connect, "INSERT INTO `skill_alumni` (fk_alumniId, fk_skillId) VALUES (".$id.",".$row['skillId'].")");
            	
            }
             

		}else{
             if($result3->num_rows>0){
                mysqli_query($connect, "DELETE FROM `skill_alumni` WHERE (fk_alumniId=".$id."  AND fk_skillId=".$row['skillId'].")");
             }


		 }
	    }

		if (mysqli_query($connect, $sql)){
			echo "success";
			
		}else{
			echo "error";
		}
	

header("Location: ../pages/alumni/alumniAccount.php");
?>