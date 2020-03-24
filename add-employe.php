<?php include "includes/header.php"; ?>


	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h3>Add New Employe</h3>
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-6 offset-md-3">
					<form action="library/adding_employe_features.php" method="POST">

						<!-- Name Address Field -->
						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" name="name" class="form-control" required="required">
						</div>
						

						<!-- Email Address Field -->
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" name="email" class="form-control" required="required">
						</div>

						<!-- Phone Number Field -->
						<div class="form-group">
							<label for="phone">Phone</label>
							<input type="text" name="phone" class="form-control" required="required">
						</div>

						<!-- Add Employe Button -->
						<div class="form-group">
							<input type="hidden" name="action" value="add">
							<input type="submit" name="addEmploye" value="Add New Employe" class="btn btn-primary">
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>


<?php include "includes/footer.php"; ?>
