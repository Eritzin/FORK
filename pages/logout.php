<?php  

session_start();


if(!isset($_SESSION["alumni"]) && !isset($_SESSION["business"]))
{
	header("Location: index.php");
}
else if(isset($_SESSION["alumni"])!="")
{
	if(isset($_GET['logout']))
	{
		unset($_SESSION["alumni"]);
		session_unset();
		session_destroy();
		header("Location: index.php");
		echo "alumni logout";
		exit; 
	}
}
else if(isset($_SESSION["business"])!="")
{
	if(isset($_GET['logout']))
	{
		unset($_SESSION["business"]);
		session_unset();
		session_destroy();
		echo "business logout";
		header("Location: index.php");
		exit; 
	}	
}
else if(isset($_SESSION["admin"])!="")
{
	if(isset($_GET['logout']))
	{
		unset($_SESSION["admin"]);
		session_unset();
		session_destroy();
		echo "admin logout";
		header("Location: index.php");
		exit; 
	}	
}
else if(isset($_SESSION["superAdmin"])!="")
{
	if(isset($_GET['logout']))
	{
		unset($_SESSION["superAdmin"]);
		session_unset();
		session_destroy();
		echo "superAdmin logout";
		header("Location: index.php");
		exit; 
	}	
}
else 
{
	echo "Logout error";
}

?>

<!-- so logoutlink einfügen -->
<!-- <a href='logout.php?logout'>Logout</a> --> 