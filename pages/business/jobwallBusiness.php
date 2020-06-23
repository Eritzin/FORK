<?php
ob_start();
session_start();

require_once'../../actions/dbConnect.php';

 

if(!isset($_SESSION['business']))
    {
      header("Location:businessSignup.php");
       exit;
    }

$businessId=$_SESSION['business'];
$sql = "SELECT * FROM business WHERE businessId = $businessId";
$row = mysqli_query($connect, $sql);

$businessId = $row->fetch_assoc();
$id = $businessId['businessId'];


 // $skillId = $businessId['fk_skillId'];
  

$businessId= $id;






$res = mysqli_query($connect,"SELECT `COLUMN_NAME` FROM INFORMATION_SCHEMA.COLUMNS  WHERE TABLE_SCHEMA = 'fullstackproject' AND TABLE_NAME = 'skill' AND NOT `COLUMN_NAME`='skillId'");

?>
<!DOCTYPE html>
<html>

<head>
    <title>Post Job</title>
   
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/navbar.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/index.css">
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500&display=swap" rel="stylesheet">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<style type="text/css" media="screen">
  body{
    font-family: Oswald;

  }
  .jobwall{
     margin: auto;
     width: 80%; 

  }
  .jobform{
    color: white;
    margin: auto;
    background: #336699;
    border-radius: 25px;
  }
  .skillcontainer{
    display: flex;
    height: 200px;
     flex-wrap: wrap;
     flex-direction: column;

  }
  hr.jobtitle{
    margin: 1px;
    background: white;
  }
  hr.myjobs{
 
    background: #336699;
  }
  .postTitle{
    color: #336699;
    margin:auto;
    margin-top: 20px;
    width: 80%;
  }
  .posts{
     display: flex;
     flex-wrap: wrap;
     flex-direction: row;
     margin: auto;
     width: 80%;
     color: #336699;
  }
   .card{
    border: 2px solid #336699!important;
    margin: 20px;
     box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
     transition: 0.3s;

   }
   .btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:visited {
    background-color:#336699 !important;
}
.btn-danger, .btn-danger:hover, .btn-danger:active, .btn-danger:visited {
    background-color:#950A0A !important;
}
.card-button{
    display: flex;
    justify-content: space-around;

}


</style>
</head>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500&display=swap');
  </style>

<body>



  <div class="box">
    
<a href="../index.php" class="mediaNav">
  <img src="../../assets/img/Logo.png" alt="" width="200" height="100">
  </a>
  
  <a href="https://codefactory.wien/de/home/" class="mediaNav">
    <img class="noBG" src="../../assets/img/cropped-Logo-2.png" alt="" width="250" height="100">
  </a>

<div class="right">
 
  <a href="studentPortal.php" class="inline padding linkB">Student Portal</a>
  <a href="jobwallBusiness.php" class="inline padding linkB">Job Wall</a>

  <div class="dropdownB inline padding blue">
    <a href="businessAccount.php" class="dropbtn">My Account</a>
    <div class="dropdown-content">
      <a href="../logout.php?logout">Log out</a>
    </div>
  </div>
 </div>
</div>



