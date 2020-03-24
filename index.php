<?php 
	include "library/session.php";
	include "includes/header.php";
	include "library/database.php"; 
	 
	Session::init();
	$msg = Session::get('msg');

	if ( !empty($msg) ){
		echo "<div class='alert alert-success'>" . $msg . "</div>";
		Session::unset();
	}
?>

	<section class="page-header">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<h3>View All Employe List</h3>
				</div>

				<div class="col-md-6">
					<a href="add-employe.php" class="btn btn-primary">Add New Employe</a>
				</div>
			</div>
		</div>
	</section>
	

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- View All Employe Details -->
				<table class="table table-striped">
				  <thead class="thead-dark">
				    <tr>
				      <th scope="col">Serial</th>
				      <th scope="col">Full Name</th>
				      <th scope="col">Email Address</th>
				      <th scope="col">Phone Number</th>
				      <th scope="col">Action</th>
				    </tr>
				  </thead>

				  <tbody>


		  	<?php

		  		$db 	= new DATABASE();
		  		$table 	= "employe_data";
		  		$order_by = array('order_by' => 'em_id ASC');
		  		/*
		  		$selectCondition = array('select' => 'column_name');
		  		
		  		$whereCondition = array(
		  			'where' => array( 
		  				'em_id' => '1', 
		  				'name' => 'Mahfuzur Rahman', 
						'email'=> 'mahfuzur@gmail',
		  				),
		  				'return_type'	=> 'single'
		  		);
		  		$limit = array(
		  			'start' => '3', 
		  			'limit' => '3'
		  		);		  		
		  		
		  		*/
		  		
		  		$employeData = $data = $db->select($table, $order_by);

		  		if (!empty($employeData)){

		  			$i = 0;
		  			foreach ($employeData as $data) { 
		  				$i++;
		  			?>
		  			
	  				<tr>
				      <th scope="row"><?php echo $i; ?></th>
				      <td><?php echo $data['name']; ?></td>
				      <td><?php echo $data['email']; ?></td>
				      <td><?php echo $data['phone']; ?></td>
				      <td>
				      	<div class="btn btn-group">
				      		<a href="edit-employe.php?em_id=<?php echo $data['em_id']; ?>" class="btn btn-default">Update</a>
				      		<a href="library/adding_employe_features.php?action=delete&em_id=<?php echo $data['em_id']; ?>" class="btn btn-danger">Delete</a>
				      	</div>
				      </td>
				    </tr>

		  		<?php	} }
		  		else{ ?>

		  			<tr>
				      <td scope="row">No Employe Data Found In Our Database</td>
				     </tr>

		  	<?php	}
		  	?>

				    

				  </tbody>
				</table>
			</div>
		</div>
	</div>


<?php include "includes/footer.php"; ?>