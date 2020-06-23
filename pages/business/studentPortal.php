<?php 
ob_start();
session_start();
require_once '../../actions/dbconnect.php';
require_once '../../actions/jFetch.php';

$db = new DB();

$data = $db->viewData();
// $businessId=1;

if(!isset($_SESSION["business"]))
{ 
  header("Location: ../index.php");
  exit;
}

$businessId = $_SESSION['business'];
$sql = "SELECT * FROM business WHERE businessId = $businessId";
$row = mysqli_query($connect, $sql);

$businessId = $row->fetch_assoc();
$id = $businessId['businessId'];


  /*$skillId = $businessId['fk_skillId'];
  $sql2 = "SELECT * FROM skill WHERE skillId = $skillId";
  $result2 = mysqli_query($connect, $sql2);

  $row2 = $result2->fetch_assoc();*/

$businessId= $id;
?>



<!DOCTYPE html>
<html>
<head>
	<title>Student Portal</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../../assets/css/studentPortalStyle/spStyle.css">
  <link rel="stylesheet" type="text/css" href="../../assets/css/navbar.css">


  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500&display=swap" rel="stylesheet">
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
    <img src="../../assets/img/cropped-Logo-2.png" alt="" width="250" height="100">
  </a>

<div class="right">
  <div class="dropdownB inline padding">
    <a href="../index.php" class="dropbtn">About us</a>
    <div class="dropdown-content">
      <a href="successStories.php">Success stories</a>
      <a href="../careerOpportunities.php">Career</a>
      <a href="../events.php">Events</a>
    </div>
  </div>

  <a href="jobwallBusiness.php" class="inline padding linkB">Job Wall</a>


  <div class="dropdownB inline padding">
    <a href="businessAccount.php" class="dropbtn">My Account</a>
    <div class="dropdown-content">
      <a href="../logout.php?logout">Log out</a>
    </div>
  </div>
 </div>
</div>


<!-- ------------------------------- -->
<hr>

<div class ="container">
    

    <div class= "searchdiv" >

        <div class ="searchbox">
            
            <span>Search Alumni</span>	
            <input id = "searchbox" type="text" name="firstname" placeholder="..." id="searchBox" oninput= "search(this.value)">

        </div>
  

    <!-- ------------------------------- -->

        <div id = "searchResults" >
   
        </div>
    </div>
 
    <!-- ------------------------------- -->

    <div id = "dataViewer">
    	
    <?php  
    	foreach ($data as $i) 
    	{
    		$id=$i['alumniId'];
    		$skills = "SELECT * FROM skill WHERE skillId = $id";
    		$result = mysqli_query($connect, $skills);
    		$row = $result->fetch_assoc();

    ?>	


    	<div class = "alumni">

            <div class = "top">
                
                <div class = "topLeft">
                    <img style ="width:200px" class = "aImage" src="<?php echo $i['img'] ?>">
                </div>

                <div class = "topRight"> 
            		    <p><?php echo $i['firstname'] ?> <?php echo $i['lastname'] ?></p>
            		
                    <a target ="_blank" href ='<?php echo $i['portfolioUrl'] ?>'>My Portfolio</a>
            		<a href ="../alumni/alumniProfile.php?id=<?php echo $id ?>">See more here</a>
            		<a href ="https://codefactory.wien/en/contact-en/">Hire me</a>
                </div>

            </div>



            <div class = "bottom">
                
                <div class = "bottomLeft">
                    

            		<div id="skills">
                        <p>My Skills</p>

            			<?php  

            				if($result)
            				{
            					$names = mysqli_num_fields($result);
            					$value = mysqli_fetch_row($result);

            					for($i=0; $i<$names; $i++)
            					{
            						$meta = mysqli_fetch_field($result);

                                    if($row)
                                    {
                                        
                						if($row[$meta->name]==1)
                						{
                						  echo '<span>'. $meta->name .', </span>';
                						}
                                    }
                                    

            					}
            				}

            			?>
            		</div>

                </div>


                <div class = "bottomRight">

                    <form> 
                    	<input type="hidden" class="businessId" value="<?php echo $businessId ?>">
                        <button type="button"  class="fav_btn" id="<?php echo $id ?>" name="fav" value="<?php echo $id ?>">Save Me</button>
                    </form> 
                </div>


            </div>




    	</div>
    <?php  

    	}
    ?>
    </div>
</div>
<!-- ------------------------------- -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" ></script>
<script src="../../assets/js/jStudentPortalScript.js" type="text/javascript" charset="utf-8"></script>
<script>    
//function Ajax favorite 

  // when you click favorite button on each alumnis card.
  $(document).ready(function(){

  $(document).on("click", ".fav_btn", function(){
        $(this).addClass("fav");
        $(this).text("Saved");
        var businessId=$(".businessId").val();
        console.log(businessId);
       var favAlId=$(this).val();
    console.log("Fav"+ favAlId);

    if(favAlId!=''){
      $.ajax({
        url:"../../actions/EfetchBFA.php",// url will be the action
        type: "POST",
        data:{businessId:businessId,
            favAlId:favAlId
            },
        dataType:"text",
        success:function(data){
          $('#fav_resultA').html(data);
        }
      
        
        });
    }else{
      $('#fav_resultA').html('');
      $.ajax({
        url:"../../actions/EfetchBFA.php",
          type: "POST",
        data:{businessId:businessId,
            favAlId:favAlId
            },
        dataType:"text",
        success:function(data){
          $('#fav_resultA').html(data);
        }
      
        
        });
      }
    })
  })

</script>
</body>
</html>