<div class="jobwall">
  <div class="createjob">
    
    <form action="../../actions/EcreateBJ.php" method="post" class="needs-validation col-md-9 jobform" novalidate>
        <h2 style="">Job title</h2>
        <hr class="jobtitle">
        <input type="hidden" class="form-control" name="id" value=<?php echo "'".$id."'" ?>>
       
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Job title:</label>
                <input type="text" class="form-control" name="jobTitle" required>
                <div class="invalid-feedback">
                  Please provide a Job title.
                </div>
            </div>
            <div class="form-group col-md-6">
                <label>Location</label>
                <input type="text" class="form-control" name="jLocation" required>
                <div class="invalid-feedback">
                  Please provide a location.
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label>Description</label>
                <textarea type="text" class="form-control" name="description" required></textarea>
                 <div class="invalid-feedback">
                  Please provide a description.
                </div>
            </div>
        </div>
        <div class="form-row">
          <label>Skills:</label>
            <div class="form-group col-md-7 skillcontainer">
                
                <?php

                   $sql2 = "SELECT skill_name FROM skill";
                   $result2 = mysqli_query($connect, $sql2);
                    if($result2->num_rows>0){
                   while($row=$result2->fetch_assoc())
                   {

                      echo  '
                     <div class="form-check">
                     <input type="checkbox" class="form-check-input-lg" id="exampleCheck1" value="1" name="'.$row['skill_name'].'" >
                     <label class="form-check-label col-form-label-lg" for="exampleCheck1">'.$row['skill_name'].'</label>
                     </div>';
                 }
                 }
                ?>
            </div>
            <div class="form-group col-md-4">
                <label>Additional:</label>
                <textarea type="text" class="form-control" name="moreSkills"></textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label>Salary:</label>
                <input type="text" class="form-control" name="salary" required>
                <div class="invalid-feedback">
                  Please provide a minimum salary.
                </div>
            </div>
            <div class="form-group col-md-3">
                <label>Hours :</label>
                <div class="input-group">
                <input type="text" class="form-control" name="hours" required>
                 <div class="input-group-prepend">
                    <div class="input-group-text">h/w</div>
                  </div>
                   <div class="invalid-feedback">
                  Please provide hours per week.
                </div>
                </div>
               
            </div>
            <div class="form-group col-md-3">
                <div class="form-check active">              
                    <input type="checkbox" class="form-check-input-lg" id="exampleCheck1" name="active" value="1">
                     <label class="col-form-label col-form-label-lg" > : Active</label>
                </div>
            </div>
            <div class="form-group col-md-3">
                <button type="submit" class="btn btn-light btn-block" name="submit">Post</button>
            </div>
        </div>
    </form>
</div>
<div class="postTitle">
 <h2>My Jobs: </h2>
    <hr class="myjobs">
