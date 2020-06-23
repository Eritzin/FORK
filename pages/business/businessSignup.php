<?php  
ob_start();
session_start();

require_once '../../actions/dbconnect.php';


$error = false;
$checkboxError = "";
$usernameError = "";
$companyError = "";
$emailError = "";
$positionError = "";
$phoneError = "";
$passwordError = "";

$username = "";
$company = "";
$email = "";
$position = "";
$phone = "";
$password = "";

//-------------------------------
if(isset($_POST['btn-registerBusiness']))
{
	$username = trim($_POST['username']);
	$username = strip_tags($username);
	$username = htmlspecialchars($username);

	$company = trim($_POST['company']);
	$company = strip_tags($company);
	$company = htmlspecialchars($company);

	$email = trim($_POST['email']);
	$email = strip_tags($email);
	$email = htmlspecialchars($email);

	$password = trim($_POST['password']);
	$password = strip_tags($password);
	$password = htmlspecialchars($password);

	$position = trim($_POST['position']);
	$position = strip_tags($position);
	$position = htmlspecialchars($position);

	$phone = trim($_POST['phone']);
	$phone = strip_tags($phone);
	$phone = htmlspecialchars($phone);
}

//-------------------------------
if(!isset($_POST['CoC']))
{
	$error = true;
	$checkboxError = "Please accept the CoC";
}
//-------------------------------

if(empty($username))
{
	$error = true;
	$nameError = "Please enter your full Username";
}
elseif(!preg_match("/^[a-zA-Z ]+$/",$username))
{
	$error = true;
	$nameError = "Name must contain alphabets and space.";
}

//-------------------------------

if(empty($company))
{
	$error = true;
	$companyError = "Please enter your full name";
}
elseif(!preg_match("/^[a-zA-Z ]+$/",$company))
{
	$error = true;
	$companyError = "Company must contain alphabets and space.";
}

//-------------------------------

if(!filter_var($email,FILTER_VALIDATE_EMAIL))
{
	$error = true;
	$emailError = "Please enter a valid email address.";
}
else
{
	$emailcheck = "SELECT email FROM business WHERE email = '$email'";
	$result = mysqli_query($connect, $emailcheck);
	$count = mysqli_num_rows($result);

	if($count != 0)
	{
		$error = true;
		$emailError = "Email is already in use";
	}
}

//-------------------------------

if(empty($password))
{
	$error = true;
	$passError = "Please enter a password";
}
elseif(strlen($password) < 6)
{
	$error = true;
	$passwordError = "Password must be atleast 6 characters long";
}

// $password = hash('sha256',$password);

//------------------------------- if inputs are ok continue

if(!$error)
{
	

	$businessinsert = "INSERT INTO business(username,company,email,phone,jobPosition,password) VALUES ('$username', '$company', '$email','$phone','$position','$password')";

	$result = mysqli_query($connect, $businessinsert);

	if($result)
	{
		$errMSG = "Successfully registered, you can login now";
		unset($username);
		unset($company);
		unset($email);
		unset($position);
		unset($phone);
	}
	else
	{
		$errMSG = "Something went wrong...";
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
				header("Location: businessAccount.php");
				
			}
			else
			{
				$_SESSION["alumni"] = $row["alumniId"];
				header("Location: ../alumni/alumniAccount.php");
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
//-------------------------------

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
				header("Location: businessAccount.php");
				
			}
			else
			{
				$_SESSION["alumni"] = $row["alumniId"];
				header("Location: ../alumni/alumniAccount.php");
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
	<title>Business Register</title>
	<link rel="stylesheet" type="text/css" href="../../assets/css/navbar.css">

	<link rel="stylesheet" type="text/css" href="../../assets/css/signup/bsStyle.css">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500&display=swap" rel="stylesheet">
</head>


<body>

<div class="box">
    
  <a href="../index.php">
  <img src="../../assets/img/Logo.png" alt="" width="200" height="100" class="mediaNav">
  </a>
  
  <a href="https://codefactory.wien/de/home/" class="noBG mediaNav">
    <img class="noBG" src="../../assets/img/cropped-Logo-2.png" alt="" width="250" height="100">
  </a>

<div class="right">
  
  <div class="inline padding">
  <a href="../alumni/alumniSignup.php" class="linkB">Sign up</a>
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














<div class = "container">
	<div class = "imgdiv">
		<img class="topimg" src="../../assets/img/j.CAN.png" alt="sad">
	</div>

	<div class = "coc">
		<p class="cocheader">Conditions of Cooperation:</p>
		<p class="coctext">
			To hire an Alumni, please contact us. 
			<br>
			There will be a 2500 EUR finder’s fee to pay for our services. You will be automatically registered and can then proceed to look through our Catalog of available Alumnis.
			<br>
			Welcome to the C.A.N., CodeFactory Alumni Network!
		</p>
	</div>








	<div class="formcontainer">

		<div class = "businessregisterform">

			<form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>">
				
				<p>C.A.N Registration form:</p>

		<?php  

				if(isset($errMSG))
				{
		?>			
					<div class ="error">
						<?php echo $errMSG;?>
					</div>
		<?php  
				}

		?>		
				<span>I agree with the CoC:</span>
				<input class="check" type="checkbox" name="CoC" value="value1">
			
				<span><?php echo $checkboxError?></span>
				
				<input type="text" name="username" placeholder = "*Enter Username" >
				<span><?php echo $usernameError?></span>
				
		

				<input type="text" name="company" placeholder = "*Company" >
				<span><?php echo $companyError?></span>
				
			

				<input type="email" name="email" placeholder="*E-mail">
				<span> <?php echo $emailError?></span>
				
			

				<input type="password" name="password" placeholder = "*Enter Password">
				<span><?php echo $passwordError?></span>

			

		<!-- --------------- required ---------------- -->

				<input type="text" name="position" placeholder = "Position" >
				<span><?php echo $positionError?></span>
		

				<input type="text" name="phone" placeholder = "Phone" >
				<span><?php echo $phoneError?></span>

				

		<!-- --------------- not required ---------------- -->
		<div class = "interact">
			
			<button class = "btn" type="submit" name ="btn-registerBusiness">
				Register
			</button>

		</div>
			</form>
			
		</div>


	</div>
</div>

</body>
</html>

<?php  ob_end_flush(); ?>