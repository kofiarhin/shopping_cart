<?php


  class Cart {


      private $db = null,
              $data = array(),
              $session_name;


      public function __construct($cart = false) {


            $this->db = db::get_instance();

            $this->session_name = config::get("session/cart_name");


            if(!$cart) {

                if(session::exist($this->session_name)) {

                      $this->data = $_SESSION[$this->session_name];



                    //test::dump($this->data);
                }

            }


      }



      public function exist() {

        return (!empty($this->data)) ? true : false;
      }


    public function data() {

      return $this->data;
    }



      public function add_to_cart($fields) {


        if(session::exist($this->session_name)) {

          //echo  "session exist";


          $product_id = $fields['product_id'];

          $product_ids = array_column($_SESSION['cart'], 'product_id');

          if(in_array($product_id, $product_ids)) {

            session::flash("error", "item already added");

            return false;
          } else {

            $position = count($_SESSION['cart']);

            $_SESSION['cart'][$position] = $fields;

            session::flash("success", "item successfully added");

            session::test();
          }


        } else {


              $_SESSION['cart'][0] = $fields;

              session::flash('success', "item successfully added");


        }


        return false;
      //session::test();

      }








  }
