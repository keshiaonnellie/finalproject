<?php 

//student_course.php

include('database_connection.php');
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Product filter in php</title>

    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href = "css/jquery-ui.css" rel = "stylesheet">
    <!-- Custom CSS -->
    <link href="css/style5.css" rel="stylesheet">
</head>

<body>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
        	<br />
        	<h2 align="center">Courses</h2>
        	<br />
            <div class="col-md-3">                				
				<div class="list-group">
				<!-- Course fee -->
                    <h3>Course Fee(LKR)</h3>
					<input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="90000000" />
                    <p id="price_show">100000.00 - 90000000.00</p>
                    <div id="price_range"></div>
                </div>		
                <!-- Course Type		 -->
                <div class="list-group">
                    <h3>Course Type</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
					<?php

                    $query = "SELECT DISTINCT course_type.course_type_name, course_type.course_type_id
                    FROM course
                    INNER JOIN course_type
                    ON course.course_type_id=course_type.course_type_id WHERE course_status = 'active' ORDER BY course_id DESC";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector type" value="<?php echo $row['course_type_id']; ?>"  > <?php echo $row['course_type_name']; ?></label>
                    </div>
                    <?php
                    }

                    ?>
                    </div>
                </div>
                <!-- Domain -->
                <div class="list-group">
                    <h3>Domain</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
					<?php

                    $query = "SELECT DISTINCT domain.domain_name, domain.domain_id
                    FROM course
                    INNER JOIN domain
                    ON course.domain_id=domain.domain_id WHERE course_status = 'active' ORDER BY course_id DESC";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector Domain" value="<?php echo $row['domain_id']; ?>"  > <?php echo $row['domain_name']; ?></label>
                    </div>
                    <?php
                    }

                    ?>
                    </div>
                </div>
                <!-- Sub Domain -->
                <div class="list-group">
                    <h3>Sub Domain</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
					<?php

                    $query = "SELECT DISTINCT subdomain.subdomain_name, subdomain.subdomain_id
                    FROM course
                    INNER JOIN subdomain
                    ON course.subdomain_id=subdomain.subdomain_id WHERE course_status = 'active' ORDER BY course_id DESC";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector SubDomain" value="<?php echo $row['subdomain_id']; ?>"  > <?php echo $row['subdomain_name']; ?></label>
                    </div>
                    <?php
                    }

                    ?>
                    </div>
                </div>
                <!-- Institute -->
                <div class="list-group">
                    <h3>Institute</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
					<?php

                    $query = "SELECT DISTINCT institute.institute_name, institute.institute_id
                    FROM course
                    INNER JOIN institute
                    ON course.institute_id=institute.institute_id WHERE course_status = 'active' ORDER BY course_id DESC";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector Institute" value="<?php echo $row['institute_id']; ?>"  > <?php echo $row['institute_name']; ?></label>
                    </div>
                    <?php
                    }

                    ?>
                    </div>
                </div>

				
            </div>

            <div class="col-md-9">
            	<br />
                <div class="row filter_data">

                </div>
            </div>
        </div>

    </div>
<style>
#loading
{
	text-align:center; 
	background: url('loader.gif') no-repeat center; 
	height: 150px;
}
</style>

<script>
$(document).ready(function(){

    filter_data();

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var type = get_filter('type');
        var Domain = get_filter('Domain');
        var SubDomain = get_filter('SubDomain');
        var Institute = get_filter('Institute');
        $.ajax({
            url:"student_course_fetch_data.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, type:type, Domain:Domain, SubDomain:SubDomain, Institute:Institute},
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

    $('#price_range').slider({
        range:true,
        min:100000,
        max:90000000,
        values:[100000, 90000000],
        step:500,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });

});
</script>

</body>

</html>
