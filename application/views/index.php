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

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="<?php echo base_url()?>shopping">My Shop</a>
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
          <li class="nav-item active dropdown countcart">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              ( <?php echo count($this->cart->contents());?> ) Cart
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">

            <table border="1" width="100%">
                <?php

                  // All values of cart store in "$cart". 
                  if ($cart = $this->cart->contents()): ?>
                <thead>
                  <th>S.No</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Qty</th>
                  <th>Cancel</th>
                </thead>
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
                <tbody>
                  <tr>
                  <td><?php echo $i++; ?></td>
                  <td><?php echo $item['name']; ?></td>
                  <td>
                                $ <?php echo number_format($item['price'], 2); ?>
                            </td>
                            <td>
                            <?php echo $item['qty'] ?>
                            </td>
                        <?php $grand_total = $grand_total + $item['subtotal']; ?>
                            <td>
                                $ <?php echo number_format($item['subtotal'], 2) ?>
                            </td>
                 </tr>
               
                <?php endforeach; ?>
                <tr>
                        <td colspan="5" align="right"><b>Order Total: $<?php 
                        
                        //Grand Total.
                        echo number_format($grand_total, 2); ?></b></td>
                        
                        <?php // "clear cart" button call javascript confirmation message ?>
                        
                    </tr>
                    <tr>
                      <td colspan="5" align="right">
                            <?php //submit button. ?>
                            <button><a href="<?php echo base_url()?>shopping/view_cart" >View Cart</a></button>
                            <?php echo form_close(); ?>
                      </td>
                    </tr>

                     </tbody>

                     <?php endif; ?>
              </table>
              
            </div>
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
    

    <div class="row">

      <div class="col-lg-3">

        <h3 class="my-4">Filter Product By</h3>
        <div class="list-group">
          <h6>Price</h6>
          <a href="#" class="list-group-item"><div data-role="rangeslider">

         <div class="row">

            <div class="col-md-6">
              <h6>Min Price</h6>
      <select name="min_price" id="minPrice" onchange="onchangePrice()">
        <option value="0">0</option>
        <option value="100">100</option>
        <option value="500">500</option>
      </select>
            </div>  
            <div class="col-md-6">
              <h6>Max Price</h6>
      <select name="max_price" id="maxPrice" onchange="onchangePrice()">
        <option value="100">100</option>
        <option value="500">500</option>
        <option value="1000" selected="selected">1000</option>
      </select>
            </div>  
         </div>   

        

      </div></a>
            <h6>Gender</h6>
          <a href="#" class="list-group-item">
           <input type="radio" name="radGender" value="male" id="radGender1"> Male<br>
           <input type="radio" name="radGender" value="female" id="radGender1"> Female 

          </a>
          <h6>Material</h6>
          <a href="#" class="list-group-item">
            <input type="checkbox"  name="cate"  value="cotton" onclick="getCate()"> Cotton<br>
            <input type="checkbox"   name="cate"   value="silk"    onclick="getCate()" > Silk <br>
            <input type="checkbox"  name="cate"  value="synthetics" onclick="getCate()"> Synthetics<br>
            <input type="checkbox"  name="cate"  value="lycra" onclick="getCate()"> Lycra<br>
          </a>
        </div>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        <br/>
        <div id="demo">
        <div class="row">
          <?php 
            foreach($products as $product){
              $id = $product['serial'];
              $name = $product['name'];
              $price = $product['price'];

          ?>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="<?php echo base_url() . $product['picture'] ?>" alt=""></a>
              <div class="card-body">
                <h6 class="card-title">
                  <a href="#"><?php echo $name; ?></a>
                </h6>
                <h6>$<?php echo $price; ?></h6>
                <p class="card-text">

                  <form accept-charset="utf-8">
                  <?php
                        
                        // Create form and send values in 'shopping/add' function.
                       // echo form_open('shopping/add');
                        echo form_hidden('id', $id);
                        echo form_hidden('name', $name);
                        echo form_hidden('price', $price);
                        ?>
                        <div id='add_button'>
                        <?php
                        $btn = array(
                            'class' => 'fg-button teal',
                            'value' => 'Add to Cart',
                            'name' => 'action'
                        );
                        
                        // Submit Button.
                        //echo form_submit($btn);
                        ?>
                        <input type="button" id="butAdd" name="action" class="fg-button teal" value ="Add to Cart" onclick ="return addtocart('<?=$id?>','<?=$name?>','<?=$price?>')">
                        <?php

                        echo form_close();
                        ?>
                    </div>
                </p>
              </div>
              <!--<div class="card-footer">
                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
              </div>-->
            </div>
          </div>
        <?php }?>
        </div>
      </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

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
  $(document).ready(function(){
      $('input[type="radio"]').click(function(){  
           getCate();
  });
      });
</script>
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
           alert("Product has been Added to your Cart");

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
                              //alert("Product has been Added to your Cart");
                          }  
                        }); 

                        $.ajax({  
                          url: '<?php echo base_url()?>shopping/countCart', //viewCart
                          method:"POST",  
                          data:{id:'id'},  
                          success:function(data){ 
                              $('.countcart').html(data);
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
