<?php

    require_once "core/init.php";



    $order_id = input::get('order_id');

    $order =new Order;

    $delete = $order->delete($order_id);

    if($delete) {

      redirect::to('view_orders.php');
    }



 ?>
