<?php  
 require_once 'dbConnect.php';


if(isset( $_POST["submit"])){

  $jobTitle=isset( $_POST["jobTitle"] ) ? $_POST["jobTitle"] : '';
  $description=isset( $_POST["description"] ) ? $_POST["description"] : '';
  $jLocation=isset( $_POST["jLocation"] ) ? $_POST["jLocation"] : '';
  $salary=isset( $_POST["salary"] ) ? $_POST["salary"] : '';
  $hours=isset( $_POST["hours"] ) ? $_POST["hours"] : '';
  $active=isset($_POST["active"] ) ? $_POST["active"] : '0';
  $moreSkills=isset( $_POST["moreSkills"] ) ? $_POST["moreSkills"] : '';
  $fk_businessId = isset( $_POST["id"] ) ? $_POST["id"] : '';
  
    $sql="INSERT INTO `jobs`(`jobTitle`, `description`, `jLocation`,`salary`,`hours`,`active`,`moreSkills`,`fk_businessId`) 
        VALUES ('$jobTitle','$description','$jLocation','$salary','$hours', '$active','$moreSkills','$fk_businessId')";
        echo "<h1>". $sql."</h1>";

   if($connect->query($sql)===TRUE){
       
        $jobId = mysqli_insert_id($connect);
        $res = mysqli_query($connect,"SELECT * FROM skill");
        $rows =$res->fetch_all(MYSQLI_ASSOC); 
       
        echo "<h1>". $jobId."</h1>";

         foreach($rows as $value){
          echo "<h1>". $value['skill_name']."</h1>";

          if(isset($_POST[$value['skill_name']])){
            echo "<h1>". $value['skill_name']."</h1>";
             $resultId=mysqli_query($connect, "SELECT skillId FROM skill WHERE skill_name='".$value['skill_name']."'");
             $id=$resultId->fetch_assoc();
             echo "<h1>". $id."</h1>";
           
             $sqlS ="INSERT INTO skill_jobs (fk_jobsId,fk_skillId) VALUES (".$jobId.",".$id['skillId'].")" ;    

            // echo "<h1>". $sqlS."</h1>";
            if( mysqli_query($connect, $sqlS)){
                   header("Location:../pages/business/jobwallBusiness.php");

            };
            };          
        };

  // 
  }else{
    echo "error";
  };
     

   
};




 
 
?>