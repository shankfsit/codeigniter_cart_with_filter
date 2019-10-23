<?php
            //echo "heloo";
            //print_r($below500);
            
            // "$products" send from "shopping" controller,its stores all product which available in database. 
            foreach ($below500 as $product) {
                $id = $product['serial'];
                $name = $product['name'];
                $description = $product['description'];
                $price = $product['price'];
                ?>

                <div id='product_div'>  
                    <div id='image_div'>
                        <img src="<?php echo base_url() . $product['picture'] ?>"/>
                    </div>
                    <div id='info_product'>
                        <div id='name'><?php echo $name; ?></div>
                        
                        <div id='rs'><b>Price</b>:<big style="color:green">
                            $<?php echo $price; ?></big></div>
                        <?php
                        
                        // Create form and send values in 'shopping/add' function.
                        echo form_open('shopping/add');
                        echo form_hidden('id', $id);
                        echo form_hidden('name', $name);
                        echo form_hidden('price', $price);
                        ?> </div> 
                    <div id='add_button'>
                        <?php
                        $btn = array(
                            'class' => 'fg-button teal',
                            'value' => 'Add to Cart',
                            'name' => 'action'
                        );
                        
                        // Submit Button.
                        echo form_submit($btn);
                        echo form_close();
                        ?>
                    </div>
                </div>

<?php } ?>