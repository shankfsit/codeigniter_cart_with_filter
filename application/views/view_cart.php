<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Shop Homepage - Start Bootstrap Template</title>

<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="<?php echo base_url(); ?>assets/css/shop-homepage.css" rel="stylesheet">
  <style type="text/css">
    #butAdd{
      background-color: #f16543;
      border-color: #f16543;
      color:white;
    }
  </style>
<script type="text/javascript">
  $(document).ready(function(){
      $('input[type="radio"]').click(function(){  
          /* var gender = $("input[name='radGender']:checked").val();  
           //alert(gender);
           $.ajax({  
                url: '<?php echo base_url()?>shopping/view_gender',
                method:"POST",  
                data:{gender:gender},  
                success:function(data){  
                     $('#demo').html(data);  
                     //alert(data);
                }  
           });  */

           /*var favorite = [];
            $.each($("input[name='cate']:checked"), function(){            
                favorite.push($(this).val());
            });
            alert("My favourite sports are: " + favorite.join(","));
              var cate = favorite.join(",");
              var gender = $("input[name='radGender']:checked").val();  

             $.ajax({  
                url: '<?php echo base_url()?>shopping/view_gender',
                method:"POST",  
                data:{gender:gender,cate:cate},  
                success:function(data){  
                     $('#demo').html(data);  
                     //alert(data);
                }  
           });  */

           getCate();

  });
      });
</script>
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">My Shop</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"></a>
          </li>
          <li>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">
    <div id="cart" >
            <div id = "heading">
                <h2 align="center">Products on Your Shopping Cart</h2>
            </div>
            
                <div id="text"> 
            <?php  $cart_check = $this->cart->contents();
            
            // If cart is empty, this will show below message.
             if(empty($cart_check)) 
             {
                echo 'To add products to your shopping cart click on "Add to Cart" Button <br>';
              ?>
              <button><a href="<?php echo base_url()?>shopping">Add Products</a></button>
              <?php
             }  ?>
             
              </div>
            <br>
                <table id="table" width="100%" border="1" cellpadding="5px" cellspacing="1px">
                  <?php
                  // All values of cart store in "$cart". 
                  if ($cart = $this->cart->contents()): ?>
                    <tr id= "main_heading">
                        <td>Serial</td>
                        <td>Name</td>
                        <td>Price</td>
                        <td>Qty</td>
                        <td>Amount</td>
                        <td>Cancel Product</td>
                    </tr>
                    <?php
                     // Create form and send all values in "shopping/update_cart" function.
                    echo form_open('shopping/update_cart');
                    $grand_total = 0;
                    $i = 1;

                    foreach ($cart as $item):
                        //   echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                        //  Will produce the following output.
                        // <input type="hidden" name="cart[1][id]" value="1" />
                        
                        echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                        echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                        echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                        echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                        echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                        ?>
                        <tr>
                            <td>
                       <?php echo $i++; ?>
                            </td>
                            <td>
                      <?php echo $item['name']; ?>
                            </td>
                            <td>
                                $ <?php echo number_format($item['price'], 2); ?>
                            </td>
                            <td>
                            <?php echo form_input('cart[' . $item['id'] . '][qty]', $item['qty'], 'maxlength="3" size="1" style="text-align: right"'); ?>
                            </td>
                        <?php $grand_total = $grand_total + $item['subtotal']; ?>
                            <td>
                                $ <?php echo number_format($item['subtotal'], 2) ?>
                            </td>
                            <td>
                              
                            <?php 
                            // cancle image.
                            $path = "<img src='http://localhost/cart/images/cart_cross.jpg' width='25px' height='20px'>";
                            echo anchor('shopping/remove/' . $item['rowid'], $path); ?>
                            </td>
                     <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td><b>Order Total: $<?php 
                        
                        //Grand Total.
                        echo number_format($grand_total, 2); ?></b></td>
                        
                        <?php // "clear cart" button call javascript confirmation message ?>
                        <td colspan="5" align="right"><!--input type="button" class ='fg-button teal' value="Clear Cart" onclick="clear_cart()">-->
                            <button><a href="<?php echo base_url()?>shopping">Add More Products</a></button>
                            <?php //submit button. ?>
                            <input type="submit" class ='fg-button teal' value="Update Cart">
                            <?php echo form_close(); ?>
                            
                            <!-- "Place order button" on click send "billing" controller  -->
                            <!--<input type="button" class ='fg-button teal' value="Place Order" onclick="window.location = 'shopping/billing_view'"--></td>
                    </tr>
<?php endif; ?>
            </table>
            <br>

        </div>


    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>


<script type="text/javascript">
   function onchangePrice()
   {
      //alert("Price");
     
      //alert(minPrice + ' ' + maxPrice);
      getCate();

   }

    function getCate()
    {
            var favorite = [];
            $.each($("input[name='cate']:checked"), function(){            
                favorite.push($(this).val());
            });
            //alert("My favourite sports are: " + favorite.join(","));
              var cate = favorite.join(",");
              var gender = $("input[name='radGender']:checked").val(); 

              var minPrice = $('#minPrice').val();
              var maxPrice = $('#maxPrice').val(); 

             $.ajax({  
                url: '<?php echo base_url()?>shopping/view_gender',
                method:"POST",  
                data:{gender:gender,cate:cate,minPrice:minPrice,maxPrice:maxPrice},  
                success:function(data){  
                     $('#demo').html(data);  
                     //alert(data);
                }  
           });  

     } 



  function addtocart(id,name,price)
{
           //alert(name);

           $.ajax({  
                url: '<?php echo base_url()?>shopping/add', //viewCart
                method:"POST",  
                data:{id:id,name:name,price:price},  
                success:function(data)
                {  
                     //$('#text').html(data);  
                     //alert(data);
                     //location.reload();
                     //alert('hi');
                        $.ajax({  
                          url: '<?php echo base_url()?>shopping/viewCart', //viewCart
                          method:"POST",  
                          data:{id:id,name:name,price:price},  
                          success:function(data){ 
                              $('#cart').html(data);
                          }  
                        });  

                }  
           });  

  }
     
</script>

  <!-- Bootstrap core JavaScript -->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
