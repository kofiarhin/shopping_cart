<?php


  class User {


      private $db = null,
              $session_cart = null,
              $logged_in = false,
              $data = array();


      public function __construct($user = false) {

        $this->db = db::get_instance();

        $this->session_name = config::get('session/session_name');

        $this->session_cart = config::get('session/cart_name');

        if(session::exist($this->session_name)) {

           $user = session::get($this->session_name);

           if($this->find($user)) {

             $this->logged_in = true;
           }

           //echo $user;
        }
      }


      public function logged_in() {

        return $this->logged_in;
      }

      public function logout() {


        if(session::exist($this->session_cart)) {

            session::delete($this->session_cart);
        }


          if(session::exist($this->session_name)) {

            session::delete($this->session_name);

            return true;
          }

          return false;
      }


      public function login($username, $password) {

          $user = $this->find($username);

          if($user) {

            if($this->data()->password == hash::make($password, $this->data()->salt)) {


              session::put($this->session_name, $this->data()->id);

              return true;



            }


          }


          return false;

      }


      public function data() {

        return $this->data;
      }

      public function exist() {

        return  (!empty($this->data)) ? true : false;
      }


      public function find($user) {

        $field = (is_numeric($user)) ? 'id' : 'username';

        $user = $this->db->get('users', array($field, '=', $user));

        if($user->count()){

              $this->data  = $user->first();

              return true;
        }

        return false;

      }

      public function create($fields) {

          $account = $this->db->insert('users', $fields);

          if($account) {

              session::flash('success', "Your account ".input::get("username")." was successfully created");

              return true;

          }

          return false;
      }


  }
