<?php


  class Order  {


      private $db = null,
              $data = array();


      public function __construct($order = false) {

        $this->db = db::get_instance();


        if(!$order) {

              if(session::exist('user')) {

                  $user_id = session::get('user');

                  $this->data = $this->get_orders($user_id);
              }
        }
      }


      public function exist() {

        return (!empty($this->data)) ? true : false;
      }




      public function data() {

        return $this->data;
      }





      public function get_orders($user_id = false) {

              if(!$user_id) {


                  $orders = $this->db->get('orders');

                  if($orders->count()) {

                    return ($orders->result());
                  }

                } else {

                $orders = $this->db->get('orders', array('user_id', '=', $user_id));

               if($orders->count()) {

                      return ($orders->result());
               }

              }


              return false;

      }





    public function create($field) {

        $create = $this->db->insert('orders', $field);

        if($create) {

          return true;

        }


        return false;

    }




    public function cancel($order_id) {

        $fields = array(

          'status' => 2

        );

        $cancel = $this->db->update('orders', $fields, array('id', '=', $order_id));

        if($cancel) {

          session::flash("success", "Order Cancelled");

          echo "cancelled";

          return true;
        }


        return false;
    }


    public function delete($order_id) {


          $delete = $this->db->delete("orders", array('id', '=', $order_id));

          if($delete) {

            session::flash('succsss', 'item successfully removed');

            return true;
          }

          return false;

    }




  }
