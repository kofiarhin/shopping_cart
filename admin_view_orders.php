<?php

require_once "header.php";

if(!$user->logged_in()) {

  redirect::to("login.php");

}


$order = new Order;

$orders = $order->get_orders();


//var_dump($orders);

?>


<div class="container">


  <?php

      if(input::exist('post', 'delivered_submit')) {

            $order_id = input::get('order_id');

            $update = $order->delivered($order_id);


            if($update) {

              redirect::to("admin_view_orders.php");
            }
      }


   ?>

  <?php

  if($orders) {



    ?>

    <table class="table table-table-striped">


      <thead>
        <tr>
          <th>Image</th>
          <th>Name</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Action</th>
        </tr>
      </thead>

      <?php


      foreach($orders as $order) {

            //var_dump($order);

            $order_id = $order->order_id;
        ?>

        <tr>

          <td><div class="cover-image" style="background-image: url(uploads/<?php echo $order->cover_image; ?>)"></div></td>
          <td><?php echo $order->product_name; ?></td>
          <td><?php echo $order->product_price; ?></td>
          <td><?php echo $order->order_quantity; ?></td>
          <td>
            <form action="" method="post">

              <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">

              <button class="btn btn-primary" type="submit" name="delivered_submit">Delivered</button>
            </form></td>
          </tr>

          <?php
        }

        ?>



      </table>

      <?php
    } else {

      echo "there are no orders yet!";
    }

    ?>



  </div>
