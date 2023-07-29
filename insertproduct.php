<?php
include("db.php");
 $productname 	= 	$_POST['productname'];
 $price 		= 	$_POST['price'];
 $image  		=	$_POST['image'];
 
 	$cnvrtimage = explode("base64,",$image)[0];
 	//echo json_encode($cnvrtimage);
 	$jpeg = substr($cnvrtimage, 0,-1);
 		//echo json_encode($jpeg);
 	$ext = explode("/",$jpeg);
 		//echo json_encode($ext[1]);
 	$readypath = "putimage/".time().".".$ext[1];
 	$baseclr = file_put_contents($readypath,base64_decode(explode("base64,",$image)[1]));

 	$insert = "INSERT INTO `products`(`name`, `price`, `image`) VALUES ('".$productname."','".$price."','".$readypath."')";

 		$query = mysqli_query($con,$insert);
 		if ($query) {
 			echo "Product Uploaded";
 		}



?>