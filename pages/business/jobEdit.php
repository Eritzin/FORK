<?php
require_once '../../actions/dbConnect.php';

if($_GET["id"]){
	$id = $_GET["id"];

	$sql = "SELECT * FROM jobs WHERE jobsId = $id";
	$result = mysqli_query($connect, $sql);
	$row = $result->fetch_assoc();

	$sql3 = "SELECT * FROM skill";
	$result3 = mysqli_query($connect, $sql3);
	


    $form="	
        <div class='form-row'>
         <div class='form-group col-md-6'>
               <label>Job title:</label>
		       <input type='hidden' name='id' value='".$row['jobsId']."'>
		       <input type='text' class='form-control' name='jobTitle' value='".$row['jobTitle']."'>
		  </div>
		  <div class='form-group col-md-6'>
		       <label>Location</label>
		       <input type='text' name='jLocation' class='form-control' value='".$row['jLocation']. "'>
		  </div>
		</div>
		 <div class='form-group col-md-12' value='".$row['timestamp']."'>
		 Posted on ".$row['timestamp'].";
		 </div>
		 <div class='form-group col-md-12'>
		 <label>Description</label>
		 <input type='text' name='description' class='form-control' value='".$row['description']."'>
		 </div> <label>Skills:</label><div class='form-group col-md-12 skillcontainer'>";


        
        while($row3 = $result3->fetch_assoc()){
        	$sql2 = "SELECT * FROM skill INNER JOIN skill_jobs ON skillId = fk_skillId WHERE (fk_jobsId =".$id." AND skill_name='".$row3['skill_name']."')";
	        $result2 = mysqli_query($connect, $sql2);
	   
            if($result2->num_rows>0){ // check if the skill was selected. 
            	$form.=" <div class=\"form-check\">
                              <input type='checkbox' id='".$row3['skill_name']."' class='value form-check-input-lg' name='".$row3['skill_name']."' value =1 checked>
                              <label class='form-check-label col-form-label-lg' for='".$row3['skill_name']."'>".$row3['skill_name']."</label>  
                         </div>";
                }else{  

            	 $form.=" <div class=\"form-check\"> 
            	               <input type='checkbox' id='".$row3['skill_name']."' class='value form-check-input-lg' name='".$row3['skill_name']."' value =1 >
                               <label class='form-check-label col-form-label-lg' for='".$row3['skill_name']."'>".$row3['skill_name']."</label>  
                           </div>";
        	
               };

           }

            
            
        
       
		  
		 $form.=" </div>
		 <div class='form-group col-md-12'>
		 <label>Additional:</label>
		 <input type=\"text\" class=\"form-control\" name=\"moreSkills\" value='".$row['moreSkills']."'>
		 </div> 
		 <div class='form-row'>
		   <div class='form-group col-md-6'>
		   <label>Salary:</label><input type='text' class='form-control' name='salary' value='" .$row['salary']. "'>
		   </div>
		   <div class='form-group col-md-6'> 
		   	 <label>Hours :</label>
		   	  <div class=\"input-group\">
		    	<input type='text' name='hours' class='form-control' value='".$row['hours']."'> 
		   	    <div class=\"input-group-prepend\">
		          <div class=\"input-group-text\">h/w</div>
		   	    </div>
		 	  </div>
		   </div>
		  </div>
		 <div class=\"form-group col-md-3\">
		 <select id='' name='active'>
  		   <option value='1'>active</option>
  		   <option value='0'>not active</option>
  		</select>";
		
		
		
         
    echo $form;

   }
        


?>
