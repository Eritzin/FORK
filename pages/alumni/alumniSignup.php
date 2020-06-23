<?php

ob_start();
session_start(); 
require_once '../../actions/dbConnect.php';

$error = false;
$nameError1 = "";
$nameError2 = "";
$emailError = "";
$birthError = "";
$phoneError = "";
$passError = "";

$firstname = "";
$lastname = "";
$email = "";
$birth = "";
$phone = "";
$pass = "";

if ( isset($_POST['btn-signup']) ) {
 
 
$firstname = trim($_POST['firstname']);
$firstname = strip_tags($firstname);
$firstname = htmlspecialchars($firstname);

$lastname = trim($_POST['lastname']);
$lastname = strip_tags($lastname);
$lastname = htmlspecialchars($lastname);

$email = trim($_POST[ 'email']);
$email = strip_tags($email);
$email = htmlspecialchars($email);

$birth = trim($_POST[ 'birth']);
$birth = strip_tags($birth);
$birth = htmlspecialchars($birth);

$phone = trim($_POST[ 'phone']);
$phone = strip_tags($phone);
$phone = htmlspecialchars($phone); 

$pass = trim($_POST['pass']);
$pass = strip_tags($pass);
$pass = htmlspecialchars($pass);




  // basic first_name validation
 if (empty($firstname)) {
  $error = true ;
  $nameError1 = "Please enter your first name.";
 } else if (strlen($firstname) < 3) {
  $error = true;
  $nameError1 = "First name must have at least 3 characters.";
 }


  // basic last_name validation
 if (empty($lastname)) {
  $error = true ;
  $nameError2 = "Please enter your full last name.";
 } else if (strlen($lastname) < 3) {
  $error = true;
  $nameError2 = "Last name must have at least 3 characters.";
 }





 //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
  $error = true;
  $emailError = "Please enter valid email address." ;
 } else {
  // checks whether the email exists or not
  $query = "SELECT email FROM alumni WHERE email='$email'";
  $result = mysqli_query($connect, $query);
  $count = mysqli_num_rows($result);
  if($count!=0){
   $error = true;
   $emailError = "Provided Email is already in use.";
  }
 }


 // basic birthdate validation
  if (empty($birth)){
  $error = true;
  $birthError = "Please enter birthdate.";
 }

  // basic phone number validation
  if (empty($phone)){
  $error = true;
  $phoneError = "Please enter Phone number.";
 }

 // password validation
  if (empty($pass)){
  $error = true;
  $passError = "Please enter password.";
 } else if(strlen($pass) < 4) {
  $error = true;
  $passError = "Password must have atleast 4 characters." ;
 }


 // password hashing for security
// $pass = hash('sha256' , $pass);


 // if there's no error, continue to signup
 if( !$error ) {

  /*$newskill = "INSERT INTO skill(`html`, `css`, `javascript`, `bootstrap`, `mysql`, `php`, `symfony`, `python`, `java`, `typescript`, `c++`, `jquery`, `latex`, `angular`) VALUES ('0','0','0','0','0','0','0','0','0','0','0','0','0','0')";*/

   // $createNewSkill = mysqli_query($connect, $newskill);

   /* $getLastSkillquery = "
    SELECT skillId FROM skill 
    ORDER BY skillId DESC
    LIMIT 1";

    $getLastSkill = mysqli_query($connect, $getLastSkillquery);

    $newskillresult = $getLastSkill->fetch_assoc();

    $skillResult = $newskillresult["skillId"];*/


  $query = "INSERT INTO alumni(firstname, lastname, email, birth, phone, password) VALUES('$firstname','$lastname','$email','$birth', '$phone', '$pass')";
  $res = mysqli_query($connect, $query);
 
  if ($res) {
   $errTyp = "success";
   $errMSG = "Successfully registered, you may login now";
  unset($firstname);
  unset($lastname);
  unset($email);
  unset($pass);
  unset($birth);
  unset($phone);
  } else  {
   $errTyp = "danger";
   $errMSG = "Something went wrong, try again later..." ;
  }
 
 }

}

$error = false;
$emailError = "";
$passwordError = "";
$email = "";
$password = "";

//-------------------------------

if(isset($_POST['btn-signin']))
{
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);

  $password = trim($_POST['password']);
  $password = strip_tags($password);
  $password = htmlspecialchars($password);

