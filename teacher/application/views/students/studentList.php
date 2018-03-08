<!DOCTYPE html>
<html>
<head>
<title>Student List</title>	
<?php 
echo'<link rel="icon" type="image/png" sizes="16x16" href="'.base_url().'../assets/icons/icon16.png">
	<link href="'.base_url().'../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="'.base_url().'../assets/css/result.css" rel="stylesheet">'
 ?>
</head>
<body>
<div class="pull-right hidden-xs hidden-sm hidden-md">
	<button onclick="window.print();" class="btn btn-primary" type="button">Print</button>
	</div>
<div class="clearfix"></div>
	<div class="container exam-result">
	<div class="col-lg-8 col-lg-offset-2"><p class="text-center"><img src="<?php echo base_url(); ?>../assets/img/banner.png"></p></div><div class="clearfix"></div>
	<br>
	
	
<?php

if($students){
	echo'

	<h1 class="text-center">STUDENTS LIST FOR '.$_POST["class"].'</h1>
<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>NAME</th>
			<th>STUDENT NUMBER</th>
		</tr>
	</thead>
	<tbody>
	';
	$counter=1;
	foreach ($students as $students) {
		echo"
		<tr>
			<td>$counter</td>
			<td><a href='student/".str_replace('/', '_', $students->ADMISSION_NUMBER)."' target='_blank'> $students->NAME</a></td>
			<td>$students->ADMISSION_NUMBER</td>
		</tr>
		";
		$counter++;
	}

	echo'</tbody></table>';
}
else{
	echo"<div class='jumbotron'><h1 class='text-center'>No Result Found</h1></div>";
}

?>
			

		






 <script src="<?php echo base_url(); ?>../assets/js/jquery.min.js"></script>
 <script src="<?php echo base_url(); ?>../assets/js/bootstrap.min.js"></script>
</body>
</html>