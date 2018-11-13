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


                  $sql = "select
                          concat(users.first_name, ' ', users.last_name) as full_name,
                          orders.id as order_id,
                          orders.quantity as order_quantity,
                          orders.status,
                          products.product_name,
                          products.product_price,
                          products.cover_image


                   from orders

                    inner join users

                    on orders.user_id = users.id

                    inner join products

                    on orders.product_id = products.id

                    where orders.status = ?

                   ";


                   $fields = array(

                      'status' => 0

                   );


                  $query = $this->db->query($sql, $fields);



                  if($query->count()) {

                    return ($query->result());
                  }

                } else {

                $orders = $this->db->get('orders', array('user_id', '=', $user_id));

               if($orders->count()) {

                      return ($orders->result());
               }

              }


              return false;

      }



    public function delivered($order_id) {

            $fields = array(

              'status' => 1

            );
          $update  = $this->db->update('orders', $fields, array('id', '=', $order_id));

        if($update) {

          echo "updated";
        }
    }

    public function create($field) {

    var_dump($field);

      $product_id = $field['product_id'];



      //update the stock with the  quantiy

      $product = new Product($product_id);

      if($product->exist()) {

        $old_stock = $product->data()->product_stock;


        $new_stock  = $old_stock - $field['quantity'];

        //update the stock

        $update_field = array(

          'product_stock' => $new_stock

        );

        $update = $this->db->update('products', $update_field, array('id', '=', $product_id));

        if($update) {

          echo "updated";

        }

      }

        $create = $this->db->insert('orders', $field);

        if($create) {

          return true;

        }


        return false;

    }




    public function cancel($order_id) {


        //update the stock with old quantity

        $sql = "select *

        from orders

        inner join products
        on orders.product_id = products.id
        where orders.id = ?";


        $fields = array(

            'id' => $order_id

        );


        $query = $this->db->query($sql, $fields);

        if($query->count()) {

          $product_id = $query->first()->product_id;
          $current_stock = $query->first()->product_stock;

          $order_quantity = $query->first()->quantity;

          $new_stock_level = $current_stock + $order_quantity;


          //update the products table


          $fields = array(

            'product_stock' => $new_stock_level

          );

          var_dump($fields);


          $update =$this->db->update('products', $fields, array('id',  '=',  $product_id));

          if($update) {

            echo "updated";
          }


          //$update = $this->db->update('products', $fields, array('id', '=', $product_id ));




        }



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
