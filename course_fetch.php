<?php

//course_fetch.php

include('database_connection.php');
include('function.php');

$query = '';
if($_SESSION['type'] == 'Instructor')
{

	
}

$output = array();
$query .= "
SELECT * FROM course 
INNER JOIN course_type ON course_type.course_type_id = course.course_type_id
INNER JOIN domain ON domain.domain_id = course.domain_id
INNER JOIN subdomain ON subdomain.subdomain_id = course.subdomain_id
INNER JOIN institute ON institute.institute_id = course.institute_id 
INNER JOIN user_details ON user_details.user_id = course.course_enter_by 
";




$query .= "WHERE course_enter_by=".$_SESSION['user_id'] ;
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	$status = '';
	if($row['course_status'] == 'active')
	{
		$status = '<span class="label label-success">Active</span>';
	}
	else
	{
		$status = '<span class="label label-danger">Inactive</span>';
	}
	$sub_array = array();
	$sub_array[] = $row['course_id'];
	$sub_array[] = $row['course_type_name'];
	$sub_array[] = $row['domain_name'];
	$sub_array[] = $row['subdomain_name'];
	$sub_array[] = $row['course_name'];
	$sub_array[] = $row['institute_name'];
	$sub_array[] = $row["course_duration"]. ' ' . $row["duration_type"];
	$sub_array[] = $row['user_name'];
	$sub_array[] = $status;
	$sub_array[] = '<button type="button" name="view" id="'.$row["course_id"].'" class="btn btn-info btn-xs view">View</button>';
	$sub_array[] = '<button type="button" name="update" id="'.$row["course_id"].'" class="btn btn-warning btn-xs update">Update</button>';
	$sub_array[] = '<button type="button" name="delete" id="'.$row["course_id"].'" class="btn btn-danger btn-xs delete" data-status="'.$row["course_status"].'">Delete</button>';
	$data[] = $sub_array;
}

function get_total_all_records($connect)
{
	$statement = $connect->prepare('SELECT * FROM course');
	$statement->execute();
	return $statement->rowCount();
}

$output = array(
	"draw"    			=> 	intval($_POST["draw"]),
	"recordsTotal"  	=>  $filtered_rows,
	"recordsFiltered" 	=> 	get_total_all_records($connect),
	"data"    			=> 	$data
);

echo json_encode($output);

?>