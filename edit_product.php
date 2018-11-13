<?php


require_once "header.php";


if(!$user->logged_in()) {

  redirect::to('login.php');
}


$product_id = input::get("product_id");


$product = new Product($product_id);


if(!$product->exist()) {

  session::flash("error", "Product Does not exist");


  redirect::to('index.php');

}


//var_dump($product->data());


$product_name = $product->data()->product_name;
$product_price = $product->data()->product_price;
$product_description = $product->data()->product_description;
$product_stock = $product->data()->product_stock;

?>

<div class="container">

  <h1 class="title">Edit Product</h1>

  <div class="row">


    <div class="col-md-6 offset-md-3">

      <?php

      if(input::exist('post', 'save_submit')) {


        $validation = new Validation;

        $fields = array(

          'product_name' => array(

            'required' => true,
            'min' => 2

          ),

          'product_price'  => array(

            'required' => true

          ),

          'product_description' => array(

            'required' => true

          )


        );


        //var_dump($fields);


        $check = $validation->check($_POST, $fields);


        if($check->passed()) {

          $fields = array(

              'product_name' => input::get('product_name'),
              'product_price' => (int) input::get('product_price'),
              'product_description' => input::get("product_description"),
              'product_stock' =>  (int) input::get('product_stock')

          );

          $update = $product->update($product_id, $fields);

          if($update) {


            redirect::to("view_product.php?product_id=".$product_id);
          }


        } else {


          foreach($check->errors() as $error) {

            ?>

      <p class="alert alert-danger"><?php echo $error; ?></p>
            <?php
          }
        }




      }

      ?>

      <form action="" method="post">

        <div class="form-group">

          <label for="product_name">Product Name</label>

          <input type="text" name="product_name" value="<?php echo $product_name; ?>" class="form-control">

        </div>


        <div class="form-group">

          <label for="price">Price</label>
          <input type="text"  name="product_price" class="form-control" value="<?php echo $product_price; ?>">

        </div>


        <div class="form-group">

          <label for="product_description">Description</label>

          <textarea name="product_description" id="" cols="30" rows="8" class="form-control"><?php echo $product_description; ?></textarea>

        </div>

        <div class="form-group">

          <label for="product_stock">Stock</label>
          <input type="text" name="product_stock" class="form-control" value=<?php echo $product_stock; ?>>

        </div>

        <button class="btn btn-primary" type="submit" name="save_submit">Save Changes</button>

      </form>

    </div>


  </div>


</div>
