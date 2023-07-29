<?php
include("db.php");
session_start();
    $select = "SELECT * FROM `products`";
	if(isset($_GET['search'])){
		$select = $select." WHERE `name` LIKE '%".$_GET['search']."%'";
	}
    $query = mysqli_query($con,$select);
    if (mysqli_num_rows($query)>0) {
    	$array = array();
    	while($fetch = mysqli_fetch_assoc($query)){
    		//print_r($fetch);
    		array_push($array,$fetch);
    	}	
    }



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>view product</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body>

		<div class="container">

			<!-- navbar -->
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
			  <a class="navbar-brand" href="#">Navbar</a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>

			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav mr-auto">
			      <li class="nav-item active">
			        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="#">Link</a>
			      </li>
			      <li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			          Dropdown
			        </a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			          <a class="dropdown-item" href="#">Action</a>
			          <a class="dropdown-item" href="#">Another action</a>
			          <div class="dropdown-divider"></div>
			          <a class="dropdown-item" href="#">Something else here</a>
			        </div>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="buy.php">
					  CART<span class="badge badge-light"><?php echo isset($_SESSION['cart']) ? $_SESSION['cart']['qty'] : 0; ?></span>
					</a>
			      </li>
			    </ul>
			    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="GET" class="form-inline my-2 my-lg-0">
			      <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
			      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
			    </form>
			  </div>
			</nav>

    <!-- card -->
    	<div class="d-flex row justify-content-start">
    <?php
    		foreach ($array as $value) {

    			
    		
    ?>
    		<div class="col-md-3 my-2">
			<div class="card">
			  <img style="height: 170px;" class="card-img-top" src="<?php echo $value['image'];?>" alt="Card image cap">
			  <div class="card-body">
			    <h5 class="card-title"><?php echo $value['name'];?></h5>
			    <p class="card-text"><?php echo "Price  ".$value['price'];?></p>
			    <button type="button" onclick="addToCart(<?php echo $value['id']; ?>)" class="btn btn-primary">Add to Cart</button>
			  </div>
			</div>
			</div>
		
<?php   
		}

?>

	</div>
</div>


<script
  src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	function addToCart(id){
		// console.log(id)
		$.ajax({
			type: 'GET',
			url: 'add-to-cart.php?id='+id,
			success: function(res){
				Swal.fire({
	                position: 'top-right',
	                icon: 'success',
	                title: res,
	                showConfirmButton: false,
	                timer: 1500
	            })
			}
		})
	}
</script>
</body>
</html>