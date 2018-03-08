<!DOCTYPE html>
<html>
<head>
	<title>FIRST TERM EXAMINATION REPORT SHEET</title>
	<?php 
	echo'<link rel="icon" type="image/png" sizes="16x16" href="'.base_url().'../assets/icons/icon16.png">
	<link href="'.base_url().'../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="'.base_url().'../assets/font/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="'.base_url().'../assets/css/result.css" rel="stylesheet">
	';
 ?>

</head>
<body class="resultBG">
	<?php
		switch ($result_data['TERM']) {
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
<div class="pull-right hidden-xs hidden-sm hidden-md"><button onclick="window.print();" class="btn btn-primary"><i class='fa fa-print fa-fw'></i>Print</button></div><br><br>
<div class="clearfix"></div>
<div class="container exam-result">
	<div class="col-lg-8 col-lg-offset-2"><p class="text-center"><img src="<?php echo base_url(); ?>../assets/img/banner.png"></p></div><div class="clearfix"></div>
	<br>
<hr>
<h5 class='text-center'><span>TERM : </span> <i>  <?php echo $term; ?></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>SESSION</span> : <i><?php echo $result_data['SESSION']; ?></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>REG NO</span> : <i><?php echo $student_info->ADMISSION_NUMBER; ?></i></h5>
<h5><span>STUDENT NAME :</span><i>  <?php echo strtoupper($student_info->SURNAME." ".$student_info->FIRSTNAME." ".$student_info->OTHERNAME);   ?></i></h5>
<h5><span>CLASS : </span><i><?php echo $result_data['CLASS']; ?></i></h5>
<hr>


<?php
if ($this->session->flashdata('message')) {

               echo' <div class="alert alert-info">
               	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <h4 class="text-center">'.$this->session->flashdata('message').'</h4></div>';
           }

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
				<div class='col-lg-4 attendance hidden-sm hidden-md hidden-xs'>
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

				<div class='col-lg-4 col-sm-4 col-xs-12 col-md-3  attendance hidden-lg'>
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


				<div class='col-lg-8 col-md-4 col-sm-6 trait  col-xs-12 hidden-lg'>
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
						<th class="shrink4">CA (30)</th>
						<th class="shrink2">EXAM (70)</th>
						<th class="shrink2">TOTAL (100)</th>
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
					'CLASS'=>$result_data['CLASS'],
					'TERM'=>$result_data['TERM'],
					'SESSION'=>$result_data['SESSION'],
					'SUBJECT_ID'=>$result->SUBJECT_ID
				);

				$CA=0; 
				
				if(!is_null($result->CA1)){$CA+=$result->CA1;}else{$CA+=0;}

				if(!is_null($result->CA2)){$CA+=$result->CA2;}else{$CA+=0;}

				if(!is_null($result->CA3)){$CA+=$result->CA3;}else{$CA+=0;}

				$total=round($CA,1)+$result->EXAM; //TOTAL SCORE CA SCORE+EXAM SCORE
				$overall_total_score+=$total;	//SUM OF ALL THE TOTAL SCORES IN ALL SUBJECTS

				//GET GRADING SYSTEM ACCORDING TO CLASS
				if(preg_match("/^S.S/", $result_data['CLASS'])){$grade=getgradeExamSS($total);}
				else{$grade=getgradeExamJSS($total);}
				
				echo'

					<tr>
						<td>'.$counter.'</td>
						<td style="text-align:left; padding-left:5px;">'.strtoupper($result->SUBJECT).'</td>
						<td>'.round($CA,1).'</td>
						<td>'.$result->EXAM.'</td>
						<td>'.$total.'</td>
						<td>'.round($this->admin_model->fetch_exam_average($subject_data),1).'</td>
						<td>'.$this->admin_model->fetch_exam_highest($subject_data).'</td>
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

				if(is_null($comments->TEACHER_EXAM)){
					$teacherComment="<button class='btn btn-warning btn-sm' data-toggle='modal' href='#addTeachercomment'>Add Teacher's Comment</button>";
					$teacherDate="";
				}
				else{
					$teacherComment=$comments->TEACHER_EXAM." <button class='btn btn-danger btn-xs' data-toggle='modal' href='#editTeachercomment'>Edit Teacher's Comment</button>";
					$teacherDate=$comments->TEACHER_EXAM_DATE;
				}

				if(is_null($comments->PRINCIPAL_EXAM)){
					$principalComment="<button class='btn btn-warning btn-sm' data-toggle='modal' href='#addPrincipalcomment'>Add Principal's Comment</button>";
					$principalDate="";
				}
				else{
					$principalComment=$comments->PRINCIPAL_EXAM ." <button class='btn btn-danger btn-xs' data-toggle='modal' href='#editPrincipalcomment'>Edit Principal's Comment</button>";
					$principalDate=$comments->PRINCIPAL_EXAM_DATE;
				}

				echo'
					<h5><span>CLASS TEACHER\'S COMMENT :  </span>'.$teacherComment.'</h5>
					<h5 class="text-right"><span>SIGNATURE : </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <span>DATE : </span> '.$teacherDate.'</h5>
					<h5><span>PRINCIPAL\'S COMMENT :</span>'.$principalComment.'</h5>
					<h5 class="text-right"><span>SIGNATURE : </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span>DATE : </span>'.$principalDate.'</h5>
					<br>
				';
			}
			else{
				echo"<div class=' alert alert-warning'><h5 class='text-center'>Comments has not being Added</h5></div>";
				echo"
					<div class='btn-group'>
						<button class='btn btn-primary btn-sm' data-toggle='modal' href='#addTeachercomment'>Add Teacher's Comment</button>
						<button class='btn btn-warning btn-sm' data-toggle='modal' href='#addPrincipalcomment'>Add Principal's Comment</button>
					</div>
				";
			}

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


