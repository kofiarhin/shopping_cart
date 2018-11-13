<?php


class Product {


  private $db = null,
  $data = array();

  public function __construct($product_id = false) {


    $this->db = db::get_instance();

    if($product_id) {

      $this->data =   $this->get_products($product_id);
    }

  }


  public function update($product_id, $fields) {


        $update = $this->db->update('products', $fields,  array('id', '=',  $product_id));

        if($update) {

          session::flash("success", "Product details successfully updated");

          return true;
        }


        return false;

  }


  public function exist() {

    return (!empty($this->data)) ? true : false;
  }


  public function data() {

    return $this->data;
  }

  public function delete($id) {


        //update the products table to deleted;


        $fields = array(

        'deleted' => 1

      );


            $update = $this->db->update('products', $fields, array('id', '=', $id));

            if($update) {

                  return true;
            }


        /*

          $delete = $this->db->delete('products', array('id', '=' , $id));

          if($delete) {

            session::flash("success", "Product Deleted");
            return true;
          }

          return false;

          */


          return false;
  }


  public function get_products($id = false) {



      if($id) {


            $query = $this->db->get('products', array('id', '=', $id));

            if($query->count()) {


              return($query->first());
            }


      } else {

            $sql ="select * from products where deleted != ?";

            $fields = array(

            'deleted' => 1

          );


          $query = $this->db->query($sql, $fields);

          if($query->count()) {

            return($query->result());
          }

          /*

           $query = $this->db->get('products');

           if($query->count()) {

             return $query->result();
           }

           */
      }

      return false;




  }


  public function create($fields) {


    //var_dump($fields);
    $create = $this->db->insert('products', $fields);

    //var_dump($create);
    if($create) {

      session::flash("success", "product was successfully posted");

      //echo "created";

      return true;
    }

    return false;

  }


}
