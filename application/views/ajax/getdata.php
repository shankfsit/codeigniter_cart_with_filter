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
                        //echo form_open('shopping/add');
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