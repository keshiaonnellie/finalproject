<?php

//fetch_data.php

include('database_connection.php');

if(isset($_POST["action"]))
{
	$query = "
		SELECT * FROM course WHERE course_status = 'active'
	";
	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= "
		 AND course_fee BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		";
	}
	if(isset($_POST["type"]))
	{
		$course_filter = implode("','", $_POST["type"]);
		$query .= "
		 AND course_type_id IN('".$course_filter."')
		";
	}
	

	if(isset($_POST["Domain"]))
	{
		$course_filter = implode("','", $_POST["Domain"]);
		$query .= "
		 AND domain_id IN('".$course_filter."')
		";
	}

	if(isset($_POST["SubDomain"]))
	{
		$course_filter = implode("','", $_POST["SubDomain"]);
		$query .= "
		 AND subdomain_id IN('".$course_filter."')
		";
	}

	if(isset($_POST["Institute"]))
	{
		$course_filter = implode("','", $_POST["Institute"]);
		$query .= "
		 AND institute_id IN('".$course_filter."')
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
					
					<p align="center"><strong><h4 href="#">'. $row['course_name'] .'</h4></strong></p>
					<h4 style="text-align:center;" class="text-danger" >'. $row['course_fee'] .' Rs.</h4>
					<p><b>Description :</b><br> '. $row['course_description'].' <br><br>
					<b>Course Date :</b><br> '. $row['course_date'] .' <br><br>
					<b>Semester Fee :</b> '. $row['semester_fee'] .' Rs.<br>
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