<!--===ADD PRINCIPAL EXAM COMMENT MODAL-->		
<div class="modal fade" id="addPrincipalcomment">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title text-center">Principal's Comment</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url(); ?>admin/add_principal_exam_comment">
					<input type="hidden" name="comment_id" value="<?php if(isset($comments->ID)){ echo $comments->ID; }?>">
					<input type="hidden" name="term" value="<?php echo $result_data['TERM']; ?>" required>
					<input type="hidden" name="session" value="<?php echo $result_data['SESSION']; ?>" required>
					<input type="hidden" name="class" value="<?php echo $result_data['CLASS'] ?>" required>
					<input type="hidden" name="regNo" value="<?php echo $result_data['STUDENT_NUMBER']; ?>" required>
					<div class="form-group">
						<textarea class="form-control" name="principalComment" required></textarea>
					</div>
					<button class="btn btn-lg btn-block btn-primary">Add Comment</button>
					
				</form>
			</div>
		</div>
	</div>
</div>

<!--===ADD TEACHER EXAM COMMENT MODAL-->		
<div class="modal fade" id="addTeachercomment">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title text-center">Teacher's Comment</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url(); ?>admin/add_teacher_exam_comment">
					<input type="hidden" name="comment_id" value="<?php if(isset($comments->ID)){ echo $comments->ID; }?>">
					<input type="hidden" name="term" value="<?php echo $result_data['TERM']; ?>" required>
					<input type="hidden" name="session" value="<?php echo $result_data['SESSION']; ?>" required>
					<input type="hidden" name="class" value="<?php echo $result_data['CLASS'] ?>" required>
					<input type="hidden" name="regNo" value="<?php echo $result_data['STUDENT_NUMBER']; ?>" required>
					<div class="form-group">
						<textarea class="form-control" name="comment" required></textarea>
					</div>
					<button class="btn btn-lg btn-block btn-primary">Add Comment</button>
					
				</form>
			</div>
		</div>
	</div>
</div>

<!--===EDIT TEACHER EXAM COMMENT MODAL-->		
<div class="modal fade" id="editTeachercomment">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title text-center">Teacher's Comment</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url(); ?>admin/edit_teacher_exam_comment">
					<input type="hidden" name="comment_id" value="<?php if(isset($comments->ID)){ echo $comments->ID; }?>">
					<input type="hidden" name="term" value="<?php echo $result_data['TERM']; ?>" required>
					<input type="hidden" name="session" value="<?php echo $result_data['SESSION']; ?>" required>
					<input type="hidden" name="class" value="<?php echo $result_data['CLASS'] ?>" required>
					<input type="hidden" name="regNo" value="<?php echo $result_data['STUDENT_NUMBER']; ?>" required>
					<div class="form-group">
						<textarea class="form-control" name="comment" required><?php if(isset($comments->TEACHER_EXAM)){ echo $comments->TEACHER_EXAM; }?></textarea>
					</div>
					<button class="btn btn-lg btn-block btn-primary">Update Comment</button>
				</form>
			</div>
		</div>
	</div>
</div>

<!--===EDIT PRINCIPAL EXAM COMMENT MODAL-->		
<div class="modal fade" id="editPrincipalcomment">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title text-center">Principal's Comment</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url(); ?>admin/edit_principal_exam_comment">
					<input type="hidden" name="comment_id" value="<?php if(isset($comments->ID)){ echo $comments->ID; }?>">
					<input type="hidden" name="term" value="<?php echo $result_data['TERM']; ?>" required>
					<input type="hidden" name="session" value="<?php echo $result_data['SESSION']; ?>" required>
					<input type="hidden" name="class" value="<?php echo $result_data['CLASS'] ?>" required>
					<input type="hidden" name="regNo" value="<?php echo $result_data['STUDENT_NUMBER']; ?>" required>
					<div class="form-group">
						<textarea class="form-control" name="principalComment" required><?php if(isset($comments->PRINCIPAL_EXAM)){ echo $comments->PRINCIPAL_EXAM; }?></textarea>
					</div>
					<button class="btn btn-lg btn-block btn-primary">Update Comment</button>
				</form>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url(); ?>../assets/js/jquery.min.js"></script>
 <script src="<?php echo base_url(); ?>../assets/js/bootstrap.min.js"></script>
</body>
</html>