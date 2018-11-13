<?php

    require_once "core/init.php";

    $user =new User;

    $logout = $user->logout();


    redirect::to('index.php');
