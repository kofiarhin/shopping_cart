<?php

require_once "header.php";


if($user->data()->username != 'admin' or !$user->logged_in()) {


  redirect::to("login.php");

}

?>


<div class="container">

  <h1 class="title text-center">Post Product</h1>

  <div class="row">

    <div class="col-md-6 offset-md-3">


      <?php

          if(input::exist("post", 'product_submit')) {

              $validation = new Validation();

              $fields = array(

                  'product_name' => array(

                    'required' => true,
                    'min'  => 2

                  ),

                  'product_price' => array(

                      'required' => true

                  ),

                  'product_description' => array(

                    'required' => true,
                    'min' => 20

                  ),

                  'product_stock' => array(

                      'required' => true

                  )

              );


              $check = $validation->check($_POST, $fields);

              if($check->passed()) {

                  $file = input::get('file');

                  $file_name  = $file['name'];

                  if(!$file_name) {

                    ?>

            <p class="alert alert-danger">Cover image cannot be empty</p>

                    <?php
                  }

                  $cover_image = file::upload($file);

                  $product_fields = array(

                      'product_name' => input::get('product_name'),
                      'product_price' => (int) input::get('product_price'),
                      'product_description' => input::get('product_description'),
                      'cover_image' => $cover_image,
                      'product_stock' => (int) input::get('product_stock'),
                      'created_on' => date::timestamp()


                  );


                  $product = new Product();



                  $create = $product->create($product_fields);

                  if($create) {

                    redirect::to('index.php');
                  }



                  //upload file







              } else {

                foreach($check->errors() as $error) {

                  ?>
      <p class="alert alert-danger"><?php echo $error; ?></p>

                  <?php
                }
              }

          }


       ?>

      <form action="" method="post" enctype='multipart/form-data'>

        <div class="form-group">


          <label for="product_name"><strong>Product Name</strong></label>
          <input type="text" class="form-control" name="product_name" placeholder="Enter Product Name" value="<?php echo input::get("product_name") ?>">

        </div>


          <div class="form-group">


          <label for="product_price"><strong>Price</strong></label>
          <input type="number" class="form-control" name="product_price" placeholder="Enter Price" value="<?php echo input::get("product_price") ?>" >

        </div>


          <div class="form-group">


          <label for="product_stock"><strong>Stock</strong></label>
          <input type="text" class="form-control" name="product_stock" placeholder="Enter Stock" value="<?php echo input::get("product_stock") ?>">

        </div>


        <div class="form-group">

            <label for="product_description">Description</label>
            <textarea name="product_description" id="" cols="30" rows="10" class="form-control"><?php echo input::get('product_description'); ?></textarea>

        </div>


          <div class="form-group">


          <label for="product_name"><strong>Cover Image</strong></label>
          <input type="file" class="form-control" name="file" placeholder="Enter Product Name">

        </div>


        <button class="btn btn-primary" type="submit" name="product_submit">Post Product</button>


      </form>
    </div>
  </div>


</div>
