<?php

require_once "header.php";

$product = new Product;

$datas  = $product->get_products();

//session::test();


?>


<div class="container">


  <h1 class="title">Products</h1>
  <?php

  if(input::exist('post', 'add_to_cart')) {

    //echo 'add item to cart';
  }

  ?>

  <div class="row">


    <!-- col-md-4 -->

    <?php

    if($datas) {

      foreach($datas as $data) {


        //var_dump($data);
        $product_name = $data->product_name;
        $product_price = $data->product_price;
        $cover_image = $data->cover_image;


        $file_path = "uploads/".$cover_image;

        if(!file_exists($file_path)) {


          $cover_image = "default-item.png";
        }


        ?>
        <div class="col-md-8 offset-md-2">

          <div class="item-unit">

            <div class="item-image" style="background-image: url(uploads/<?php echo $cover_image; ?>);"></div>

            <div class="content">
              <a href="view_product.php?product_id=<?php echo $data->id; ?>" class="item-name"><?php echo $product_name;?></a>
              <p class="text item-price">$<?php echo $data->product_price?></p>
              <p class="text">Stock: <?php echo $data->product_stock; ?></p>


            </div>



          </div>

        </div>  <!-- end col-md-8-->


        <?php
      }
    } else {


      ?>

            <a href="create_product.php" class="alert alert-info text-center">Post Some products</a>

      <?php
    }

    ?>




  </div>





</div>






</body>
</html>
