<?php


  class File {

        public static function upload($file) {

          //var_dump($file);

          $file_name = $file['name'];
          $file_tmp_name = $file['tmp_name'];
          $file_size = $file['size'];
          $file_error = $file['error'];

          $file_ext = explode(".", $file_name);

          $file_act_ext = strtolower(end($file_ext));

          $allowed = array('jpg');

          if($file_act_ext == 'jpg') {

            $file_new_name = md5(uniqid()).".".$file_act_ext;

            $file_destination  = "uploads/".$file_new_name;


            if(move_uploaded_file($file_tmp_name, $file_destination)) {

                return $file_new_name;
            }



          }


          return false;


        }


  }
