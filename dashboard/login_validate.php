<?php
	//include database config file 
include('login_connect.php');
//require_once('interview2017Connect.php');
session_start();
$id="0";
$console='';
$session_id='';
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$id=$_POST["loginID"];
	$password=$_POST["loginPassword"];
	// Checking the received data for correct expressions:
	if (!preg_match("/^[a-zA-Z]*$/",$id)){
		echo "Enter only characters";
	}else{
		//----- PostGRE SQL Commands -----
	
		//creating Query:
		$result = pg_query_params($dbconn, "SELECT * FROM $tableName WHERE username=$1", array($id));
		// $result = pg_query($dbconn, "SELECT * FROM $tableName WHERE username='$id'");
		//Checking for Success Result and only ONE Row entry:
		if ((pg_result_status($result)==2) && (pg_num_rows($result)==1) ) {
			$row = pg_fetch_assoc($result);
			$hash = $row['password'];
			//Take access value
			$test = $row['access'];
			//Verifying the password:
			if (password_verify($password,$hash)){ // <--Replace here
				// Seting Session variables:
				$_SESSION['userId']=$row['uniqueID'];
				$_SESSION['username']=$row['username'];
				$_SESSION['access']=$test;
				if($test == 1){
				header('Location: overview.php');
				}

				//display first page as codestrike if access level contains 2
				else if($test == 2){
					header('Location: events.php');
				}

				//Admin
				else{
					header('Location: overview.php');
				}
			}
			else{
				// Redirecting after unsuccessful login:
				header("Location:login.php");
			}
		}
		// -X-X-X- End of PostGRE SQL Commands -X-X-X-
		//----- SQL Commands -----
		//create query
		// $query="SELECT * FROM $tableName WHERE username='$id'";
		// $result = mysqli_query($conn,$query);
		//check the query in the database
		/*
		if ($result){
			$row=mysqli_fetch_assoc($result);
			$hash=$row["password"];
			if (password_verify($password,$hash)){
				$_SESSION['userId']=$row['Unique ID'];
				$_SESSION['username']=$row['username'];
				header('Location:index.php');
			}else{
				header('Location:login.php');
			}
		}
		*/
		// -X-X-X- End of SQL Commands -X-X-X-
	}
}
?>
