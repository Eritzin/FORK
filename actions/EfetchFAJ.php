<?php 

require_once 'dbConnect.php';
$output='';


if(isset($_POST["favJobId"])){
$fav_jobId =$_POST["favJobId"];
$alumniId=$_POST["alumniId"];
$sqlFavJobId="SELECT * FROM fav_jobs WHERE fk_alumniId =".$alumniId." AND fk_jobsId =".$fav_jobId."";
$resultFavJobId = mysqli_query($connect, $sqlFavJobId);
//echo"<h1>".$sqlFavJobId."</h1>";
//$fav_jobId='';


  //$fav_jobId=$_POST["favJobId"];


        if($resultFavJobId->num_rows==0){  

                mysqli_query($connect, "INSERT INTO fav_jobs (fk_alumniId, fk_jobsId) VALUES ( ".$alumniId.",".$fav_jobId.")" );

        }
        else
        {  
                mysqli_query($connect, "DELETE FROM fav_jobs WHERE fk_alumniId =".$alumniId." AND fk_jobsId =".$fav_jobId);
                     
                 
        } 
       

 } ;  

 if(isset($_POST["alumniId"])){
        $resultFavJobId = mysqli_query($connect, "SELECT * FROM fav_jobs WHERE fk_alumniId =".$_POST["alumniId"]);
        

            if($resultFavJobId->num_rows==0){
                echo "No Favorite jobs";
             }elseif($resultFavJobId->num_rows==1){  
             
                         $rows = $resultFavJobId->fetch_assoc(); 
              
                          $sqlFavJob = "SELECT*FROM jobs WHERE active ='1' AND jobsId ='". $rows["fk_jobsId"]."'";
                          $technologies="";
                          $resultFavJob = mysqli_query($connect, $sqlFavJob);
                          $row = $resultFavJob->fetch_assoc();
                          $sql2 = "SELECT * FROM skill_jobs INNER JOIN skill on fk_skillId= skillId  WHERE fk_jobsId ='".$rows["fk_jobsId"]."'";
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
                          };
                          $description = (strlen($row["description"]) > 70) ? substr($row["description"], 0, 70) . '...' : $row["description"];
                          $output .='<div class="card" style="width: 20rem;">
                          <div class="card-body">
                          <h5 class="card-title">Job title : '.$row["jobTitle"].' </h5>
                          <hr class="myjobs">
                          <p class="card-text"> Salary : '.$row["salary"].' , '.$row["hours"].'Hours/Week</p>
                          <h6 class="card-subtitle mb-2 text-muted">Uploaded:  ' .date("d/m/Y",strtotime($row["timestamp"])).'</h6>
                          <p class="card-text">Description:'.$description.' </p>
                          <p class="card-text">Location:'.$row["jLocation"].' </p>
                          <p class="card-text">Technologies:'. $technologies.' </p>
                          <div class="form-group view_fav">
                          <button type="button"  class="btn btn-link fav_btn" id='.$row["jobsId"].' name="fav" style="color:#FFF100" value='.$row["jobsId"].'>
                          <svg class="bi bi-star-fill" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                          <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 
                          0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                          </svg>
                          </button>
                          <button type="button"  id="view" data-href="jobView.php?id='.$row["jobsId"].'" class="btn btn-primary btn-block openPopup" data-toggle="modal" >View</button>
                          </div>
                          </div>
                          </div>';
                          echo $output;
              }
              else  // In case there are more than one favorite jobs .
              {
                $rows = $resultFavJobId->fetch_all(MYSQLI_ASSOC);  
                  foreach($rows as $key => $value){
                      $sqlFavJob = "SELECT*FROM jobs WHERE active ='1' AND jobsId ='". $value["fk_jobsId"]."'";
                      $resultFavJob = mysqli_query($connect, $sqlFavJob);
                      $row = $resultFavJob->fetch_assoc();

                      $technologies="";
                      $sql2 = "SELECT * FROM skill_jobs INNER JOIN skill on fk_skillId= skillId  WHERE fk_jobsId ='".$value["fk_jobsId"]."'";
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

                         };
                      };
                  
                  $description = (strlen($row["description"]) > 70) ? substr($row["description"], 0, 70) . '...' : $row["description"];
                  $output .='<div class="card" style="width: 20rem;">
                      <div class="card-body">
                      <h5 class="card-title">Job title : '.$row["jobTitle"].' </h5>
                       <hr class="myjobs">
                      <p class="card-text">Salary : '.$row["salary"].' , '.$row["hours"].'Hours/Week</p>
                      <h6 class="card-subtitle mb-2 text-muted">Uploaded:  ' .date("d/m/Y",strtotime($row["timestamp"])).'</h6>
                      <p class="card-text">Description:'.$description.' </p>
                      <p class="card-text">Location:'.$row["jLocation"].' </p>
                      <p class="card-text">Technologies:'.$technologies.' </p>
                      <div class="form-group view_fav">
                     
                      <button type="button"  class="btn btn-link fav_btn" id='.$row["jobsId"].' name="fav" style="color:#FFF100" value='.$row["jobsId"].'>
                      <svg class="bi bi-star-fill" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 
                      0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                      </svg>
                     </button>
                      <button type="button" id="view" data-href="jobView.php?id='.$row["jobsId"].'" class="btn btn-primary btn-block openPopup" data-toggle="modal" >View</button>
                     </div>
                     </div>
                     </div>';
   
                 
                  }; // end foreach
                     echo $output;
                    
              };

    };
         /*     if($resultFavJob->num_rows == 0){
                echo "No result";
              }elseif($resultFavJob->num_rows == 1){
               

               
              }else{
                 $rows = $resultFavJob->fetch_all(MYSQLI_ASSOC);
                 foreach($rows as $key => $value){

                   $technologies="";
                  $sql2 = "SELECT * FROM skill_jobs INNER JOIN skill on fk_skillId= skillId  WHERE fk_jobsId ='".$value["jobsId"]."'";
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

                     };
                   };
                  
                  $description = (strlen($value["description"]) > 70) ? substr($value["description"], 0, 70) . '...' : $value["description"];
                  $output .='<div class="card" style="width: 20rem;">
                      <div class="card-body">
                      <h5 class="card-title">Job title : '.$value["jobTitle"].' </h5>
                       <hr class="myjobs">
                      <p class="card-text">Salary : '.$value["salary"].' , '.$value["hours"].'Hours/Week</p>
                      <h6 class="card-subtitle mb-2 text-muted">Uploaded:  ' .date("d/m/Y",strtotime($value["timestamp"])).'</h6>
                      <p class="card-text">Description:'.$description.' </p>
                      <p class="card-text">Location:'.$value["jLocation"].' </p>
                      <p class="card-text">Technologies:'.$technologies.' </p>
                      <div class="form-group view_fav">
                     
                      <button type="button"  class="btn btn-link fav_btn" id='.$value["jobsId"].' name="fav" style="color:#FFF100" value='.$value["jobsId"].'>
                      <svg class="bi bi-star-fill" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 
                      0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                      </svg>
                     </button>
                      <button type="button" id="view" data-href="jobView.php?id='.$value["jobsId"].'" class="btn btn-primary btn-block openPopup" data-toggle="modal" >View</button>
                     </div>
                     </div>
                     </div>';
                 
                 }

                 echo $output;
             };

      };*/

            /*  
              
                
                $technologies="";
                $sql2="SELECT col_name FROM ( SELECT skillId, html as val, 'HTML' as col_name from skill  union all SELECT skillId, css, 'CSS'
                from skill union all SELECT skillId, javascript, 'JavaScript' from skill union all SELECT skillId, bootstrap, 'Bootstrap'  from skill union all SELECT skillId, mysql, 'MySQL' from skill union all SELECT skillId, php, 'php' from skill  union all SELECT skillId, symfony, 'Symfony' from skill union all SELECT skillId, python, 'python' from skill union all SELECT skillId, java, 'Java' from skill union all SELECT skillId, typescript, 'typescript' from skill  union all select skillId, `c++`, 'C++' from skill union all select skillId, jquery, 'jquery'  from skill union all SELECT skillId, latex, 'latex' from skill union all SELECT skillId, angular, 'Angular'  from skill ) t  where skillId ='".$row["fk_skillId"]."'and val = '1'";
                                $result2 = mysqli_query($connect, $sql2);

                              if($result2->num_rows == 0){
                                  $technologies.= "No technologies are selected";
                                  }elseif($result2->num_rows == 1){
                                  $row2 = $result2->fetch_assoc();
                                    $technologies.=$row2["col_name"];
                                   }else{
                                     $rows = $result2->fetch_all(MYSQLI_ASSOC);
                                     foreach($rows as $key => $value2){
                                           $technologies.="-".$value2["col_name"]." " ;
                                     }
                                   }

                
          
              }else{
                 $rows = $resultFavJob->fetch_all(MYSQLI_ASSOC);
                 foreach($rows as $key => $value){
                       $technologies="";
                $sql2="SELECT col_name FROM ( SELECT skillId, html as val, 'HTML' as col_name from skill  union all SELECT skillId, css, 'CSS'
                from skill union all SELECT skillId, javascript, 'JavaScript' from skill union all SELECT skillId, bootstrap, 'Bootstrap'  from skill union all SELECT skillId, mysql, 'MySQL' from skill union all SELECT skillId, php, 'php' from skill  union all SELECT skillId, symfony, 'Symfony' from skill union all SELECT skillId, python, 'python' from skill union all SELECT skillId, java, 'Java' from skill union all SELECT skillId, typescript, 'typescript' from skill  union all select skillId, `c++`, 'C++' from skill union all select skillId, jquery, 'jquery'  from skill union all SELECT skillId, latex, 'latex' from skill union all SELECT skillId, angular, 'Angular'  from skill ) t  where skillId ='".$value["fk_skillId"]."'and val = '1'";
                                $result2 = mysqli_query($connect, $sql2);

                              if($result2->num_rows == 0){
                                  $technologies.= "No technologies are selected";
                                  }elseif($result2->num_rows == 1){
                                  $row2 = $result2->fetch_assoc();
                                    $technologies.=$row2["col_name"];
                                   }else{
                                     $rows = $result2->fetch_all(MYSQLI_ASSOC);
                                     foreach($rows as $key => $value2){
                                           $technologies.="-".$value2["col_name"]." " ;
                                     }
                                   }
                      $description = (strlen($value["description"]) > 70) ? substr($value["description"], 0, 70) . '...' : $value["description"];
                     $output .='<div class="card" style="width: 20rem;">
                      <div class="card-body">
                      <h5 class="card-title">Job title : '.$value["jobTitle"].' </h5>
                       <hr class="myjobs">
                      <p class="card-text">Salary : '.$value["salary"].' , '.$value["hours"].'Hours/Week</p>
                      <h6 class="card-subtitle mb-2 text-muted">Uploaded:  ' .date("d/m/Y",strtotime($value["timestamp"])).'</h6>
                      <p class="card-text">Description:'.$description.' </p>
                      <p class="card-text">Location:'.$value["jLocation"].' </p>
                      <p class="card-text">Technologies:'.$technologies.' </p>
                      <div class="form-group view_fav">
                     
                      <button type="button"  class="btn btn-link fav_btn" id='.$value["jobsId"].' name="fav" style="color:#FFF100" value='.$value["jobsId"].'>
                      <svg class="bi bi-star-fill" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 
                      0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                      </svg>
                     </button>
                      <button type="button" id="view" data-href="jobView.php?id='.$value["jobsId"].'" class="btn btn-primary btn-block openPopup" data-toggle="modal" >View</button>
                     </div>
                     </div>
                     </div>';
                 }

                  echo $output;
              };*/





 

 ?>
  <!DOCTYPE html>
 <html>
 <head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
   <title></title>
 </head>
 <body>
 
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
 </body>

 </html>