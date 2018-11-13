<?php

      require_once "header.php";

      $order = new Order;



 ?>


 <div class="container">



      <div class="row">

        <div class="col-md-8 offset-md-2">

          <table class="table table-bordered">

            <thead>
              <th>Product Name</th>
              <th>Product Price</th>
              <th>Status</th>
              <th>Action</th>
            </thead>

            <tbody>


              <?php


                    if($order->exist()) {


                      $datas = $order->data();

                      foreach($datas as $data) {



                        $order_id = $data->id;
                        $product_id = $data->product_id;
                        $status = (int) $data->status;

                        $product  = new product($product_id);

                        if($product->exist()) {

                        //var_dump($product->data());

                          $product_name = $product->data()->product_name;

                          $product_price = $product->data()->product_price;
                        }

                        ?>
        <tr>
          <td><strong><?php echo $product_name; ?></strong></td>
          <td><?php echo $product_price; ?></td>
          <td><?php

              //echo $status;

              if($status == 0) {

                echo "Pending";
              } else if($status == 1) {

                echo "delivered";
              } else if($status == 2) {

                echo "Cancelled";
              }

         ?></td>
          <td>

              <?php

                    if($status == 2 || $status == 1) {

                    ?>

                    <a href="remove_order.php?order_id=<?php echo $order_id; ?>">Remove</a>

                    <?php

                    } else {

                      ?>

                      <a href="cancel_order.php?order_id=<?php echo $order_id; ?>">Cancel</a></td>

                      <?php

                    }

               ?>

        </tr>

                        <?php
                      }
                    }


               ?>
            </tbody>
          </table>
        </div>

      </div>

 </div>
