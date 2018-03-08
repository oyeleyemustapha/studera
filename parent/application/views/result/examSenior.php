<!DOCTYPE html>
<html>
<head>
	<title>S.S.3 EXAMINATION REPORT SHEET</title>
	<link rel="icon" type="image/png" sizes="16x16" href="../assets/icons/icon16.png">
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/css/result.css" rel="stylesheet">
	<link href="../assets/font/font-awesome/css/font-awesome.min.css" rel="stylesheet">
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
//var_dump($exam_result);
		
	?>
<div class="pull-right hidden-md hidden-sm hidden-xs"><button onclick="window.print();" class="btn btn-primary"><i class='fa fa-print fa-fw'></i>Print</button></div>
<br><br>
<div class="clearfix"></div>
<div class="container exam-result">
<div class="col-lg-8 col-lg-offset-2"><p class="text-center"><img src="../assets/img/banner.png"></p></div><div class="clearfix"></div>
	<br>
<hr>
<h5 class='text-center'><span>TERM : </span> <i>  <?php echo $term; ?></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>SESSION</span> : <i><?php echo $this->input->post('session'); ?></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>REG NO</span> : <i><?php echo $student_info->ADMISSION_NUMBER; ?></i></h5>
<h5><span>STUDENT NAME :</span><i>  <?php echo strtoupper($student_info->SURNAME." ".$student_info->FIRSTNAME." ".$student_info->OTHERNAME);   ?></i></h5>
<h5><span>CLASS : </span><i><?php echo $this->input->post('class'); ?></i></h5>
<hr>


