<?php  
ob_start();
session_start();

require_once '../actions/dbconnect.php';

// if(isset($_SESSION['user'])!="")
// {
// 	header("Location:");
// 	exit;
// }

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
				header("Location: business/businessAccount.php");
				
			}
			else
			{
				$_SESSION["alumni"] = $row["alumniId"];
				header("Location: alumni/alumniAccount.php");
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
	
</head>
<body>

<div class="right">
	
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

		<input type="text" name="email" placeholder = "E-mail" >
		<span><?php echo $emailError?></span>

		<input type="password" name="password" placeholder = "Enter Password">
		<span><?php echo $passwordError?></span>
		
		<br>

		<button type="submit" name = "btn-signin">Sign In</button>

	</form>
<hr>
</div>


</body>
</html>

