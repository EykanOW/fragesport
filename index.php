<?php 
include "fragor/fragesport.php";
include "visual/header.php";
session_start();

if (!isset($_GET["quiz"])) {
	$_GET["quiz"] = "";
}

if (!isset($_SESSION["quiz"]) || $_GET["quiz"] == "notstart") {
	$_SESSION["quiz"] = "notstart";
}


$quiz = new Quiz("questions.json");
$_SESSION["quizclass"] = $quiz;



if (isset($_POST["form"])) {
	
	if ($_POST["form"] == "nameform") {

		if ($_POST["name"] == "") {
		
			$_POST["error"] = '<strong style = "color: red";> Du måste skriva ett namn!</strong>';

		} else if (is_string($_POST["name"])){ 
			//Spara i session
			$_SESSION["namn"] = $_POST["name"];

			$_SESSION["quiz"] = "start";
		}
	} 
	if ($_POST["form"] == "questionform") {
		//En svara har besvarats
		//TODO
		

	}	
}


if (!isset($_POST["error"])) {
	$_POST["error"] = "";
}
if (!isset($_POST["quiz"])) {
	$_POST["quiz"] = "";
}
if (!isset($_GET["page"])) {
    $_GET["page"] = "";
}
if (!isset($_GET["pagenum"])) {
	$_GET["pagenum"] = "0";
}

// keep pagenum to the number of json file questions
if ($_GET["pagenum"] < "0") {
	$_GET["pagenum"] = "0";
}
if ($_GET["pagenum"] > ($quiz->getLength() - 1)) {
	$_GET["pagenum"] = $quiz->getLength() - 1;
}


if ($_SESSION["quiz"]=="start") {

	include "visual/navbar.php";

	echo $quiz->getQuestion($_GET["pagenum"]);
	include "visual/pages/questionform.php";


} else {

	include "visual/pages/nameform.php";
}



include "visual/footer.php";