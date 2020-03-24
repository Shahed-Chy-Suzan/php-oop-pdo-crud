<?php 
	include "library/session.php";
	include "includes/header.php";
	include "library/database.php"; 
?>

<?php
	
	$em_id = $_GET['em_id'];
	$db = new DATABASE();
	$table = "employe_data";
	$whereCondition = array(
		'where' => array( 'em_id' => $em_id ),
		'return_type'	=> 'single'
	);
	$value = $db->select($table, $whereCondition);

	// If Edit Value Found then show the form section
	if ( !empty($value ) ){

?>


	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h3>Update Employe Data</h3>
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-6 offset-md-3">
					<form action="library/adding_employe_features.php" method="POST">
						<!-- Username Field -->
						<div class="form-group">
							<label for="Username">Name</label>
							<input type="text" name="name" class="form-control" required="1" value="<?php echo $value['name']; ?>">
						</div>

						<!-- Email Address Field -->
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" name="email" class="form-control" required="1" value="<?php echo $value['email']; ?>">
						</div>

						<!-- Phone Number Field -->
						<div class="form-group">
							<label for="phone">Phone</label>
							<input type="text" name="phone" class="form-control" required="1" value="<?php echo $value['phone']; ?>">
						</div>

						<!-- Update Employe Button -->
						<div class="form-group">
							<input type="hidden" name="em_id" value="<?php echo $value['em_id']; ?>">
							<input type="hidden" name="action" value="edit">
							<input type="submit" name="updateEmploye" value="Update Employe" class="btn btn-primary">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>


<?php

	}
?>	


<?php include "includes/footer.php"; ?>
