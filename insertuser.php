<?php
session_start();
include('db.php');
if (isset($_POST['resister'])&& $_POST['resister'] == 'yes') {


 $name = $_POST['name'];
 $email = $_POST['email'];
 $password = $_POST['password'];
 //$hashpassword = password_hash($password, PASSWORD_DEFAULT);
 $date = date("Y-m-d");

if (!empty($name && $email && $password)) {
 	$insert  = "INSERT INTO `userinformation`(`name`, `email`, `passsword`,`date`) VALUES ('".$name."','".$email."','".$password."','".$date."')";
 	$query = mysqli_query($con, $insert);
 		if ($query) {
 			echo "Hey Mr ".$name."  Welcome";
 		}
 	}else{
 		echo "fill in tthe gaps </br> *email and password are required";
 	}
 }

if (isset($_POST['login'])&& $_POST['login'] == 'yes'){
	$email = $_POST['email'];
	$password = $_POST['password'];
	//$hashpassword = password_hash($password, PASSWORD_DEFAULT);



		if (!empty($email && $password)) {
			$select = "SELECT `id`, `name`, `email`, `passsword` FROM `userinformation` WHERE `email`='".$email."' AND `passsword`='".$password."'";
			 //AND `passsword`='".$hashpassword."' LIMIT 1
			$query = mysqli_query($con,$select);
			$userid = mysqli_fetch_assoc($query);
			$_SESSION['userid'] = $userid;
			echo json_encode($userid);

			
		}
	
     
}



?>