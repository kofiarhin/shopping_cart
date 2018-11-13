<div class="container">


    <div class="row">

      <div class="col-md-8 offset-md-2">

        <?php

          if(session::exist('success')) {

            ?>

        <p class="alert alert-success text-center"><?php echo session::flash("success"); ?></p>


            <?php
          }


          //check if there are session errors

          if(session::exist('error')) {


            ?>
    <p class="alert alert-danger text-center"><?php echo session::flash('error') ?></p>

            <?php
          }

         ?>
      </div>


    </div>


</div>
