<?php 
require_once 'dbConnect.php';


// checkBox($_POST["html"]);
if($_POST){
		$id = $_POST["id"];
		$html = (isset($_POST["html"])) ? 1 : 0;
		$css = (isset($_POST["css"])) ? 1 : 0;
		$javascript = (isset($_POST["javascript"])) ? 1 : 0;
		$bootstrap = (isset($_POST["bootstrap"])) ? 1 : 0;
		$mysql = (isset($_POST["mysql"])) ? 1 : 0;
		$php = (isset($_POST["php"])) ? 1 : 0;
		$symfony = (isset($_POST["symfony"])) ? 1 : 0;
		$python = (isset($_POST["python"])) ? 1 : 0;
		$java = (isset($_POST["java"])) ? 1 : 0;
		$typescript = (isset($_POST["typescript"])) ? 1 : 0;
		$cPP = (isset($_POST["cPP"])) ? 1 : 0;
		$jquery = (isset($_POST["jquery"])) ? 1 : 0;
		$latex = (isset($_POST["latex"])) ? 1 : 0;
		$angular = (isset($_POST["angular"])) ? 1 : 0;


	if($html == "1"){
 	mysqli_query($connect, "UPDATE `skill` SET `html`= '1' WHERE skillId = '$id' ");
	} else {
 	mysqli_query($connect, "UPDATE `skill` SET `html`= '0' WHERE skillId = '$id'");
	}

	if($css == "1"){
 	mysqli_query($connect, "UPDATE `skill` SET `css`= '1' WHERE skillId = '$id' ");
	} else {
 	mysqli_query($connect, "UPDATE `skill` SET `css`= '0' WHERE skillId = '$id'");
	}

	if($javascript == "1"){
 	mysqli_query($connect, "UPDATE `skill` SET `javascript`= '1' WHERE skillId = '$id' ");
	} else {
 	mysqli_query($connect, "UPDATE `skill` SET `javascript`= '0' WHERE skillId = '$id'");
	}

	if($bootstrap == "1"){
 	mysqli_query($connect, "UPDATE `skill` SET `bootstrap`= '1' WHERE skillId = '$id' ");
	} else {
 	mysqli_query($connect, "UPDATE `skill` SET `bootstrap`= '0' WHERE skillId = '$id'");
	}

	if($mysql == "1"){
 	mysqli_query($connect, "UPDATE `skill` SET `mysql`= '1' WHERE skillId = '$id' ");
	} else {
 	mysqli_query($connect, "UPDATE `skill` SET `mysql`= '0' WHERE skillId = '$id'");
	}

	if($php == "1"){
 	mysqli_query($connect, "UPDATE `skill` SET `php`= '1' WHERE skillId = '$id' ");
	} else {
 	mysqli_query($connect, "UPDATE `skill` SET `php`= '0' WHERE skillId = '$id'");
	}

	if($symfony == "1"){
 	mysqli_query($connect, "UPDATE `skill` SET `symfony`= '1' WHERE skillId = '$id' ");
	} else {
 	mysqli_query($connect, "UPDATE `skill` SET `symfony`= '0' WHERE skillId = '$id'");
	}

	if($python == "1"){
 	mysqli_query($connect, "UPDATE `skill` SET `python`= '1' WHERE skillId = '$id' ");
	} else {
 	mysqli_query($connect, "UPDATE `skill` SET `python`= '0' WHERE skillId = '$id'");
	}

	if($java == "1"){
 	mysqli_query($connect, "UPDATE `skill` SET `java`= '1' WHERE skillId = '$id' ");
	} else {
 	mysqli_query($connect, "UPDATE `skill` SET `java`= '0' WHERE skillId = '$id'");
	}

	if($typescript == "1"){
 	mysqli_query($connect, "UPDATE `skill` SET `typescript`= '1' WHERE skillId = '$id' ");
	} else {
 	mysqli_query($connect, "UPDATE `skill` SET `typescript`= '0' WHERE skillId = '$id'");
	}

	if($cPP == "1"){
 	mysqli_query($connect, "UPDATE `skill` SET `c++`= '1' WHERE skillId = '$id' ");
	} else {
 	mysqli_query($connect, "UPDATE `skill` SET `c++`= '0' WHERE skillId = '$id'");
	}

	if($jquery == "1"){
 	mysqli_query($connect, "UPDATE `skill` SET `jquery`= '1' WHERE skillId = '$id' ");
	} else {
 	mysqli_query($connect, "UPDATE `skill` SET `jquery`= '0' WHERE skillId = '$id'");
	}

	if($latex == "1"){
 	mysqli_query($connect, "UPDATE `skill` SET `latex`= '1' WHERE skillId = '$id' ");
	} else {
 	mysqli_query($connect, "UPDATE `skill` SET `latex`= '0' WHERE skillId = '$id'");
	}

	if($angular == "1"){
 	mysqli_query($connect, "UPDATE `skill` SET `angular`= '1' WHERE skillId = '$id' ");
	} else {
 	mysqli_query($connect, "UPDATE `skill` SET `angular`= '0' WHERE skillId = '$id'");
	}


// function checkBox($val){
// 	if($val == 1){
// 		$result = "checked";
// 	}else {
// 		$result = "unchecked";
// 	}
// 	return $result;
// }

// 	$html = checkBox($_POST["html"]);


header("Location: ../pages/alumni/alumniAccount.php?id=$id");


}

 ?>

