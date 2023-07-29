<?php
include("db.php");

if(session_status() === PHP_SESSION_NONE) {
    session_start();
    if(empty($_SESSION['userid'])){
      header("location:login.php");
    }
    //session_unset();
    //echo array_search(5, array_column($_SESSION["cart"]["items"], 'id'));
    echo "<pre>";
    print_r($_SESSION['cart']);
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>BUY</title>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style type="text/css">
		@media (min-width: 1025px) {
.h-custom {
height: 100vh !important;
}
}

.card-registration .select-input.form-control[readonly]:not([disabled]) {
font-size: 1rem;
line-height: 2.15;
padding-left: .75em;
padding-right: .75em;
}

.card-registration .select-arrow {
top: 13px;
}

.bg-grey {
background-color: #eae8e8;
}

@media (min-width: 992px) {
.card-registration-2 .bg-grey {
border-top-right-radius: 16px;
border-bottom-right-radius: 16px;
}
}

@media (max-width: 991px) {
.card-registration-2 .bg-grey {
border-bottom-left-radius: 16px;
border-bottom-right-radius: 16px;
}
}
	</style>
</head>
<body>
	<section class="h-100 h-custom" style="background-color: #d2c9ff;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <?php if(isset($_SESSION['cart']) && $_SESSION['cart']['qty'] > 0){
            ?>

          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-lg-8">
                <div class="p-5">
                  <div class="d-flex justify-content-between align-items-center mb-5">
                    <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                    <h6 class="mb-0 text-muted"><?php echo $_SESSION['cart']['qty']; ?> items</h6>
                    <a href="#"  class="btn btn-dark" onClick="sessionunset()">CELEAR</a>
                  </div>
                  <hr class="my-4">
                  <?php
                      foreach($_SESSION['cart']['items'] as $key => $value){ ?>
                  <div class="row mb-4 d-flex justify-content-between align-items-center">
                    <div class="col-md-2 col-lg-2 col-xl-2">
                      <img
                        src="<?php echo $value['image']; ?>"
                        class="img-fluid rounded-3" alt="Cotton T-shirt">
                    </div>
                    <div class="col-md-3 col-lg-3 col-xl-3">
                      
                              <h6 class="text-muted"><?php echo $value['name']; ?></h6>

                    </div>
                    <div class="col-md-1 col-lg-1 col-xl-2 d-flex">
                      <button class="btn btn-link px-2"
                        onclick="minusquantity(<?php echo $key.','.$value['price']; ?>)">
                        <i class="fas fa-minus"></i>
                      </button>


                      <input style="width: calc(3.8125rem + 2px);" id="form1" min="1" name="quantity" value="<?php echo $value['item_qty']; ?>" type="number"
                        class="form-control-sm" />

                      <button class="btn btn-link px-2"
                        onclick="addquantity(<?php echo $key.','.$value['price']; ?>)">
                        <i class="fas fa-plus"></i>
                      </button>
                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                      <h6 class="mb-0">BDT : <?php echo $value['p_item_total']; ?></h6>
                    </div>
                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                      <a href="#" onclick="removeItem(<?php echo $key.','.($value['price']*$value['item_qty']); ?>)" class="text-muted"><i class="fas fa-trash"></i></a>
                    </div>
                  </div>
                  <?php  }
                      ?>

                  <div class="pt-5">
                    <h6 class="mb-0"><a href="#!" class="text-body"><i
                          class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 bg-grey">
                <div class="p-5">
                  <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                  <hr class="my-4">

                  <div class="d-flex justify-content-between mb-4">
                    <h5 class="text-uppercase">items <?php echo $_SESSION['cart']['qty']; ?></h5>
                    <h5>TK: <?php echo $_SESSION['cart']['subtotal']; ?></h5>
                  </div>

                  <h5 class="text-uppercase mb-3">Shipping</h5>

                  <div class="mb-4 pb-2">
                    <h6 class="text-uppercase mb-3">Standard-Delivery- TK: <?php echo $_SESSION['cart']['shipping']; ?></h6>
                  </div>

                  <h5 class="text-uppercase mb-3">Give code</h5>

                  <div class="mb-5">
                    <div class="form-outline">
                      <input type="text" id="form3Examplea2" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Examplea2">Enter your code</label>
                    </div>
                  </div>

                  <hr class="my-4">

                  <div class="d-flex justify-content-between mb-5">
                    <h5 class="text-uppercase">Total price</h5>
                    <h5>TK: <?php echo ($_SESSION['cart']['total'] + $_SESSION['cart']['shipping']); ?></h5>
                  </div>

                  <button type="button" id="checkoutpay" class="btn btn-dark btn-block btn-lg"
                    data-mdb-ripple-color="dark">CHECKOUT</button>

                </div>
              </div>
            </div>
          </div>
          <?php } else {
            ?>
            <h3 class="text-center p-4">No Data In Cart</h3>
            <?php
          } ?>
        </div>
      </div>
    </div>
  </div>
</section>

<script
  src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

  function removeItem(key,price){
      $.ajax({
        type:"get",
        url: "add-to-cart.php?remove-item="+key+"&price="+price,
        success: function(response){
          console.log(response);
          window.location.reload();
        }
      })
  }

      function addquantity(key,price){
        //this.parentNode.querySelector('input[type=number]').stepDown();
        //this.parentNode.querySelector('input[type=number]').stepUp();
       $.ajax({
        type:"get",
        url: "add-to-cart.php?add_quantity="+key+"&price="+price,
        success: function(response){
          console.log(response);
          window.location.reload();
        }
      })
  };
        function minusquantity(key,price){
       $.ajax({
        type:"get",
        url: "add-to-cart.php?minus_quantity="+key+"&price="+price,
        success: function(response){
          console.log(response);
          window.location.reload();
        }
      })
  };
  function sessionunset(){
    <?php //session_unset(); ?>
    window.location.reload();
  }

  $("#checkoutpay").on('click',function(event){
      event.preventDefault();
      // alert("ghgfh");
      var payamount = {
        'amount': <?php echo $_SESSION['cart']['total']+$_SESSION['cart']['shipping']; ?>,
        'cus_name': 'Modu',
        'cus_email' : 'custo@gmail.com',
        'cus_mobile' : '01568033214',
      };

      $.ajax({
        type:"post",
        url: "SSLCommerz/checkout_ajax.php",
        data: payamount,
        beforeSend: function(xhr){xhr.setRequestHeader('Access-Control-Allow-Headers', '*');},
        success: function(response){
          let res = JSON.parse(response);
          window.location.href = res.data
        }
      })
  })
  
     


</script>
</body>
</html>