<?php


		if($exam_result){


			echo "<div class='row'>";
			if($behaviour){
				$neatness=$behaviour->NEATNESS;
				$attitude=$behaviour->ATTITUDE;
				$attention=$behaviour->ATTENTION;
				$fluency=$behaviour->FLUENCY;
				$writing=$behaviour->WRITING;
				$honesty=$behaviour->HONESTY;
				echo"
				<div class='col-lg-4 col-sm-12 col-xs-12 attendance hidden-sm hidden-md hidden-xs'>
				<br>
				<h5 style='font-size:12px;'><span>SCHOOL ATTENDANCE</span></h5>
				<table class='table table-bordered table-condensed table-striped exam examinfo'>
				<thead><tr><th>Frequency</th><th>School</th></tr></thead>
				<tbody>
				<tr><td>No. of times School Opened</td><td>$behaviour->NO_SCHOOL</td></tr>
				<tr><td>No. of times present</td><td>$behaviour->NO_PRESENT</td></tr>
				<tr><td>No. of times Absent</td><td>$behaviour->NO_ABSENT</td></tr>
				</tbody>
				</table>
				<br>
				</div>

				<div class='col-lg-4 col-sm-4 col-xs-12 col-md-4 attendance hidden-lg'>
				<br>
				<h5 style='font-size:12px;'><span>SCHOOL ATTENDANCE</span></h5>
				<table class='table table-bordered table-condensed table-striped exam examinfo'>
				<thead><tr><th>Frequency</th><th>School</th></tr></thead>
				<tbody>
				<tr><td>No. of times School Opened</td><td>$behaviour->NO_SCHOOL</td></tr>
				<tr><td>No. of times present</td><td>$behaviour->NO_PRESENT</td></tr>
				<tr><td>No. of times Absent</td><td>$behaviour->NO_ABSENT</td></tr>
				</tbody>
				</table>
				<br>
				</div>

				<div class='col-lg-8  col-sm-12 col-xs-12 trait hidden-sm hidden-md hidden-xs'>
				<h5 style='font-size:12px;'><span>STUDENT TRAITS</span></h5>
			
				<table class='table table-bordered table-condensed table-striped exam examinfo'>
				<thead><tr><th>Qualities</th><th>Excellent</th><th>Good</th><th>Fair</th><th>Poor</th></tr></thead>
				<tbody>".
				"<tr><td>Neatness</td>";
				if($neatness==1){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($neatness==2){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($neatness==3){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($neatness==4){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				
				echo"</tr>"
				."<tr><td>Attitude to Work </td>";
				if($attitude==1){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($attitude==2){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($attitude==3){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($attitude==4){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				echo"</tr>".

				"<tr><td>Attentiveness</td>";
				if($attention==1){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($attention==2){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($attention==3){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($attention==4){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				echo"</tr>".

				"<tr><td>Verbal Fluency</td>";
				if($fluency==1){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($fluency==2){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($fluency==3){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($fluency==4){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				echo"</tr>".

				"<tr><td>Hand Writing</td>";
				if($writing==1){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($writing==2){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($writing==3){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($writing==4){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				echo"</tr>".

				"<tr><td>Honesty</td>";
				if($honesty==1){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($honesty==2){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($honesty==3){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($honesty==4){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				echo"</tr>".
				"</tbody>
				</table>
				</div>


				<div class='col-lg-8 col-md-8 col-sm-8 col-xs-12 trait hidden-lg'>
				<h5 style='font-size:12px;'><span>STUDENT TRAITS</span></h5>
				<div class='table-responsive'>
				<table class='table table-bordered table-condensed table-striped exam examinfo'>
				<thead><tr><th>Qualities</th><th>Excellent</th><th>Good</th><th>Fair</th><th>Poor</th></tr></thead>
				<tbody>".
				"<tr><td>Neatness</td>";
				if($neatness==1){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($neatness==2){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($neatness==3){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($neatness==4){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				
				echo"</tr>"
				."<tr><td>Attitude to Work </td>";
				if($attitude==1){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($attitude==2){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($attitude==3){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($attitude==4){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				echo"</tr>".

				"<tr><td>Attentiveness</td>";
				if($attention==1){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($attention==2){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($attention==3){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($attention==4){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				echo"</tr>".

				"<tr><td>Verbal Fluency</td>";
				if($fluency==1){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($fluency==2){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($fluency==3){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($fluency==4){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				echo"</tr>".

				"<tr><td>Hand Writing</td>";
				if($writing==1){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($writing==2){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($writing==3){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($writing==4){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				echo"</tr>".

				"<tr><td>Honesty</td>";
				if($honesty==1){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($honesty==2){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($honesty==3){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				if($honesty==4){echo"<td><i class='fa fa-check'></i></td>";}else{echo"<td> </td>";} 
				echo"</tr>".
				"</tbody>
				</table>
				</div></div>
				";
			}
			else{
				echo"<div class=' alert alert-warning'><h5 class='text-center'>School Attendence and Student's Trait Report has not being Added</h5></div>";
			}
		
			echo'</div>
			<div class="table-responsive"> 
				<table class="table table-striped table-bordered exam">
				<thead>
					<tr>
						<th class="shrink1">S/N</th>
						<th style="width:200px;">SUBJECT</th>
						<th class="shrink2">SCORES</th>
						<th class="shrink3">AVERAGE MARK</th>
						<th class="shrink3">HIGHEST MARK</th>
						<th style="width:50px;">GRADE</th>
						<th style="width:60px;">REMARK</th>
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

			

				$total=$result->EXAM; //EXAM SCORE ONLY
				$overall_total_score+=$total;	//SUM OF ALL THE TOTAL SCORES IN ALL SUBJECTS

				$grade=getgradeExamSS($total);// GET SCORE GRADER
			
				
				echo'

					<tr>
						<td>'.$counter.'</td>
						<td style="text-align:left; padding-left:5px;">'.strtoupper($result->SUBJECT).'</td>
						<td>'.$total.'</td>
						<td>'.round($this->parent_model->fetch_exam_average($subject_data),1).'</td>
						<td>'.$this->parent_model->fetch_exam_highest($subject_data).'</td>
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