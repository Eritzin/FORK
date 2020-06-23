<?php
ob_start();
session_start();

require_once'../../actions/dbConnect.php';

if(!isset($_SESSION['alumni']))
    {
      header("Location:alumniSignup.php");
       exit;
    }

$alumni = $_SESSION['alumni'];
$sql = "SELECT * FROM alumni WHERE alumniId = $alumni";
$row = mysqli_query($connect, $sql);

$alumni = $row->fetch_assoc();
$id = $alumni['alumniId'];



 // $skillId = $alumni['fk_skillId'];
$sql2 = "SELECT * FROM skill";
$result2 = mysqli_query($connect, $sql2);






?>
<!DOCTYPE html>
<html>
<head>
  <title>Job wall Alumni</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="../../assets/css/navbar.css">
  <link rel="stylesheet" type="text/css" href="../../assets/css/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500&display=swap" rel="stylesheet">
  <style >

    .jobwall{
     margin: auto;
     width: 80%; 

   }
   
  .searchbox{
    margin: auto;
     width: 80%; 
     color: #950A0A;
     margin: auto;
  }
  #defaultOpen{
   border: 2px solid #950A0A !important;
    border-bottom: none !important;
  }
  #fav_tab{
    color: white;
    background-color: #950A0A !important;
  }
  .tabcontent{
    
  }
  .formS{
    margin: auto;
    border: 2px solid #950A0A;
    border-top: none;

  }
  .result{  
     display: flex;
     flex-wrap: wrap;
     flex-direction: row;
     justify-content: space-around;
     margin: auto;
     color: #336699;
  }
  .fav_result{
     display: flex;
     flex-wrap: wrap;
     flex-direction: row;
     justify-content: space-around;
     margin: auto;
     color: #336699;

  }
  .skillcontainer{
    display: flex;
    height: 200px;
     flex-wrap: wrap;
     flex-direction: column;


  }
    .card{
     border: 2px solid #336699!important;
     margin: 20px;
     box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
     transition: 0.3s;
    
   }


.btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:visited {
    background-color: #950A0A !important;
}
 .view_fav{

    display: flex;
    flex-direction: column;
    align-items: flex-end;
}
    #view{
  background-color:#336699 !important;

}
#Favorite{
  border: 2px solid #950A0A;
  border-top: none;
  background-color: #950A0A !important;
}
hr.myjobs{
 
    background: #336699;
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
    <img src="../../assets/img/cropped-Logo-2.png" alt="" width="250" height="100" class="noBG">
  </a>

<div class="right">
  <div class="dropdown inline padding">
    <a href="../index.php" class="dropbtn">About us</a>
    <div class="dropdown-content">
      <a href="../business/successStories.php">Success stories</a>
      <a href="../careerOpportunities.php">Career</a>
      <a href="../events.php">Events</a>
    </div>
  </div>


  <a href="#" class="inline padding link">Job Wall</a>

  <div class="dropdown inline padding red">
    <a href="alumniAccount.php" class="dropbtn">My Account</a>
    <div class="dropdown-content">
      <a href="../logout.php?logout">Log out</a>
    </div>
  </div>
 </div>
</div>









 
<div class="jobwall">
  <div class="searchbox">
    <div class="tab" >
      <ul class="nav nav-tabs nav-justified">
        <li class="nav-item">
          <button class="tablinks nav-link btn-block" onclick="openTab(event, 'Search')" id="defaultOpen">Search jobs</button>
        </li>
        <li class="nav-item">
          <button class="tablinks nav-link btn-block" onclick="openTab(event, 'Favorite')" id="fav_tab" value=<?php echo "'".$id."'"; ?> >Favorite jobs</button>
        </li>
      </ul>
    </div>
    <div id="Search" class="tabcontent">
       
        <form  class="formS col-md-12" method="post" accept-charset="utf-8">
        
          <div class="form-group ">
            <label>Keyword:</label>
            <input type="text" class="form-control" id="search_text" name="search_text">
          </div>
          <div class="form-row">
            <div  class="form-group col-md-4">
              <label>Location:</label>
              <input type="text" class="form-control"id="search_location" name="search_location">
            </div>
            <div  class="form-group col-md-6 skillcontainer">
              <label> Technologies:</label>
              <?php 
                  if($result2->num_rows==0){
                      echo "No result";
                    }else{

                      $rows2 =$result2->fetch_all(MYSQLI_ASSOC);

                      foreach($rows2 as $value){
                        echo'<div class="form-check">
                              <input type="checkbox" class="form-check-input get_value" id='.$value["skill_name"].' value='.$value["skill_name"].' name='.$value["skill_name"].' >
                              <label class="form-check-label" for="exampleCheck1">'.$value["skill_name"].'</label>
                            </div>';
                      };
                    };

              ?>
            </div>
            <div  class="form-group col-md-2">
              <input type="hidden" id="alumniId" value=<?php echo "'".$id."'"; ?>>
              <button type="button" class="btn btn-primary btn-block" id="search_button" name="search_button">Search</button>
            </div>
          
          </div>
        </form>
     
        <div class="result" id="result">
     
       </div>
    </div>

    <div id="Favorite" class="tabcontent">
      <h3>Favorite Jobs</h3> 
      <div class="fav_result" id="fav_result">
      
      </div>
    </div>
</div>
</div>
 <div class="modal fade" id="myModal" role="dialog" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">JOB Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div  class="modal-body">
        
      </div>
       <div class="modal-footer">
        
      </div>
  
      </form>
    </div>
  </div>
</div>  

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" ></script>
<script >//function Ajax search
  
  $(document).ready(function(){
  $('#search_button').click(function(){
        var id = $('#alumniId').val();
        console.log(id);
    var txt=$('#search_text').val();
    var location=$('#search_location').val();
    //var salary=$('#search_salary').val();
        var technologies =[];
        $('.get_value').each(function(){
          if($(this).is(":checked")){
            technologies.push($(this).val());
          }
        });
    if(txt!=''||location!=''||technologies!=''){
      $.ajax({
        url:"../../actions/EfetchAJ.php",// url will be the action
        type: "POST",
        data:{search:txt,
            search_location:location,
            technologies:technologies,
            alumniId:id
            },
        dataType:"text",
        success:function(data){
          $('#result').html(data);
        }
        });
    }else{
      $('#result').html('');
      $.ajax({
        url:"../../actions/EfetchAJ.php",
          type: "POST",
        data:{search:txt,
            search_location:location,
           technologies:technologies,
           alumniId:id
          },
        dataType:"text",
        success:function(data){
          $('#result').html(data);
        }
        });
      }
    })
  })
</script>
<script>    //function Ajax favorite 
  
  // when you click favorite button on each job card.
  $(document).ready(function(){
  //$('.fav_btn').click(function(){
  $(document).on("click", ".fav_btn", function(){
        var alumniId=$("#alumniId").val();
        console.log(alumniId);
    var favJobId=$(this).val();
    console.log("Fav"+ favJobId);

    if(favJobId!=''){
      $.ajax({
        url:"../../actions/EfetchFAJ.php",// url will be the action
        type: "POST",
        data:{favJobId:favJobId,
            alumniId:alumniId
            },
        dataType:"text",
        success:function(data){
          $('#fav_result').html(data);
        }    
        });

      $.ajax({
        url:"../../actions/EfetchAJ.php",// url will be the action
        type: "POST",
        data:{
            alumniId:alumniId
            },
        dataType:"text",
        success:function(data){
          $('#result').html(data);
        }    
        });


    }else{
      $('#fav_result').html('');
      $.ajax({
        url:"../../actions/EfetchFAJ.php",
          type: "POST",
        data:{fav_jobId:fav_jobId,
            alumniId:alumniId
            },
        dataType:"text",
        success:function(data){
          $('#fav_result').html(data);
        }
      
        
        });
      }
    })
  });



   // when you click favorite tab;
  $(document).ready(function(){
    $(document).on("click", "#fav_tab", function(){
    var alumniId=$(this).val();
    
      
        $.ajax({url: "../../actions/EfetchFAJ.php", 
              type: "POST",
          data:{
            alumniId:alumniId
            },
          dataType:"text",
            success: function(result){
                $("#fav_result").html(result);
            }});
            });
      });
  
</script>





<script>
// function for swiching tabs   
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

function openTab(evt, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>

</body>
</html>