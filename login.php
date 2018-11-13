<?php

require_once "header.php";


?>


<div class="container">

  <h1 class="title text-center">Login!</h1>

  <div class="row">

    <div class="col-md-5 offset-md-4">

      <?php


      if(input::exist('post', 'login_submit')) {


        $validation = new Validation;

        $fields = array(

          'username' => array(

            'required' => true

          ),


          'password' => array(

            'required' => true


          )


        );


        $check = $validation->check($_POST, $fields);

        if($check->passed()) {


              $user = new User;

              $username = input::get('username');
              $password = input::get('password');

              $login = $user->login($username, $password);

              if($login) {

                redirect::to('route.php');
              } else {

                ?>

    <p class="alert alert-danger">Invalid Username/Password Combination</p>

                <?php
              }



        } else {


          foreach($check->errors() as $error) {

            ?>

      <p class="alert alert-danger"><?php echo $error; ?></p>

            <?php
          }
        }

      }


      ?>


      <form action="" method="post">


        <div class="form-group">

          <label for="username"><strong>Username</strong></label>
          <input type="text" class="form-control" name="username" placeholder="Enter Username" value="<?php echo input::get('username'); ?>">
        </div>

        .<div class="form-group">
          <label for="password">Password</label>
          <input type="text" class="form-control"  placeholder="Enter Password" name="password" value="<?php echo input::get('password'); ?>">
        </div>

        <div class="form-group">

          <button class="btn btn-primary btn-block" type="submit" name="login_submit">Login</button>

        </div>


      </form> <!-- end Form -->



    </div>


  </div>


</div>
