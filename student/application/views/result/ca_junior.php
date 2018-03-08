<!DOCTYPE html>
<html>
<head>
	<title>CA REPORT SHEET</title>
	<link rel="icon" type="image/png" sizes="16x16" href="../assets/icons/icon16.png">
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/css/result.css" rel="stylesheet">
</head>
<body class="resultBG">

<div class="pull-right hidden-xs hidden-sm hidden-md btn-group">
	<button onclick="window.print();" class="btn btn-primary" type="button">Print</button>
	<!--<form method="post" action="<?php echo base_url() ?>reports">
		
		<input type="hidden" name="session" value="<?php echo $this->input->post('session'); ?>">
		<input type="hidden" name="term" value="<?php echo $this->input->post('term'); ?>">
		<input type="hidden" name="type" value="<?php echo $this->input->post('type'); ?>">
		<input type="hidden" name="class" value="<?php echo $this->input->post('class'); ?>">

		<button class="btn btn-warning" name="generate">Generate PDF</button>
	</form>-->
	</div>
<div class="clearfix"></div>
	<div class="container exam-result">
	<div class="col-lg-8 col-lg-offset-2"><p class="text-center"><img src="../assets/img/banner.png"></p></div><div class="clearfix"></div>
	<br>
	<?php
		switch ($this->input->post('term')) {
			case '1':
				$term="FIRST";
				break;
			case '2':
				$term="SECOND";
				break;
			case '3':
				$term="THIRD";
				break;
		}
	

	?>
	<h1 class="text-center"><?php echo  $term; ?> TERM MID-TERM ASSESSMENT REPORT</h1>
	<h2 class="text-center"><?php echo $this->input->post('session'); ?> ACADEMIC SESSION</h2>

	<h3 class='text-center'><span> NAME: </span> <?php echo strtoupper($student_info->SURNAME." ".$student_info->FIRSTNAME." ".$student_info->OTHERNAME)   ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>CLASS: </span> <?php echo $this->input->post('class'); ?></h3>
		<?php
	if($ca_result){

		echo'
		
			<table class="table table-striped table-bordered" style="width:100%;">
				<thead>
					<tr>
						<th class="shrink1">S/N</th>
						<th class="subject">SUBJECT</th>
						<th class="ca" style="width:55px;">1<sup>ST</sup> CA</th>
						<th class="ca" style="width:55px;">2<sup>ND</sup> CA</th>
						<th class="ca" style="width:55px;">TOTAL</th>
						<th class="highest" style="width:110px;">HIGH SCORES</th>
						<th style="width:90px;">CLASS AVG</th>
						<th class="shrink22" style="width:60px;">GRADE</th>
					</tr>
				</thead>
				<tbody>
		';

			$counter=1;
			foreach ($ca_result as $result) {
				$subject_data=array(
					'CLASS'=>$this->input->post('class'),
					'TERM'=>$this->input->post('term'),
					'SESSION'=>$this->input->post('session'),
					'SUBJECT_ID'=>$result->SUBJECT_ID
				);

				$total=round($result->CA1+$result->CA2,1);
				
				echo"

					<tr><td>$counter</td>
						<td style='text-align:left; padding-left:5px;'>".strtoupper($result->SUBJECT)."</td>
						<td>$result->CA1</td>
						<td>$result->CA2</td>
						<td>$total</td>
						<td>".$this->student_model->fetch_ca_highest($subject_data)."</td>
						<td>".number_format($this->student_model->fetch_ca_average($subject_data),1)."</td>
						<td>".getCA_grade_junior($total)."</td>
					</tr>
					


				";
				$counter++;
			}

			echo"</tbody>
					</table>";

			if($comments){
				echo'
					
					<h5>CLASS TEACHER\'S COMMENT :  '.$comments->TEACHER_CA.'</h5>
					<h5 class="text-right">SIGNATURE : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; DATE : '.$comments->TEACHER_CA_DATE.'</h5>
					<h5>PRINCIPAL\'S COMMENT :'.$comments->PRINCIPAL_CA.'</h5>
					<h5 class="text-right">SIGNATURE : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; DATE : '. $comments->PRINCIPAL_CA_DATE.'</h5>
					<br><br><div class="row"><h5 class="text-center key"> <b>KEY: A(20 – 17) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; B(16 – 13) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; C(12 – 9)	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; D(8 – 5) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; E(4 – 0)</b> </h5></div>
					<p class="text-center notice">ANY ALTERATION RENDERS THIS RESULT INVALID</p>
					</div>
				';
			}
			else{
				echo"<div class=' alert alert-warning'><h5 class='text-center'>Comments has not being Added</h5></div>";
			}

	}
	else{
		echo"<div class='alert alert-info'>
			<h1 class='text-center'>No Result Found</h1>
		</div>
		"


		;
	}
?>
			
			
			
			


</body>
</html>