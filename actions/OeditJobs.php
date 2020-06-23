<?php
	require_once 'dbConnect.php';

	if($_POST){
		$jobsId = $_POST["id"];
		$jobTitle = $_POST["jobTitle"];
		$description = $_POST["description"];
		$jLocation = $_POST["jLocation"];
		$salary = $_POST["salary"];
		$hours = $_POST["hours"];
		$active = $_POST["active"];
		$moreSkills = $_POST["moreSkills"];
		}
	

		$sql = "UPDATE `jobs` SET `jobTitle`= '$jobTitle',`description`= '$description',`jLocation`= '$jLocation', `salary`= '$salary',`hours`= '$hours',`active`= '$active',`moreSkills`= '$moreSkills' WHERE jobsId = '$jobsId'";
	  

      // $id=$_POST["skillId"];
		
		$sql2 = "SELECT*FROM skill";
		$result2 = mysqli_query($connect, $sql2);
		while($row= $result2->fetch_assoc()){
			 $sql3 = "SELECT * FROM skill INNER JOIN skill_jobs ON skillId = fk_skillId WHERE (fk_jobsId =".$jobsId." AND skill_name='".$row['skill_name']."')";
	         $result3 = mysqli_query($connect, $sql3);


		if(isset($_POST[$row['skill_name']])){
            if(!$result3->num_rows){
            	mysqli_query($connect, "INSERT INTO `skill_jobs` (fk_jobsId, fk_skillId) VALUES (".$jobsId.",".$row['skillId'].")");
            	
            }
             

		}else{
             if($result3->num_rows>0){
                mysqli_query($connect, "DELETE FROM `skill_jobs` WHERE (fk_jobsId=".$jobsId."  AND fk_skillId=".$row['skillId'].")");
             }


		 }
	 }

	   if($active==0){
           $sql4 =  "DELETE FROM `fav_jobs` WHERE fk_jobsId = " .$jobsId."";
           mysqli_query($connect, $sql4);
	    }




	if (mysqli_query($connect, $sql)){
			header("Location: ../pages/business/jobWallBusiness.php?id=$id");
		
		}else{
			echo "error";
		}
?>