<?php 

	include "database.php"; 
	include "session.php"; 
	Session::init();

	$db = new DATABASE();
	$table = "employe_data";

	if ( isset($_REQUEST['action']) && !empty($_REQUEST['action']) ){

		if ( $_REQUEST['action'] == 'add' ){

			$data = array(
				'name' 	=> $_POST['name'],
				'email' => $_POST['email'],
				'phone' => $_POST['phone']
			);

			// If, Else Condition for check the data blank/exist or not
			$insert = $db->insert($table, $data);

			if ( $insert )
			{
				$msg = "Data Inserted Successfully";
			}
			else
			{
				$msg =  "Data Not Inserted!";
			}
			
			Session::set('msg', $msg);
			$home_url = '../index.php';
			header('Location: '. $home_url );
		}

	elseif( $_REQUEST['action'] == 'edit'  )
	{
		$em_id = $_POST['em_id'];

		if ( !empty($em_id) ){

			$data = array(
				'name' 	=> $_POST['name'],
				'email' => $_POST['email'],
				'phone' => $_POST['phone']
			);

			$table = "employe_data";
			$condition = array('em_id' => $em_id);
			$update = $db->update($table, $data, $condition);

			if ( $update )
			{
				$msg = "Data Updated Successfully";
			}
			else
			{
				$msg =  "Data Not Updated!";
			}
				Session::set('msg', $msg);
				$home_url = '../index.php';
				header('Location: '. $home_url );
		

			}

		}
		elseif( $_REQUEST['action'] == 'delete'  )
		{
			$em_id = $_GET['em_id'];
			if ( !empty($em_id) )
			{
				$table 		= "employe_data";
				$condition 	= array('em_id' => $em_id);
				$delete 	= $db->delete($table, $condition);
				if ( $delete )
				{
					$msg = "Data Delete Successfully";
				}
				else
				{
					$msg = "Data not Deleted.";
				}
				Session::set('msg', $msg);
				$home_url = '../index.php';
				header('Location: '. $home_url );

			}
		}
	}



?>






