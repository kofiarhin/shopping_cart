<?php

require_once "header.php";


?>


<div class="container">

  <h1 class="title">Cart Details</h1>


  <?php



  $cart = new Cart;

  //check if session in cart add display data

  if($cart->exist()) {

    ?>

    <?php

    if(input::exist('post', 'place_order')) {


      if(session::exist('cart')) {


        $fields = session::get('cart');

        $order = new Order;

        $order_fields = array();

        foreach($fields as $field) {

          $order_field = array(

            'user_id' => (int) session::get('user'),
            'product_id' => (int) $field['product_id'],
            'quantity' =>  (int) input::get("product_quantity"),
            'status' => 0,
            'created_on' => date::timestamp()

          );


          $order_fields[] = $order_field;

        }


        foreach($order_fields as $order_field) {

              $create = $order->create($order_field);
        }



        session::delete("cart");
        session::flash("success", "Order successfully placed");

        redirect::to('index.php');

        //$create = $order->create($fields);






      }
    }

    ?>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Cover Image</th>
          <th>Product Name</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Cost</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php

        $total = 0;
        foreach($cart->data() as $data) {

          //var_dump($data);
          $product_id = $data['product_id'];


          //calculat the total cost;



          $product_name = $data['product_name'];
          $product_price = $data['product_price'];
          $product_quantity = $data['product_quantity'];

          $product_cost  = $product_price * $product_quantity;

          $total = $total + $product_cost;


          $product =  new Product($product_id);

          if($product->exist()) {

            $cover_image = $product->data()->cover_image;


            $file_path = "uploads/".$cover_image;

            if(!file_exists($file_path)) {

              $cover_image = "default.jpg";

            }


            //echo $cover_image;


          }

          ?>

          <tr>

            <td><div class="cover-image" style="background-image: url(uploads/<?php echo $cover_image; ?>)"></div></td>
            <td class="table-text"><?php echo $product_name; ?></td>
            <td class='table-text'><?php echo $product_price; ?></td>
            <td class="table-text"><?php echo $product_quantity; ?></td>
            <td class="table-text "><?php echo $product_cost; ?></td>
            <td class="table-text"><a href="remove_product.php?product_id=<?php echo $product_id; ?>">Remove</a></td>
          </tr>

          <?php
        }




        ?>

        <tr>
          <td>Total</td>
          <td></td>
          <td></td>
          <td><?php echo $total; ?></td>
        </tr>
      </tbody>
    </table>

    <?php



    ?>

    <form  action="" method="post">

      <button class="btn btn-primary" type='submit' name="place_order">Place Order</button>
    </form>

    <?php
  } else {


    ?>

          <p class="alert alert-info text-center">Your Basket is Empty</p>


    <?php
  }


  ?>

</div>
