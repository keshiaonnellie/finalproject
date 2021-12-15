<?php

//student_institute_fetch_data.php

include('database_connection.php');

if(isset($_POST["action"]))
{
	$query = "
		SELECT * FROM institute WHERE institute_status = 'active'
	";
	
	if(isset($_POST["City"]))
	{
		$brand_filter = implode("','", $_POST["City"]);
		$query .= "
		 AND institute_city IN('".$brand_filter."')
		";
	}
	if(isset($_POST["Type"]))
	{
		$ram_filter = implode("','", $_POST["Type"]);
		$query .= "
		 AND institute_type IN('".$ram_filter."')
		";
	}
	

	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
	$output = '';
	if($total_row > 0)
	{
		foreach($result as $row)
		{
			$output .= '
			<div class="col-sm-4 col-lg-3 col-md-3">
				<div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:450px; box-shadow: 5px 10px 18px #888888;">
					<img src="image/'. $row['institute_image'] .'" alt="" class="img-responsive" >
					<p align="center"><strong><center><h4>'. $row['institute_name'] .'</h4></center></strong></p>
					<h4 style="text-align:center;" class="text-danger" >'. $row['institute_contact'] .'</h4>
					<p><b>Address : </b>'. $row['institute_address'].'<br />
					<b>Description :</b> '. $row['institute_description'] .' <br />
				</div>

			</div>
			';
		}
	}
	else
	{
		$output = '<h3>No Data Found</h3>';
	}
	echo $output;
}

?>