</div>
<div class="posts">
   
    <?php
     $sql= "SELECT * FROM jobs WHERE fk_businessId=$id";
     $result = mysqli_query($connect, $sql);
     $active="";
     if($result->num_rows == 0){
                    echo "No result";
                 }elseif($result->num_rows == 1){
                    $row = $result->fetch_assoc();
                    //
                    $technologies=""; 
                    $sql2="SELECT skill_name FROM skill INNER JOIN skill_jobs ON skillId = fk_skillId WHERE fk_jobsId ='".$row["jobsId"]."'";
                     $result2 = mysqli_query($connect, $sql2);
                     if($result2->num_rows == 0){
                          $technologies.= "No technologies are selected";
                      }elseif($result2->num_rows == 1){
                          $row2 = $result2->fetch_assoc();
                          $technologies.=$row2["skill_name"];
                      }else{
                          $rows2 = $result2->fetch_all(MYSQLI_ASSOC);
                          foreach($rows2 as $key => $value2){
                            $technologies.="-".$value2["skill_name"]." " ;
                           }
                      }
                      
                      if($row["active"]==1){
                        $active="☑";
                      }else{
                        $active=" NOT active";
                      }

                           //
                     $description = (strlen($row["description"]) > 70) ? substr($row["description"], 0, 70) . '...' : $row["description"];
                    echo 
                    "<div class=\"card\" style=\"width: 18rem;\">
                      <div class=\"card-body\">
                      <h5 class=\"card-title\">Job title : "  .$row["jobTitle"]." </h5>
                      <hr class=\"myjobs\">
                      <p class=\"card-text\"> Salary :".$row["salary"]."  ".$row["hours"]."  hours/week</p>
                      <h6 class=\"card-subtitle mb-2 text-muted\">Uploaded:  "  .date("d/m/Y",strtotime($row["timestamp"]))."</h6>
                      <p class=\"card-text\">Description:". $description." </p>
                      <p class=\"card-text\">Location:".$row["jLocation"]." </p>
                      <p class=\"card-text\">Technologies:".$technologies." </p>
                      <div class=\"row\">
                      <p class=\"card-text\">Active:".$active."</p>
                      <button type=\"button\" data-href=\"jobEdit.php?id=".$row["jobsId"]."\"   class=\"btn btn-primary btn-block openPopupE\" data-toggle=\"modal\">Edit</button>
                      <button type=\"button\" data-href=\"jobDelete.php?id=".$row["jobsId"]."\"   class=\"btn btn-danger btn-block openPopupD\" data-toggle=\"modal\">Delete</button>
                      
                      </div>
                     </div>
                     </div>";
                 }else{
                    $rows = $result->fetch_all(MYSQLI_ASSOC);
                    foreach($rows as $key => $value){
                       //
                       $technologies="";
                        $sql2="SELECT skill_name FROM skill INNER JOIN skill_jobs ON skillId = fk_skillId WHERE fk_jobsId ='".$value["jobsId"]."'";
                        $result2 = mysqli_query($connect, $sql2);

                        if($result2->num_rows == 0){
                            $technologies.= "No technologies are selected";
                          }elseif($result2->num_rows == 1){
                            $row = $result2->fetch_assoc();
                            $technologies.=$row["skill_name"];
                          }else{
                            $rows = $result2->fetch_all(MYSQLI_ASSOC);
                              foreach($rows as $key => $value2){
                                $technologies.="-".$value2["skill_name"]." " ;
                              }
                        }

                        if($value["active"]==1){
                           $active="☑";
                           }else{
                            $active="NOT active";
                          }
                      //
                    
                        $description = (strlen($value["description"]) > 70) ? substr($value["description"], 0, 70) . '...' : $value["description"];
                        echo   "<div class=\"card\" style=\"width: 18rem;\">
                                  <div class=\"card-body\">
                                    <h5 class=\"card-title\">Job title : ".$value["jobTitle"]." </h5>
                                    <hr class=\"myjobs\">
                                    <p class=\"card-text\"> Salary : ".$value["salary"]."   ,     ".$value["hours"]." hours/week</p>
                                    <h6 class=\"card-subtitle mb-2 text-muted\">Uploaded: "  .date("d/m/Y",strtotime($value["timestamp"]))."</h6>
                                    <p class=\"card-text\">Description:".$description." </p>
                                    <p class=\"card-text\">Location:".$value["jLocation"]." </p>
                                    <p class=\"card-text\">Technologies:".$technologies." </p>
                                    <div class=\"card-button row\">
                                    <p class=\"card-text\">Active:".$active."</p>
                                    <button type=\"button\"  data-href=\"jobEdit.php?id=".$value["jobsId"]."\" class=\"btn btn-primary btn-block openPopupE\" data-toggle=\"modal\" >Edit</button>
                                    <button type=\"button\"  data-href=\"jobDelete.php?id=".$value["jobsId"]."\" class=\"btn btn-danger btn-block openPopupD\" data-toggle=\"modal\" >Delete</button>
                                    
                                    </div>
                                  </div>
                               </div>";
                  }         
            };

    ?>
  </div>
    <div class="modal fade" id="myModal" role="dialog" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content jobform">
      <div class="modal-header ">
        <h5 class="modal-title" id="exampleModalLongTitle">Job Edit page</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  method='post' action="../../actions/OeditJobs.php">
      <div  class="modal-body  ">
        
      </div>
       <div class="modal-footer">
        <button type="submit" class="btn btn-light">Save changes</button>
      </div>
  
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="myModal2" role="dialog" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content jobform">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Job Delete Page</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form  method='post' action="../../actions/EdeleteBJ.php">
      <div  class="modal-body">
       
      </div>
       <div class="modal-footer">
        <a class="btn btn-light" href="jobwallBusiness.php" role="button">No, Go back to page!</a>
        <button type="submit" class="btn btn-danger">Yes, delete it!</button>  
      </div>
      </form>
    
    </div>
  </div>
</div>

<script>
  // for popup function edit
$(document).ready(function(){
    $('.openPopupE').on('click',function(){
        var dataURL = $(this).attr('data-href');

        console.log(dataURL);
        $('.modal-body').load(dataURL,function(){
            $('#myModal').modal({show:true});
        });
    }); 
});
// for popup function delete
$(document).ready(function(){
    $('.openPopupD').on('click',function(){
        var dataURL = $(this).attr('data-href');

        console.log(dataURL);
        $('.modal-body').load(dataURL,function(){
            $('#myModal2').modal({show:true});
        });
    }); 
});

// for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
</body>

</html>
<?php  ob_end_flush(); ?>