<?php

      require_once "header.php";

      if(!$user->logged_in()) {

        redirect::to("login.php");
      }

 ?>
