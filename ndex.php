<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <div class="row my-3">
        <div class="col-md-6">
           <form id="create-product" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Product</label>
                <input type="text" class="form-control" name="prname" id="productname" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Price</label>
                <input type="text" class="form-control" name="price" id="price">
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Image</label>
               
                <input type="file" class="form-control" onchange="encodeImageFileAsURL(this)" id="file" name="file" />
              </div>
              <input type="submit" name="submit" class="btn btn-primary submitBtn" value="SUBMIT"/>
            </form>
            <img src="" id="image" width="150px" name="image" />
        </div> 
       
      </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script
  src="https://code.jquery.com/jquery-3.7.0.min.js"
  integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
  crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        function createProduct(){

        }

        function encodeImageFileAsURL(element) {
          var file = element.files[0];
          var reader = new FileReader();
                reader.onloadend = function() {
                   $("#image").attr("src", reader.result);
                }
                reader.readAsDataURL(file);
          }

        $("#create-product").on('submit', function(e){
            e.preventDefault();

            var filedata = new FormData();
           
           filedata.append('productname',$('#productname').val());
           filedata.append('price',$('#price').val());
            filedata.append('image',$('#image').attr('src'));
     
           $.ajax({
                    method: 'post',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: filedata,
                    enctype: 'multipart/form-data',
                    url: 'insertproduct.php',
                    success: function (response) {
                    //console.log(JSON.parse(response)); 
                      Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: response,
                            showConfirmButton: false,
                            timer: 1400
                          })
                      }

                    })

      })

    </script>

  </body>
</html>