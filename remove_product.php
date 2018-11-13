<?php

    require_once "core/init.php";

    $product_id = input::get('product_id');

    //echo $product_id;


    if(session::exist('cart')) {


        foreach($_SESSION['cart'] as $key => $item) {

          if($item['product_id'] == $product_id) {

            unset($_SESSION['cart'][$key]);

            session::flash("success", "item successfully removed");
          }
        }


    }


    redirect::to("view_cart.php");
