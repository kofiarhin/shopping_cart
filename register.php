<?php

require_once "header.php";

?>


<div class="container">


  <h1 class="title text-center">Create An Account</h1>

  <div class="row">

    <div class="col-md-8 offset-md-2">

      <?php

      if(input::exist('post', 'create_submit')) {


        $validation = new Validation;


        $fields = array(

          'first_name' => array(

            'required' => true,
            'min' => 2,
            'max' => 50


          ),

          'last_name' => array(

            'required' => true,
            'min' => 2,
            'max' => 50

          ),

          'username' => array(

          'required' => true,
          'min' => 2,
          'unique' => 'users'

        ),


        'password' => array(

        'required' => true,
        'min' => 2,
        'max' => 50


        )


        );


        $check = $validation->check($_POST, $fields);

        if($check->passed()) {

              $salt = hash::salt(32);
              $password = hash::make(input::get('password'), $salt);


              $fields = array(

                'first_name' => input::get('first_name'),
                'last_name' => input::get("last_name"),
                'username' => input::get('username'),
                'password' => $password,
                'salt' => $salt,
                'created_on' => (new DateTime)->getTimestamp()


              );

              $user = new User;

              $account = $user->create($fields);


              if($account) {

                redirect::to("login.php");
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

      <form  action="" method="post">

        <div class="form-group">

          <label for="first_name"><strong>First Name</strong></label>

          <input type="text" class="form-control" name="first_name" value="<?php echo input::get('first_name') ?>" placeholder="Enter First Name">

        </div>



        <div class="form-group">

          <label for="last_name"><strong>Last Name</strong></label>
          <input type="text" class="form-control" name="last_name" value="<?php echo input::get('last_name'); ?>" placeholder="Enter Last Name">


        </div>




        <div class="form-group">

          <label for="username"><strong>Username</strong></label>

          <input type="text" class="form-control" name="username" value="<?php echo input::get('username'); ?>" placeholder="Enter Username">

        </div>



        <div class="form-group">

          <label for="password"><strong>Password</strong></label>

          <input type="text" class="form-control" name="password" value="<?php echo input::get('password'); ?>" placeholder="Enter Password">

        </div>


        <button class="btn btn-primary btn-block" type="submit" name="create_submit">Create Account</button>

      </form>

    </div>


  </div>


</div>
