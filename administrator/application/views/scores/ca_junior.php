<!DOCTYPE html>
<html>
<head>
<title>CA REPORT SHEET</title>	
<?php 
echo'<link rel="icon" type="image/png" sizes="16x16" href="'.base_url().'../assets/icons/icon16.png">
	<link href="'.base_url().'../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="'.base_url().'../assets/css/result.css" rel="stylesheet">'
 ?>
</head>
<body class="resultBG">
<div class="pull-right hidden-xs hidden-sm hidden-md">
	<button onclick="window.print();" class="btn btn-primary" type="button">Print</button>
	</div>
<div class="clearfix"></div>
	<div class="container exam-result">
	<div class="col-lg-8 col-lg-offset-2"><p class="text-center"><img src="<?php echo base_url(); ?>../assets/img/banner.png"></p></div><div class="clearfix"></div>
	<br>
	
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
	<h1 class="text-center"><?php echo  $term; ?> TERM MID-TERM ASSESSMENT REPORT</h1>
	<h2 class="text-center"><?php echo $result_data['SESSION']; ?> ACADEMIC SESSION</h2>

	<h3 class='text-center'><span> NAME: </span> <?php echo strtoupper($student_info->SURNAME." ".$student_info->FIRSTNAME." ".$student_info->OTHERNAME)   ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>CLASS: </span> <?php echo $result_data['CLASS']; ?></h3>

		<?php

		 if ($this->session->flashdata('message')) {

               echo' <div class="alert alert-info">
               	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <h4 class="text-center">'.$this->session->flashdata('message').'</h4></div>';
           }
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
					'CLASS'=>$result_data['CLASS'],
					'TERM'=>$result_data['TERM'],
					'SESSION'=>$result_data['SESSION'],
					'SUBJECT_ID'=>$result->SUBJECT_ID
				);

				$total=round($result->CA1+$result->CA2,1);
				
				if($result->CA1<10){
					$ca1='0'.$result->CA1;
				}
				if($result->CA2<10){
					$ca2='0'.$result->CA2;
				}

				if($total<10){
					$total_score='0'.$total;
				}
				else{
					$total_score=$total;
				}
				echo"

					<tr><td>$counter</td>
						<td style='text-align:left; padding-left:5px;'>".strtoupper($result->SUBJECT)."</td>
						<td>$ca1</td>
						<td>$ca2</td>
						<td>$total_score</td>
						<td>".$this->admin_model->fetch_ca_highest($subject_data)."</td>
						<td>".number_format($this->admin_model->fetch_ca_average($subject_data),1)."</td>
						<td>".getCA_grade_junior($total)."</td>
					</tr>
					


				";
				$counter++;
			}

			echo"</tbody>
					</table>";

			if($comments){

				if(is_null($comments->TEACHER_CA)){
					$teacherComment="<button class='btn btn-warning btn-sm' data-toggle='modal' href='#addTeachercomment'>Add Teacher's Comment</button>";
					$teacherDate="";
				}
				else{
					$teacherComment=$comments->TEACHER_CA." <button class='btn btn-danger btn-xs' data-toggle='modal' href='#editTeachercomment'>Edit Teacher's Comment</button>";
					$teacherDate=$comments->TEACHER_CA_DATE;
				}

				if(is_null($comments->PRINCIPAL_CA)){
					$principalComment="<button class='btn btn-warning btn-sm' data-toggle='modal' href='#addPrincipalcomment'>Add Principal's Comment</button>";
					$principalDate="";
				}
				else{
					$principalComment=$comments->PRINCIPAL_CA ." <button class='btn btn-danger btn-xs' data-toggle='modal' href='#editPrincipalcomment'>Edit Principal's Comment</button>";
					$principalDate=$comments->PRINCIPAL_CA_DATE;
				}
				echo'
					
					<h5><strong>CLASS TEACHER\'S COMMENT :</strong>  '.$teacherComment.'</h5>
					<h5 class="text-right"><strong>SIGNATURE : </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>DATE : </strong> '.$teacherDate.'</h5>




					<h5><strong>PRINCIPAL\'S COMMENT : </strong>'.$principalComment.'</h5>
					<h5 class="text-right"><strong>SIGNATURE : </strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>DATE :</strong> '. $principalDate.'</h5>
					<br><br><div class="row resultfooter"><h5 class="text-center key"> <b>KEY: A(20 – 17) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; B(16 – 13) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; C(12 – 9)	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; D(8 – 5) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; E(4 – 0)</b> </h5></div>
					<p class="text-center notice">ANY ALTERATION RENDERS THIS RESULT INVALID</p>
					</div>
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
	}
	else{
		echo"<div class='alert alert-info'>
			<h1 class='text-center'>No Result Found</h1>
		</div>
		"
		;
	}
?>
			
			
			
<!--===ADD PRINCIPAL CA COMMENT MODAL-->		
<div class="modal fade" id="addPrincipalcomment">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title text-center">Principal's Comment</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url(); ?>admin/add_principal_ca_comment">
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


<!--===EDIT PRINCIPAL CA COMMENT MODAL-->		
<div class="modal fade" id="editPrincipalcomment">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title text-center">Principal's Comment</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url(); ?>admin/edit_principal_ca_comment">
					<input type="hidden" name="comment_id" value="<?php if(isset($comments->ID)){ echo $comments->ID; }?>">
					<input type="hidden" name="term" value="<?php echo $result_data['TERM']; ?>" required>
					<input type="hidden" name="session" value="<?php echo $result_data['SESSION']; ?>" required>
					<input type="hidden" name="class" value="<?php echo $result_data['CLASS'] ?>" required>
					<input type="hidden" name="regNo" value="<?php echo $result_data['STUDENT_NUMBER']; ?>" required>
					<div class="form-group">
						<textarea class="form-control" name="principalComment" required><?php if(isset($comments->PRINCIPAL_CA)){ echo $comments->PRINCIPAL_CA; }?></textarea>
					</div>
					<button class="btn btn-lg btn-block btn-primary">Update Comment</button>
				</form>
			</div>
		</div>
	</div>
</div>

<!--===EDIT TEACHER CA COMMENT MODAL-->		
<div class="modal fade" id="editTeachercomment">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title text-center">Teacher's Comment</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url(); ?>admin/edit_teacher_ca_comment">
					<input type="hidden" name="comment_id" value="<?php if(isset($comments->ID)){ echo $comments->ID; }?>">
					<input type="hidden" name="term" value="<?php echo $result_data['TERM']; ?>" required>
					<input type="hidden" name="session" value="<?php echo $result_data['SESSION']; ?>" required>
					<input type="hidden" name="class" value="<?php echo $result_data['CLASS'] ?>" required>
					<input type="hidden" name="regNo" value="<?php echo $result_data['STUDENT_NUMBER']; ?>" required>
					<div class="form-group">
						<textarea class="form-control" name="comment" required><?php if(isset($comments->TEACHER_CA)){ echo $comments->TEACHER_CA; }?></textarea>
					</div>
					<button class="btn btn-lg btn-block btn-primary">Update Comment</button>
				</form>
			</div>
		</div>
	</div>
</div>


<!--===ADD TEACHER CA COMMENT MODAL-->		
<div class="modal fade" id="addTeachercomment">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title text-center">Teacher's Comment</h4>
			</div>
			<div class="modal-body">
				<form method="post" action="<?php echo base_url(); ?>admin/add_teacher_ca_comment">
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




 <script src="<?php echo base_url(); ?>../assets/js/jquery.min.js"></script>
 <script src="<?php echo base_url(); ?>../assets/js/bootstrap.min.js"></script>
</body>
</html>