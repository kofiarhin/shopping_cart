<?php

require_once "header.php";

$user = new User;

$product_id = input::get('product_id');

$product = new Product;



$data = $product->get_products($product_id);


if(!$data) {

  session::flash("error", "product does not exist");

  redirect::to('index.php');
}




$product_name = $data->product_name;
$product_price = $data->product_price;
$product_description = $data->product_description;
$product_image = $data->cover_image;
$product_stock = $data->product_stock;


$file_path = "uploads/".$product_image;

if(!file_exists($file_path)) {


  $product_image = "default-item.png";
}
//die();


?>


<div class="container">

  <div class="row">


    <div class="col-md-10 offset-md-1">


      <?php

      if(input::exist("post", 'add_to_cart')) {

        $product = new Product($product_id);

        if($product->exist()) {

          $stock = $product->data()->product_stock;



          $current_order = input::get("product_quantity");


          if($current_order > $stock) {

             ?>


        <p class="alert alert-danger text-center">Oder more than stock available!</p>

             <?php 
          } else {

            $cart = new Cart;

            $fields = array(

              'product_id' => (int) input::get("product_id"),
              'product_name' => input::get("product_name"),
              'product_price' => (int)  input::get('product_price'),
              'product_quantity' => (int) input::get('product_quantity')


            );

        //add fields to cart
            $add = $cart->add_to_cart($fields);

            redirect::to('index.php');
          }



        }
       // die();

        

        //redirect::to('index.php');


      }



      if(input::exist('post', 'delete_submit')) {



        $delete = $product->delete($product_id);

        if($delete) {

          redirect::to('index.php');
        }


      }

      ?>



      <div class="row">

        <div class="col-md-7">

          <div class="main-image" style="background-image: url(uploads/<?php echo $product_image; ?>)">


          </div>
        </div>

        <div class="col-md-5">
          <p class="main-name"><?php echo $product_name; ?></p>

          <p class="main-description">
            <?php echo $product_description; ?>
          </p>

          <form action="" method="post">


            <!-- hidden elements-->

            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <input type="hidden" name="product_name" value="<?php echo $product_name; ?>">
            <input type="hidden" name="product_price" value="<?php echo $product_price; ?>">

            <p class="main-price">US$<?php echo $product_price; ?></p>

            <?php


            if($user->logged_in()) {

              $username = $user->data()->username;

              if($username == 'admin') {

                ?>

                <a href="edit_product.php?product_id=<?php echo $product_id; ?>" class="btn btn-default">Edit Product</a>
                <button class="btn btn-danger" type="submit" name="delete_submit">Delete Item</button>


                <?php

              } else  {

                ?>


                <div class="form-group">

                  <input type="number" name="product_quantity" class="form-control" value=1>
                </div>

                <?php

                if($product_stock == 0) {

                  ?>
                  <button class="btn btn-danger">Out of Stock</button>

                  <?php
                } else {



                  ?>

                  <button class="btn btn-primary" type="submit" name="add_to_cart">Add to Cart</button>


                  <?php

                }

                ?>



                <?php
              }


            } else {



              ?>

              <button class="btn btn-primary disabled btn-lg">Add to Cart</button>

              <?php


            }





            ?>




          </form>
        </div>



      </div>
    </div>


  </div>


</div>
