<?php 

ob_start();
session_start();
require_once '../actions/dbconnect.php';

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
				$_SESSION["superAdmin"] = $row["alumniId"];
				header("Location: alumni/alumniAccount.php");
			}
			elseif($row["admin"] == 2)
			{
				$_SESSION["superAdmin"] = $row["alumniId"];
				header("Location: alumni/alumniSuperAdmin.php");
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
				header("Location: business/businessAccount.php");
				
			}
			else
			{
				if($row["admin"] == 1)
				{
					$_SESSION["admin"] = $row["alumniId"];
					header("Location: alumni/alumniAdmin.php");
				}
				elseif($row["admin"] == 2)
				{
					$_SESSION["superAdmin"] = $row["alumniId"];
					header("Location: alumni/alumniSuperAdmin.php");
				}
				else
				{
					$_SESSION['alumni'] = $row['alumniId'];
					header("Location: alumni/alumniAccount.php");	
				}
				$errMSG = "logged in.";	
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
?>

<!DOCTYPE html>
<html>
<head>
	<title>About Us / INDEX</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/navbar.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/index.css">
	<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500&display=swap" rel="stylesheet">
	
</head>
	<style>
	@import url('https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500&display=swap');
	</style>

<body>





<div class="box">
	<a href="index.php" >
	<img class="mediaNav" src="../assets/img/Logo.png" alt="" width="200" height="100">
	</a>
	
	<a href="https://codefactory.wien/de/home/" class="noBG mediaNav">
		<img class="noBG aboutNav" src="../assets/img/cropped-Logo-2.png" alt="" width="250" height="100">
	</a>
	<div class="dropdown inline padding">
    <a href="#" class="dropbtn marginO">About us</a>
    <div class="dropdown-content">
      <a href="business/successStories.php">Success stories</a>
      <a href="careerOpportunities.php">Career</a>
      <a href="events.php">Events</a>
    </div>
  </div>


	<div class="inline padding">
	<a href="alumni/alumniSignup.php" class="link">Sign up</a>
	</div>

	<div class="inline padding">
	<a href="business/businessSignup.php" class="linkB">Business</a>
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







<div>
	
	<div>
		

		<div>
			
			<img class="jumbo" src="../assets/img/aboutJumbo.PNG" alt="">

		</div>

		<div class="mediaNav">
			
			<img class="jumbo indexIMG" src="../assets/img/aboutJumbo2.PNG" alt="">

		</div>
	
		
		<div class="aboutBox">
			
			<p class="aboutText">
					We are CodeFactory - a professional, private programming school, based on the principle
					of the American coding bootcamps. We educate people from diverse backgrounds in
					web-development using a wide array of technologies and preparing you for the Austrian and
					international job market. Founded in 2016, we have educated over 400 web-developers on
					both private and corporate basis since, with a record-breaking 90% employment rate for
					our graduates. Now, we’re embarking on a new mission to build a professional network for
					graduates, business and anyone seriously interested in coding and wed-development with
					the goal to facilitate the fast and effective employment of our alumni, to provide our current
					students with reliable and secure job opportunities at leading companies in Austria and
					abroad and to provide business with a much needed pool of certified programming professionals.
			</p>

		</div>
		
		<div class="aboutBox">
			<p class="aboutText">We would welcome you as part of C.A.N. CodeFactory Alumni Network!</p>
		</div>
		
		<div class="signup">
			
			<div class="signM">
				<img src="../assets/img/avatar2.png" alt="">			
			</div>

			<div>
				<img src="../assets/img/avatar1.png" alt="">
			</div>
		</div>
	</div>
</div>
			<div class="signup">
			<a class="signM" href="alumni/alumniSignup.php"><img src="../assets/img/signupA.PNG" alt=""></a>
			<a href="business/businessSignup.php"><img src="../assets/img/signupB.PNG" alt=""></a>	
			</div>
			





	
	<div>
		<p class="aboutText noBG">Powered by:</p>

		<a class="jumbo aboutText" target="_blank" href="https://codefactory.wien/en/home-en/">

			<img  style="width:50%;"src="../assets/img/cropped-logo-2.png" alt="">

		</a>
	</div>





</body>
</html>