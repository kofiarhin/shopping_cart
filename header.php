<?php

require_once "core/init.php";

$user = new User;


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Shopping Cart</title>

  <!-- viewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <!-- font awesome -->

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Bootstrap -->

  <link rel="stylesheet" href="css/bootstrap.min.css">


  <!-- Cusstomt css -->
  <link rel="stylesheet" href="css/styles.css">

  <!-- jquery -->
  <script src="js/jquery.js"></script>

  <!-- custom js -->
  <script src="js/main.js"></script>
</head>
<body>


  <header class="main-header">

    <div class="container">

      <h1 class="logo"><a href="index.php">Logo</a></h1>

      <nav>
        <?php

        if($user->logged_in()) {

          ?>
          <a href="profile.php" class="text-capitalize"><?php echo $user->data()->username; ?></a>


          <?php if($user->data()->username == 'admin'){

            ?>

            <a href="admin_dashboard.php">Dashboard</a>
            <a href="create_product.php">Create</a>

            <?php
          } ?>

          <?php if($user->data()->username != 'admin'){

            ?>

            <a href="view_cart.php">Cart</a>

            <?php

            //show the check the orders table

            if($user->data()->username != 'admin') {

              ?>

              <a href="view_orders.php">Orders</a>
              <?php
            }

            ?>

            <?php

          } ?>
          <a href="logout.php">Logout</a>


          <?php
        } else {


          ?>

          <a href="Login.php">Login</a>
          <a href="register.php">Register</a>
          <input type="text" id="search" placeholder="search">



          <?php
        }


        ?>
      </nav>


    </div>

  </header>


  <div class="container">

    <?php


    require_once "session_messages.php";

    ?>


  </div>
