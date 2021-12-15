<?php

//subdomain_action.php

include('database_connection.php');

if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'Add')
	{
		$query = "

		INSERT INTO subdomain (subdomain_name) 
		VALUES (:subdomain_name)

		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				
				':subdomain_name'	=>	$_POST["subdomain_name"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Sub Domain Name Added';
		}
	}

	if($_POST['btn_action'] == 'fetch_single')
	{
		$query = "
		SELECT * FROM subdomain WHERE subdomain_id = :subdomain_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':subdomain_id'	=>	$_POST["subdomain_id"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
		
			$output['subdomain_name'] = $row['subdomain_name'];
		}
		echo json_encode($output);
	}
	if($_POST['btn_action'] == 'Edit')
	{
		$query = "
		UPDATE subdomain set 
		subdomain_name = :subdomain_name 
		WHERE subdomain_id = :subdomain_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':subdomain_name'	=>	$_POST["subdomain_name"],
				':subdomain_id'		=>	$_POST["subdomain_id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Sub Domain Name Edited';
		}
	}

	if($_POST['btn_action'] == 'delete')
	{
		$status = 'active';
		if($_POST['status'] == 'active')
		{
			$status = 'inactive';
		}
		$query = "
		UPDATE subdomain 
		SET subdomain_status = :subdomain_status 
		WHERE subdomain_id = :subdomain_id
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':subdomain_status'	=>	$status,
				':subdomain_id'		=>	$_POST["subdomain_id"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Sub Domain status change to ' . $status;
		}
	}
}

?>