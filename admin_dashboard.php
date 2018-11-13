<?php

require_once "header.php";

if(!$user->logged_in()) {

  redirect::to("login.php");
}


$username = $user->data()->username;

if($username != "admin") {

    session::flash("error", "Unauthorized Access");

    session::delete('user');
}

?>


<div class="container">

  <div class="row">


    <div class="col-md-4">

      <div class="option-unit">


        <i class="fa fa-user"></i>

        <p class="text"><a href="customers.php">Customers</a></p>

      </div>
    </div>


    <div class="col-md-4">

      <div class="option-unit">
        <i class="fa fa-first-order" aria-hidden="true"></i>
        <p class="text"><a href="admin_view_orders.php">Orders</a></p>

      </div>
    </div>


    <div class="col-md-4">

      <div class="option-unit">
        <i class="fa fa-first-order" aria-hidden="true"></i>
        <p class="text"><a href="users.php">Post Product</a></p>

      </div>
    </div>

  </div>




</div>
