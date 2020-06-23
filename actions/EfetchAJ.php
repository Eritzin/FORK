<?php 

require_once 'dbConnect.php';

$output='';
$id=$_POST["alumniId"];


//condition 1   active = 1
//condition 2  keywords should include in title, description, technologies, moreskills or company's infomation.
//condition 3  if location or technologies are filled or selected, filter location and technologies.    

$search_location=isset( $_POST["search_location"] ) ? $_POST["search_location"] : '';
$search=isset( $_POST["search"] ) ? $_POST["search"] : '';
 


$sql ="SELECT*FROM jobs
INNER JOIN business on fk_businessId = businessId
WHERE active ='1'
AND jLocation LIKE '%".$search_location."%'
AND (jobTitle LIKE '%" . $search ."%'
OR description LIKE '%" . $search ."%'
OR moreSkills LIKE '%" . $search ."%'
OR company LIKE '%" .$search ."%')";



$technologies="Technologies are not selected";
$result = mysqli_query($connect, $sql);
if(mysqli_num_rows($result)>0){
  
        
  while($row=$result->fetch_assoc()){  // while roop each job
      $col_Favbtn=""; 
      $technologies="";
      $description = (strlen($row["description"]) > 70) ? substr($row["description"], 0, 70) . '...' : $row["description"];
      $sql2 = "SELECT * FROM skill_jobs INNER JOIN skill on fk_skillId= skillId  WHERE fk_jobsId ='".$row["jobsId"]."' AND";
     
      
      if(isset($_POST["technologies"])){  // only skills were selected
          // echo $sql2;

         $length=count($_POST["technologies"]);
        
          if($length=1){
            $sql2.= " skill_name= '".$_POST['technologies'][0]."' ";
           
          }else{

            $sql2.= " ( skill_name = '".$_POST['technologies'][0]."' "; 
          
            for($i=1; $i< $length; $i++){ 
                 if($i+1== $length){
                      $sql2.="OR skill_name ='".$_POST['technologies'][$i]."' ) ";// must close with ")"
                  }else{

                      $sql2.="OR skill_name = '".$_POST['technologies'][$i]."' ";
                  }
            } //end of for loop

           
          }
          
          
           $result2 = mysqli_query($connect, $sql2);
         if($result2->num_rows==0){
            continue;
          };
         
        }
         
    
      $sql2 = "SELECT * FROM skill_jobs INNER JOIN skill on fk_skillId= skillId  WHERE fk_jobsId ='".$row["jobsId"]."'";
      $result2 = mysqli_query($connect, $sql2);
      if( $result2->num_rows==0){
       $technologies.= "Technologies are not selected";
        }elseif($result2->num_rows == 1){
          $row2 = $result2->fetch_assoc();
                                    $technologies.=$row2["skill_name"];
      }else{
            $row2 = $result2->fetch_all(MYSQLI_ASSOC);
          foreach($row2 as $key => $value2){
               $technologies.="-".$value2["skill_name"]." " ;

          }
        }
  
     
  $sql3= "SELECT * FROM  fav_jobs WHERE fk_alumniId='".$id."' AND fk_jobsId =".$row["jobsId"];
  $result3 = mysqli_query($connect, $sql3);
  if($result3 ->num_rows>0){

    $col_Favbtn.=' <svg class="bi bi-star-fill" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 
                      0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                      </svg>';


  }else{
    $col_Favbtn.='<svg class="bi bi-star" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
               <path fill-rule="evenodd" d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.523-3.356c.329-.314.158-.888-.283-.95l-4.898-.696L8.465.792a.513.513 0 00-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767l-3.686 1.894.694-3.957a.565.565 0 00-.163-.505L1.71 6.745l4.052-.576a.525.525 0 00.393-.288l1.847-3.658 1.846 3.658a.525.525 0 00.393.288l4.052.575-2.906 2.77a.564.564 0 00-.163.506l.694 3.957-3.686-1.894a.503.503 0 00-.461 0z" clip-rule="evenodd"/>
                </svg>';

  };

 $output .='
        <div class="card" style="width: 20rem;">
            <div class="card-body">
                <h5 class="card-title">Job title :  '.$row["jobTitle"].' </h5>
                <hr class="myjobs">
                <p class="card-text"> Salary : '.$row["salary"].' , '.$row["hours"].' Hours/Week</p>
                <h6 class="card-subtitle mb-2 text-muted">Uploaded: ' .date("d/m/Y",strtotime($row["timestamp"])).'</h6>
                <p class="card-text">Description:'.$description.' </p>
                <p class="card-text">Location:'.$row["jLocation"].' </p>
                <p class="card-text">Technologies:'.$technologies.' </p>
                <div class="form-group view_fav">
                  <form method="post">
                    <input type=hidden  " id="alumniId" value='.$id.'>
                     <button type="button"  class="btn btn-link col-sm-5 fav_btn" id="fav_btn" name="fav" style="color:#FFF100" value='.$row["jobsId"].'>'
                     .$col_Favbtn.'
                     </button>
                   </form>
              
                  <button type="button" id="view" data-href="jobView.php?id='.$row["jobsId"].'" class="btn btn-primary btn-block openPopup" data-toggle="modal" >View</button>
                
                </div>
            </div>
        </div>';

     

   } //end while loop


echo $output;


}//end if
else
{
  echo 'Data Not Found';
}   
    

 ?>
 <!DOCTYPE html>
 <html>
 <head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
   <title></title>
 </head>
 <body>
 

 </body>
  <script>

  // for popup function edit
$(document).ready(function(){
    $('.openPopup').on('click',function(){
        var dataURL = $(this).attr('data-href');

        console.log(dataURL);
        $('.modal-body').load(dataURL,function(){
            $('#myModal').modal({show:true});
        });
    }); 
});
</script>
 </html>