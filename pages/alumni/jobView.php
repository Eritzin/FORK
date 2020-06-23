<?php 

require_once '../../actions/dbConnect.php';
if($_GET["id"]){
		
			$jobsId = $_GET["id"];
        
			$sql = "SELECT * FROM jobs
			INNER JOIN business on fk_businessId = businessId 
			WHERE jobsId = $jobsId";
			$result = mysqli_query($connect, $sql);

			$row =  $result->fetch_assoc();

          
               $technologies="";
              $sql2="SELECT * FROM skill_jobs INNER JOIN skill on fk_skillId= skillId  WHERE fk_jobsId ='".$row["jobsId"]."'";
               $result2 = mysqli_query($connect, $sql2);
                              if($result2->num_rows == 0){
                                  $technologies.= "Technologies are not selected";
                                }elseif($result2->num_rows == 1){
                                  $row2 = $result2->fetch_assoc();
                                    $technologies.=$row2["skill_name"];
                                }else{
                                     $rows2 = $result2->fetch_all(MYSQLI_ASSOC);
                                     foreach($rows2 as $key => $value2){
                                           $technologies.="-".$value2["skill_name"]." " ;
                                     }
                                  }


		}


 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
		hr {
        border: 0;
         clear:both;
  display:block;
  width: 96%;               
  background-color:#e0dfdc;
  height: 1px;
}
	</style>
</head>
<body>
<div class="title">
 <div class="row">
 	<div class="col-4">
	<img src=<?php echo $row["img"] ?> style="width:130px;height:130px;">
    </div>
	<div class="col-8">
	<h2> <?php echo "Position:  ".$row["jobTitle"] ?></h2>
	<h5><svg class="bi bi-map" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M15.817.613A.5.5 0 0116 1v13a.5.5 0 01-.402.49l-5 1a.502.502 0 01-.196 0L5.5 14.51l-4.902.98A.5.5 0 010 15V2a.5.5 0 01.402-.49l5-1a.5.5 0 01.196 0l4.902.98 4.902-.98a.5.5 0 01.415.103zM10 2.41l-4-.8v11.98l4 .8V2.41zm1 11.98l4-.8V1.61l-4 .8v11.98zm-6-.8V1.61l-4 .8v11.98l4-.8z" clip-rule="evenodd"/>
</svg>  <?php echo "    ".$row["jLocation"]." " ?></h5>
	<h5>posted: <?php echo $row["timestamp"] ?></h5>
    </div>
 </div>

</div>
<hr style="border:0;border-top:1px solid #e0dfdc;"/>
<div class="container">

  <div class="row">
  	
    <div class="col-sm">
    	    <div> Company</div>
    		<div> <?php echo $row["company"] ?></div>
    </div>
    <div class="col-sm">
      <div> Salary</div>
       <div><?php echo $row["salary"] ?></div>
    </div>
    <div class="col-sm">
    	<div> Hours/Week</div>
      <div> <?php echo $row["hours"] ?></div>
    </div>
  </div>
</div>
<hr style="border:0;border-top:1px solid #e0dfdc;"/>
<br>
<div>
	<b>Job Description</b>
	<div>
		<?php echo $row["description"] ?>
	</div>
</div>
<br>
<div>
	<b>Required skills :</b>
	<div>
		<?php echo $technologies ?>
	</div>
</div>
<br>
<div>
	<b>Extra :</b>
	<div>
		<?php echo $row["moreSkills"] ?>
	</div>
</div>
<br>
<br>
<div class="container">
	<svg class="bi bi-person" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M13 14s1 0 1-1-1-4-6-4-6 3-6 4 1 1 1 1h10zm-9.995-.944v-.002.002zM3.022 13h9.956a.274.274 0 00.014-.002l.008-.002c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664a1.05 1.05 0 00.022.004zm9.974.056v-.002.002zM8 7a2 2 0 100-4 2 2 0 000 4zm3-2a3 3 0 11-6 0 3 3 0 016 0z" clip-rule="evenodd"/>
</svg>Contact Info:
	<div class="row">
  	
    	<div class="col-sm">
    		<?php echo $row["email"] ?>
		</div>
		<div class="col-sm">
    		<?php echo $row["phone"] ?>
    	</div>
    </div>
    
 </div>
	


</body>
</html>