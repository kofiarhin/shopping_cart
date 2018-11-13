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


  public function exist() {

    return (!empty($this->data)) ? true : false;
  }


  public function data() {

    return $this->data;
  }

  public function delete($id) {

          $delete = $this->db->delete('products', array('id', '=' , $id));

          if($delete) {

            session::flash("success", "Product Deleted");
            return true;
          }

          return false;
  }


  public function get_products($id = false) {



      if($id) {


            $query = $this->db->get('products', array('id', '=', $id));

            if($query->count()) {


              return($query->first());
            }


      } else {

           $query = $this->db->get('products');

           if($query->count()) {

             return $query->result();
           }
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
