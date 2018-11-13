<?php


      require_once "core/init.php";


      $user = new User;

      if($user->logged_in()) {

            $username = $user->data()->username;

            if($username == "admin") {

              redirect::to('admin_dashboard.php');
            } else {

              redirect::to('index.php');
            }
      }


 ?>
