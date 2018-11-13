<?php


    require_once "core/init.php";


    $order_id = input::get('order_id');

    if(!$order_id) {

      session::flash("error", "there was a problem cancelling order check with admin");
      redirect::to('orders.php');
    }


    $order = new Order;

    $cancel = $order->cancel($order_id);

    if($cancel) {

      redirect::to('index.php');
    }
