<?php
require_once("db.php");

session_start();
if(!isset($_SESSION['cart'])){
	$_SESSION['cart'] = ['items' => [],'qty' => 0,'shipping' => 50,'subtotal' => 0,'total' => 0];
}

if(isset($_GET['id'])) {
	$selectqry = "SELECT `id`,`name`,`price`,`image` FROM `products` WHERE `id`='".$_GET['id']."'";
 	$query = mysqli_query($con,$selectqry);
 
 		$fetch = mysqli_fetch_assoc($query);
    		// echo json_encode($fetch);
 		if(!empty($_SESSION["cart"]["items"])){
 			$check = array_search($_GET['id'], array_column($_SESSION["cart"]["items"], 'id'));
 			if($check == '0' && $check > 0){
	 			$_SESSION['cart']['qty'] += 1;
				$_SESSION["cart"]['subtotal'] += $fetch['price'];
	 			$_SESSION["cart"]['total'] += $fetch['price'];
	 			$_SESSION['cart']['items'][$check]['item_qty'] += 1;
	 			$_SESSION['cart']['items'][$check]['p_item_total'] += $fetch['price'];
	 		} else {
			    $fetch['item_qty'] = 1;
			    $fetch['p_item_total'] = $fetch['price'];
			 	//$_SESSION["cart"]["items"] = array($fetch);
			 	array_push($_SESSION["cart"]["items"],$fetch);
			 	$_SESSION["cart"]['qty'] += 1;
			 	$_SESSION["cart"]['subtotal'] += $fetch['price'];
			 	$_SESSION["cart"]['total'] += $fetch['price'];
	 		}
 		} else {
			$fetch['item_qty'] = 1;
		    $fetch['p_item_total'] = $fetch['price'];
		 	array_push($_SESSION["cart"]["items"],$fetch);
		 	$_SESSION["cart"]['qty'] += 1;
		 	$_SESSION["cart"]['subtotal'] += $fetch['price'];
		 	$_SESSION["cart"]['total'] += $fetch['price'];
 		}

 		


 	echo "Product Add to Cart Successfull";
 	
}

if(isset($_GET['remove-item'])){
	$_SESSION['cart']['qty'] -= 1;
	$_SESSION["cart"]['subtotal'] -= $_GET['price'];
 	$_SESSION["cart"]['total'] -= $_GET['price'];
	unset($_SESSION['cart']['items'][$_GET['remove-item']]);
}

		if(isset($_GET['add_quantity'])){
			
			$_SESSION['cart']['qty'] += 1;
			$_SESSION["cart"]['subtotal'] += $_GET['price'];
 			$_SESSION["cart"]['total'] += $_GET['price'];
 			$_SESSION['cart']['items'][$_GET['add_quantity']]['item_qty'] += 1;
 			$_SESSION['cart']['items'][$_GET['add_quantity']]['p_item_total'] += $_GET['price'];

		}

		if(isset($_GET['minus_quantity'])){
			$_SESSION['cart']['qty'] -= 1;
			$_SESSION["cart"]['subtotal'] -= $_GET['price'];
 			$_SESSION["cart"]['total'] -= $_GET['price'];
 			$_SESSION['cart']['items'][$_GET['minus_quantity']]['item_qty'] -= 1;
 			$_SESSION['cart']['items'][$_GET['minus_quantity']]['p_item_total'] -= $_GET['price'];

		}
/*
		[
			'cart' => [
				'items' => [
					0:[
						'id' : 1,
						'name' : 'Product name',
						'image' : 'url',
						'price' : 346,
						'item_qty' : 2,
						'p_item_total' : 692
					],
					1:[
						'id' : 24,
						'name' : 'Product name',
						'image' : 'url',
						'price' : 246,
						'item_qty' : 3,
						'p_item_total' : 738
					],
					2:[
						'id' : 21,
						'name' : 'Product name',
						'image' : 'url',
						'price' : 446,
						'item_qty' : 1,
						'p_item_total' : 446
					]
				],
				'subtotal' => 1234,
				'total' => 1234,
				'qty' => 5,
				'shipping' => 50
			]
		]*/

?>

