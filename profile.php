<?php


require_once "header.php";


if(!$user->logged_in()) {


	redirect::to('login.php');
}


if(!$user->exist()) {

	session::flash("error", "There was a problem fetching user");

	redirect::to('index.php');

}


//var_dump($user->data());


$first_name  = $user->data()->first_name;
$last_name  = $user->data()->last_name;
$username  = $user->data()->username;
$profile_pic = $user->data()->profile_pic;

$file_path = "uploads/".$profile_pic;

	
		if(!file_exists($file_path)) {


			$profile_pic = "default.jpg";

		}


?>

<div class="container">


	<div class="row">

		<div class="col-md-3 offset-md-2 profile-container">

		<?php 


					if(input::exist('post', 'change_submit')) {


						$file = input::get('file');

						//var_dump($file);

						$file_name = $file['name'];


						if(empty($file_name)) {

							echo "you need to select a fil ";
						} else {


							$file_new_name = file::upload($file);


							//updat the users table with new file name;

							$file_update = $user->update_profile($file_new_name, session::get('user'));;						}


							if($file_update) {

								redirect::to("profile.php");
							}
						
					}

		 ?>
			<div class="profile-face" style="background-image: url(uploads/<?php echo $profile_pic; ?>)">

			</div>

			<form action="" method="post" enctype="multipart/form-data">
				<div class="form-group">

					<label for="file">Choose File</label>
					
				</div>

				<div class="form-group">
					
					<input type="file" name="file" class="form-control-file">
					
				</div>

				<button class="btn btn-primary" type="submit" name="change_submit">upload Pic</button>
			</form>

		</div>

		<div class="col-md-5">

			<?php 

			if(input::exist('post', 'save_submit')) {

				$validation = new Validation;


				$fields = array(

					'first_name' => array(

						'required' => true,
						'min' => 2,
						'max' => 50

					),


					'last_name' => array(


						'required' => true,
						'min' => 2,
						'max' => 50
					),

					'username' => array(

						'required' => true

					)

				);


				$check = $validation->check($_POST, $fields);

				if($check->passed()) {

					$user_fields = array(

						'first_name' => input::get("first_name"),
						'last_name' => input::get("last_name"),
						'username' => input::get("username")
					);


					$update = $user->update($user_fields, session::get("user"));

					if($update) {


						redirect::to('profile.php');
					}
				} else {


					foreach($check->errors() as $error) {

						?>


						<p class="alert alert-danger"><?php echo $error;?></p>
						<?php 
					}
				}


			}

			?>

			<form action="" method="post">

				<div class="form-group">
					<label for="first_name"><strong>First Name</strong></label>
					<input type="text" class="form-control" name="first_name" value="<?php echo $first_name; ?>">
				</div>


				<div class="form-group">
					<label for="first_name"><strong>Last Name</strong></label>
					<input type="text" class="form-control" name="last_name" value="<?php echo $last_name; ?>">
				</div>




				<div class="form-group">
					<label for="first_name"><strong>Username</strong></label>
					<input type="text" class="form-control" name="username" value="<?php  echo $username; ?>">
				</div>

				<button class="btn btn-primary" type="submit" name="save_submit" >Save Changes</button>
			</form>
		</div>

	</div>


</div>