//-------------------------------

  if(empty($email))
  {
    $error = true;
    $emailError = "Please enter your email address";
  }
  elseif(!filter_var($email,FILTER_VALIDATE_EMAIL))
  {
    $error = true;
    $emailError = "Please enter a valid email address";
  }

  //-------------------------------

    if(empty($password))
    {
      $error = true;
      $passwordError = "Enter a password";
    }
    else if (strlen($password) < 6)
    {
      $error = true;
      $passwordError = "Your Password is atleast 6 characters long!";
    }

  //-------------------------------

  if(!$error)
  {
    // $password = hash('sha256',$password);

    $result = mysqli_query($connect, "SELECT alumniId, email, password, admin FROM alumni WHERE email = '$email'");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if($count)
    {
      if($row["admin"] == 1)
      {
        $_SESSION["alumni"] = $row["alumniId"];
        header("Location: alumni/alumniAccount.php");
      }
      elseif($row["admin"] == 2)
      {
        $_SESSION["alumni"] = $row["alumniId"];
        header("Location: alumni/alumniAccount.php");
      }
      else
      {
      $_SESSION['alumni'] = $row['alumniId'];
      header("Location: alumni/alumniAccount.php"); 
      }
      $errMSG = "logged in."; 
    }
    else
    {
      $result = mysqli_query($connect, "SELECT businessId, email, password FROM business WHERE email = '$email'");
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $count = mysqli_num_rows($result);
    }


    if($count == 1 && $row['password'] == $password)
    {
      if($row["businessId"])
      {
        $_SESSION["business"] = $row["businessId"];
        header("Location: ../business/businessAccount.php");
        
      }
      else
      {
        $_SESSION["alumni"] = $row["alumniId"];
        header("Location: alumniAccount.php");
      }

    }
    else
    {
      $errMSG = "This user is not registered, try again...";
      echo $count;
      echo $password;
    }
  }
}
 // $newskill = "INSERT INTO skill( html, css, javascript, bootstrap, mysql, php, symfony, python, java, typescript, c++, jquery, latex, angular) VALUES ('0','0','0','0','0','0','0','0','0','0','0','0','0','0')";

 //     $createNewSkill = mysqli_query($connect, $newskill);

 //     $getLastSkillquery = "
 //     SELECT skillId FROM skill 
 //     ORDER BY skillId DESC
 //    LIMIT 1";

 //     $getLastSkill = mysqli_query($connect, $getLastSkillquery);

 //     $newskillresult = $getLastSkill->fetch_assoc();

 //     $skillResult = $newskillresult["skillId"];

 //     $businessinsert = "INSERT INTO business(username,company,email,phone,jobPosition,password,fk_skillId) VALUES ('$username', '$company', '$email','$phone','$position','$password','$skillResult')";

 //     $result = mysqli_query($connect, $businessinsert);

 //     if($result)
 //     {
 //         $errMSG = "Successfully registered, you can login now";
 //         unset($username);
 //         unset($company);
 //         unset($email);
 //         unset($position);
 //         unset($phone);
 //     }
 //     else
 //     {
 //         $errMSG = "Something went wrong...";
 //     }
 // }
?>
<!DOCTYPE html>
<html>
<head>
<title>Alumni Register</title>

<link rel="stylesheet" type="text/css" href="../../assets/css/navbar.css">
<!-- <link rel="stylesheet" type="text/css" href="../../assets/css/index.css"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../../assets/css/signup/asStyle.css">

</head>

<body class="index_b">

  <div class="box">
    
  <a href="../index.php" class="mediaNav">
  <img src="../../assets/img/Logo.png" alt="" width="200" height="100">
  </a>
  
  <a href="https://codefactory.wien/de/home/" class="noBG mediaNav">
    <img class="noBG" src="../../assets/img/cropped-Logo-2.png" alt="" width="250" height="100">
  </a>

<div class="right">
  <div class="dropdown inline padding">
    <a href="../index.php" class="dropbtn">About us</a>
    <div class="dropdown-content">
      <a href="successStories.php">Success stories</a>
      <a href="../careerOpportunities.php">Career</a>
      <a href="../events.php">Events</a>
    </div>
  </div>
  <div class="inline padding">
  <a href="alumniSignup.php" class="link">Sign up</a>
  </div>
  <div class="inline padding">
  <a href="../business/businessSignup.php" class="linkB">Business</a>
  </div>
  <div class="login padding right">
    <form method = "POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>">
    
  <?php  

      if(isset($errMSG))
      {
  ?>      
        <div>
          <?php echo $errMSG;?>
        </div>
  <?php  
      }

  ?>      

    <input class="input" type="text" name="email" placeholder = "E-mail">
    <span><?php echo $emailError?></span>

    <input class="input" type="password" name="password" placeholder = "Enter Password">
    <span><?php echo $passwordError?></span>
    

    <button type="submit" name = "btn-signin">Sign In</button>

    </form>
  </div>
</div>
</div>

















    <div class="container">
        <form method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  autocomplete="off" >
     
         
             
<?php
       if ( isset($errMSG) ) {
     
?>
            <div  class="alert alert-<?php echo $errTyp ?>" >
                             <?php echo  $errMSG; ?>
           </div>

<?php
      }
?>

    <div class="formcontainer">

        <div class = "alumniregisterform">
            
            <p>Alumni Registration Form: </p>
        
             
            <input type ="text"  name="firstname"  class ="form-control"  placeholder ="Enter First Name"  maxlength ="50"   value = "<?php echo $firstname ?>"  />
            <span   class = "text-danger" > <?php   echo  $nameError1; ?> </span >


            <input type ="text"  name="lastname"  class ="form-control"  placeholder ="Enter Last Name"  maxlength ="50"   value = "<?php echo $lastname ?>"  />

            <span   class = "text-danger" > <?php   echo  $nameError2; ?> </span >

            <input type ="date"  name="birth"  class ="form-control"  placeholder ="Enter Birth Date"  maxlength ="50"   value = "<?php echo $birth ?>"  />

            <span   class = "text-danger" > <?php   echo  $birthError; ?> </span >


            <input type ="text"  name="phone"  class ="form-control"  placeholder ="Enter Phone Number"  maxlength ="50"   value = "<?php echo $phone ?>"  />

            <span   class = "text-danger" > <?php   echo  $phoneError; ?> </span >

            <input   type = "email"   name = "email"   class = "form-control"   placeholder = "Enter Your Email"   maxlength = "40"   value = "<?php echo $email ?>"  />

            <span   class = "text-danger" > <?php   echo  $emailError; ?> </span >





            <input   type = "password"   name = "pass"   class = "form-control"   placeholder = "Enter Password"   maxlength = "15"  />

            <span   class = "text-danger" > <?php   echo  $passError; ?> </span >
                     
                         
            <button type = "submit" class = "btn  btn-primary" name = "btn-signup" >Sign Up</button>

        </div>                
    
    </div>
</form>
</body >
</html >



<?php  ob_end_flush(); ?>