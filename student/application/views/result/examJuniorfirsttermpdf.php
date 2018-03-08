<!DOCTYPE html>
<html>
<head>
	<title>FIRST TERM EXAMINATION REPORT SHEET</title>
	<link rel="icon" type="image/png" sizes="16x16" href="../assets/icons/icon16.png">
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/font/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="../assets/css/result.css" rel="stylesheet">
</head>
<body class="resultBG">
	<?php
		switch ($this->input->post('term')) {
			case '1':
				$term="First Term";
				break;
			case '2':
				$term="Second Term";
				break;
			case '3':
				$term="Third Term";
				break;
		}
	?>
<div class="pull-right hidden-xs hidden-sm hidden-md"><button onclick="window.print();" class="btn btn-primary"><i class='fa fa-print fa-fw'></i>Print</button></div><br><br>
<div class="clearfix"></div>
<div class="container exam-result">
	

<h5 class='text-center'><span>TERM : </span> <i>  <?php echo $term; ?></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>SESSION</span> : <i><?php echo $this->input->post('session'); ?></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>REG NO</span> : <i><?php echo $student_info->ADMISSION_NUMBER; ?></i></h5>
<h5><span>STUDENT NAME :</span><i>  <?php echo strtoupper($student_info->SURNAME." ".$student_info->FIRSTNAME." ".$student_info->OTHERNAME);   ?></i></h5>
<h5><span>CLASS : </span><i><?php echo $this->input->post('class'); ?></i></h5>
<hr>


<?php


		if($exam_result){

			echo'
			<div class="table-responsive">
				<table class="table table-striped table-bordered exam">
				<thead>
					<tr>
						<th class="shrink1">S/N</th>
						<th style="width:100px;">SUBJECT</th>
						<th style="width:30px;">CA (30)</th>
						<th style="width:30px;">EXAM (70)</th>
						<th style="width:40px;">TOTAL (100)</th>
						<th style="width:40px;">GRADE</th>
						<th style="width:45px;">REMARK</th>
					</tr>
				</thead>
				<tbody>
			';
			$counter=1;
			$overall_total_score=0;
			foreach ($exam_result as $result) {
				$subject_data=array(
					'CLASS'=>$this->input->post('class'),
					'TERM'=>$this->input->post('term'),
					'SESSION'=>$this->input->post('session'),
					'SUBJECT_ID'=>$result->SUBJECT_ID
				);

				$CA=0; 
				
				if(!is_null($result->CA1)){$CA+=$result->CA1;}else{$CA+=0;}

				if(!is_null($result->CA2)){$CA+=$result->CA2;}else{$CA+=0;}

				if(!is_null($result->CA3)){$CA+=$result->CA3;}else{$CA+=0;}

				$total=round($CA,1)+$result->EXAM; //TOTAL SCORE CA SCORE+EXAM SCORE
				$overall_total_score+=$total;	//SUM OF ALL THE TOTAL SCORES IN ALL SUBJECTS

				//GET GRADING SYSTEM ACCORDING TO CLASS
				if(preg_match("/^S.S/", $this->input->post('class'))){$grade=getgradeExamSS($total);}
				else{$grade=getgradeExamJSS($total);}
				
				echo'

					<tr>
						<td>'.$counter.'</td>
						<td style="text-align:left; padding-left:5px;">'.strtoupper($result->SUBJECT).'</td>
						<td>'.round($CA,1).'</td>
						<td>'.$result->EXAM.'</td>
						<td>'.$total.'</td>
						<td>'.$grade[0].'</td>
						<td>'.$grade[1].'</td>
					</tr>
		
				';
				$counter++;
			}
			echo'</tbody></table></div>
			<h5 class="text-right" style="font-size:12px; line-height: 1em;"><span>TOTAL SCORES : '.$overall_total_score.'</span></h5>
			<h5 class="text-right" style="font-size:12px;"><span>PRESENT AVERAGE : '.round($overall_total_score/count($exam_result),2).'</span></h5>
			';


			if($comments){
				echo'
					<h5><span>CLASS TEACHER\'S COMMENT :  </span>'.$comments->TEACHER_EXAM.'</h5>
					<h5 class="text-right"><span>SIGNATURE : </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <span>DATE : </span> '.$comments->TEACHER_EXAM_DATE.'</h5>
					<h5><span>PRINCIPAL\'S COMMENT :</span>'.$comments->PRINCIPAL_EXAM.'</h5>
					<h5 class="text-right"><span>SIGNATURE : </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>DATE : </span>'.$comments->PRINCIPAL_EXAM_DATE.'</h5>
					<br>
				';
			}
			else{echo"<div class=' alert alert-warning'><h5 class='text-center'>Comments has not being Added</h5></div>";}

			if($behaviour){
				echo'<h5 style="line-height:0px;"><b>RESUMPTION DATE :</b> <i>'.$behaviour->RESUMPTION_DATE.'</i></h5></div>';
			}
		}
		else{
				echo"<div class='alert alert-info'>
					<h1 class='text-center'>No Result Found</h1>
				</div>
				";
			}
		 ?>
</body>
</html>