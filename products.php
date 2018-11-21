<?php

      require_once "header.php";

 ?>

 <div class="container">


        <h1 class="title">Products</h1>


        <?php 

        			$products = new Product();

        			$datas = $products->get_products();

        			if($datas) {


        				foreach($datas as $data) {


        						$product_name = $data->product_name;
        						$prouduct_price= $data->product_price;

        					?>

									

        					<?php 
        				}
        			}


         ?>


 </div>
