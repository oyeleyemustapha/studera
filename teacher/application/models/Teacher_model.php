<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 class Teacher_model extends CI_Model{


 	//PROCESS LOGIN
 	function process_login($username, $password){
 		$this->db->select('*');
 		$this->db->from('teachers');
 		$this->db->where('USERNAME', $username);
 		$this->db->where('PASSWORD', $password);
 		$query= $this->db->get();
 		if ($query->num_rows()==1) {
 			return $query->result();
 		}
 		else{
 			return false;
 		}
 	}

 	//VERIFY TECAHER
 	function verify_admin($username, $password){
 		$this->db->select('*');
 		$this->db->from('teachers');
 		$this->db->where('USERNAME', $username);
 		$this->db->where('PASSWORD', $password);
 		$query= $this->db->get();
 		if ($query->num_rows()==1) {
 			return true;
 		}
 		else{
 			return false;
 		}
 	}


 	//=======================================
 	//=======================================
 	//-------------STUDENTS------------------
 	//=======================================
 	//=======================================

 	//SERCH STUDENT RECORD BASED ON NAME AND STUDENT REG NO
 	function search_student($search){
 		$this->db->select('CONCAT(FIRSTNAME, " ", OTHERNAME, " ", SURNAME) as NAME, ADMISSION_NUMBER, PICTURE, ID');
 		$this->db->from('students');
 		$this->db->where('CONCAT(FIRSTNAME, " ", OTHERNAME, " ", SURNAME) REGEXP', $search);
		$this->db->or_where('ADMISSION_NUMBER REGEXP', $search);
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->result();
 		}
 		else{
 			return false;
 		}
 	}

 	//FETCH STUDENT INFORMATION
 	function get_student_info($id){
 		$this->db->select('*');
 		$this->db->from('students');
		$this->db->where('ADMISSION_NUMBER', $id);
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->row();
 		}
 		else{
 			return false;
 		}
 	}


 	//GET CLASS NAME
 	function get_class_name($class_id){
 		$this->db->select('CLASS');
 		$this->db->from('class');
		$this->db->where('ID', $class_id);
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->row();
 		}
 		else{
 			return false;
 		}
 	}

 	//GET SUBJECT NAME
 	function get_subject_name($subject_id){
 		$this->db->select('SUBJECT, SUBJECT_ID');
 		$this->db->from('subject');
		$this->db->where('SUBJECT_ID', $subject_id);
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->row();
 		}
 		else{
 			return false;
 		}
 	}

 	//UPDATE LOGIN DETAILS
 	function update_login_info($login_info){
 		$this->db->set('USERNAME', $login_info['USERNAME']);
 		$this->db->set('PASSWORD', $login_info['PASSWORD']);
 		$this->db->where('TEACHER_ID', $_SESSION['teacher_id']);
		if($this->db->update('teachers', $login_info)){
			return true;
		}
		else{
	 		return false;
	 	}
 	}

 	//UPDATE TEACHER INFORMATION
 	function update_info($info){
 		$this->db->set('NAME', $info['NAME']);
 		$this->db->set('PHONE', $info['PHONE']);
 		$this->db->set('EMAIL', $info['EMAIL']);
 		$this->db->where('TEACHER_ID', $_SESSION['teacher_id']);
		if($this->db->update('teachers', $info)){
			return true;
		}
		else{
	 		return false;
	 	}
 	}

 	//GET STUDENT LIST TO USED FOR SELECT2 PLUGIN
 	function getStudentlistSELECT2($search){
 		//$this->output->enable_profiler(TRUE);
 		$this->db->select('CONCAT(SURNAME," ", FIRSTNAME, " ", OTHERNAME) NAME, ADMISSION_NUMBER');
 		$this->db->from('students');
	 	$this->db->where('SURNAME REGEXP', $search);
	 	$this->db->or_where('FIRSTNAME REGEXP', $search);
	 	$this->db->or_where('OTHERNAME REGEXP', $search);
	 	$query=$this->db->get();
	 	return $query->result_array();
 	}

 	//GET PROMOTION LIST
 	function promotion_list($class){
 		$this->db->select('CONCAT(SURNAME," ", FIRSTNAME, " ", OTHERNAME) NAME, ADMISSION_NUMBER');
 		$this->db->from('students');
	 	$this->db->where('PRESENT_CLASS', $class);
	 	$this->db->where('STATUS', 'Active');
	 	$this->db->order_by('ADMISSION_NUMBER', 'ASC');
	 	$query=$this->db->get();
	 	if($query->num_rows()>0){
	 		return $query->result();
	 	}
	 	else{
	 		return false;
	 	}	
 	}

 	//PROMOTE STUDENT
 	function PromoteStudent($promote){
 		$this->db->set('PRESENT_CLASS', $promote['PROMOTE_CLASS']);
 	 	$this->db->where('ADMISSION_NUMBER', $promote['ADMISSION_NUMBER']);
		if($this->db->update('students')){
			return true;
		}
		else{
		 	return false;
		}
 	}

 	function processBehaivourReport($report_data){
 		if($this->db->insert('behaviour', $report_data)){
 			return true;
 		}
 		else{
 			return false;
 		}
 	}

 	//FETCH STUDENT LIST IN A CLASS
 	function fetch_student_list($class){
 		$this->db->select('FIRSTNAME, OTHERNAME, SURNAME, ADMISSION_NUMBER');
 		$this->db->from('students');
 		$this->db->where('PRESENT_CLASS',$class);
 		$this->db->where('STATUS', 'Active');
 		$this->db->order_by('ADMISSION_NUMBER','ASC');
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->result();
 		}
 		else{
 			return false;
 		}
 	}

 	//FETCH STUDENT INFORMATION
 	function fetch_student_info($student_no){
 		$this->db->select('*');
 		$this->db->from('students');
 		$this->db->where('ADMISSION_NUMBER', $student_no);
 		$query=$this->db->get();
 		return $query->row();
 	}

 
 	//GET STUDENT LIST FOR THE ENTRY OF STUDENT BEHAIVOUR REPORT
 	function getStudentlist_for_behaivour($list_data){

 		$this->db->select('*');
 		$this->db->from('behaviour');
 		$this->db->where($list_data);
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return false;
 		}else{
 			$this->db->select('FIRSTNAME, SURNAME, OTHERNAME, ADMISSION_NUMBER');
	 		$this->db->from('students');
	 		$this->db->where('PRESENT_CLASS', $list_data['CLASS']);
	 		$this->db->where('STATUS', 'Active');
	 		$query=$this->db->get();
	 		return $query->result();
 		}	
 	}

 	

 	//=======================================
 	//=======================================
 	//-------------COMMENTS------------------
 	//=======================================
 	//=======================================

 	//FETCH COMMENTS
 	function fetch_comments($score_data){
 		$this->db->select('*');
 		$this->db->from('comments');
 		$this->db->where($score_data);
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->row();
 		}
 		else{
 			return false;
 		}
 	}

 	//ADD PRINCIPAL COMMENTS
 	function add_principal_comment($comment_data){

 		if($comment_data['ID']!=""){
	 		$this->db->set('PRINCIPAL_CA', $comment_data['PRINCIPAL_CA']);
 			$this->db->set('PRINCIPAL_CA_DATE', $comment_data['PRINCIPAL_CA_DATE']);
	 		$this->db->where('ID', $comment_data['ID']);
			if($this->db->update('comments')){
				return true;
			}
			else{
		 		return false;
		 	}
 		}else
 		{
 			if($this->db->insert('comments', $comment_data)){
	 			return true;
	 		}
	 		else{
	 			return false;
	 		}
 		}
 		
 	}

 	//ADD TEACHER COMMENTS
 	function add_teacher_comment($comment_data){

 		if($comment_data['ID']!=""){
	 		$this->db->set('TEACHER_CA', $comment_data['TEACHER_CA']);
 			$this->db->set('TEACHER_CA_DATE', $comment_data['TEACHER_CA_DATE']);
	 		$this->db->where('ID', $comment_data['ID']);
			if($this->db->update('comments')){
				return true;
			}
			else{
		 		return false;
		 	}
 		}else
 		{
 			if($this->db->insert('comments', $comment_data)){
	 			return true;
	 		}
	 		else{
	 			return false;
	 		}
 		}
 		
 	}

 	//ADD PRINCIPAL EXAM COMMENTS
 	function add_principal_exam_comment($comment_data){

 		if($comment_data['ID']!=""){
	 		$this->db->set('PRINCIPAL_EXAM', $comment_data['PRINCIPAL_EXAM']);
 			$this->db->set('PRINCIPAL_EXAM_DATE', $comment_data['PRINCIPAL_EXAM_DATE']);
	 		$this->db->where('ID', $comment_data['ID']);
			if($this->db->update('comments')){
				return true;
			}
			else{
		 		return false;
		 	}
 		}else
 		{
 			if($this->db->insert('comments', $comment_data)){
	 			return true;
	 		}
	 		else{
	 			return false;
	 		}
 		}
 		
 	}


 	//ADD TEACHER EXAM COMMENTS
 	function add_teacher_exam_comment($comment_data){
 		if($comment_data['ID']!=""){
	 		$this->db->set('TEACHER_EXAM', $comment_data['TEACHER_EXAM']);
 			$this->db->set('TEACHER_EXAM_DATE', $comment_data['TEACHER_EXAM_DATE']);
	 		$this->db->where('ID', $comment_data['ID']);
			if($this->db->update('comments')){
				return true;
			}
			else{
		 		return false;
		 	}
 		}
 		else
 		{
 			if($this->db->insert('comments', $comment_data)){
	 			return true;
	 		}
	 		else{
	 			return false;
	 		}
 		}
 		
 	}


 	//EDIT PRINCIPAL COMMENTS
 	function edit_principal_comment($comment_data){
	 		$this->db->set('PRINCIPAL_CA', $comment_data['PRINCIPAL_CA']);
	 		$this->db->where('ID', $comment_data['ID']);
			if($this->db->update('comments')){
				return true;
			}
			else{
		 		return false;
		 	}
 	}

 	//EDIT PRINCIPAL EXAM COMMENTS
 	function edit_principal_exam_comment($comment_data){
	 		$this->db->set('PRINCIPAL_EXAM', $comment_data['PRINCIPAL_EXAM']);
	 		$this->db->where('ID', $comment_data['ID']);
			if($this->db->update('comments')){
				return true;
			}
			else{
		 		return false;
		 	}
 	}

 	//EDIT TEACHER COMMENTS
 	function edit_teacher_comment($comment_data){
	 		$this->db->set('TEACHER_CA', $comment_data['TEACHER_CA']);
	 		$this->db->where('ID', $comment_data['ID']);
			if($this->db->update('comments')){
				return true;
			}
			else{
		 		return false;
		 	}
 	}

 	//EDIT TEACHER EXAM COMMENTS
 	function edit_teacher_exam_comment($comment_data){
	 		$this->db->set('TEACHER_EXAM', $comment_data['TEACHER_EXAM']);
	 		$this->db->where('ID', $comment_data['ID']);
			if($this->db->update('comments')){
				return true;
			}
			else{
		 		return false;
		 	}
 	}

 	//FETCH CA RESULT FOR S.S.3 STUDENTS
 	function fetch_ca_resultSenior($result_data){
 		$this->db->select('scores.CA1 CA, scores.SUBJECT_ID SUBJECT_ID, subject.SUBJECT SUBJECT');
 		$this->db->from('scores');
 		$this->db->join('subject', 'scores.SUBJECT_ID=subject.SUBJECT_ID', 'left');
 		$this->db->where('scores.CA1 IS NOT NULL');
 		$this->db->where($result_data);
 		$this->db->order_by('subject.SUBJECT','ASC');
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->result();
 		}
 		else{
 			return false;
 		 	
 		}
 	}

 	//FETCH EXAM RESULT FOR S.S.3 STUDENTS
 	function fetch_exam_resultSenior($result_data){
 		$this->db->select('scores.EXAM EXAM, scores.SUBJECT_ID SUBJECT_ID, subject.SUBJECT SUBJECT');
 		$this->db->from('scores');
 		$this->db->join('subject', 'scores.SUBJECT_ID=subject.SUBJECT_ID', 'left');
 		$this->db->where('scores.EXAM IS NOT NULL');
 		$this->db->where($result_data);
 		$this->db->order_by('subject.SUBJECT','ASC');
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->result();
 		}
 		else{
 			return false;
 		 	
 		}
 	}


 	
 	//FETCH THE HIGHTEST SCORE PER SUBJECT IN A CLASS FOR CA RESULT(S.S.3)
 	function fetch_ca_highestSenior($subject_data){
 		$this->db->select('MAX(CA1) as TOTAL');
 		$this->db->from('scores');
 		$this->db->where($subject_data);
 		$query=$this->db->get();
 			return $query->row()->TOTAL;
 	}

 	//FETCH THE AVARAGE SCORE PER SUBJECT IN A CLASS FOR CA RESULT(S.S.3)
 	function fetch_ca_averageSenior($subject_data){
 		$this->db->select('AVG(CA1) as AVERAGE');
 		$this->db->from('scores');
 		$this->db->where($subject_data);
 		$query=$this->db->get();
 			return $query->row()->AVERAGE;
 	}


 	//FETCH SCORES FOR FIRST TERM AND SECOND TERM RESULT PER SUBJECT
 	function get_scores_second($score_data){
 		$this->db->select('IFNULL(EXAM, 0)+IFNULL(CA1, 0)+IFNULL(CA2, 0)+IFNULL(CA3, 0) as TOTAL, TERM');
 		$this->db->from('scores');
 		$this->db->where($score_data);
 		$this->db->where('TERM <',3);
 		$this->db->order_by('TERM','ASC');
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->result();
 		}
 		else{
 			return false;
 		 	
 		}
 	}

 	//FETCH SCORES FOR FIRST TERM AND SECOND TERM RESULT PER SUBJECT
 	function get_scores_third($score_data){
 		$this->db->select('IFNULL(EXAM, 0)+IFNULL(CA1, 0)+IFNULL(CA2, 0)+IFNULL(CA3, 0) as TOTAL, TERM');
 		$this->db->from('scores');
 		$this->db->where($score_data);
 		$this->db->order_by('TERM','ASC');
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->result();
 		}
 		else{
 			return false;
 		 	
 		}
 	}
 	//FETCH CA RESULT
 	function fetch_ca_result($result_data){
 		$this->db->select('scores.CA1 CA1, scores.CA2 CA2, scores.SUBJECT_ID SUBJECT_ID, subject.SUBJECT SUBJECT');
 		$this->db->from('scores');
 		$this->db->join('subject', 'scores.SUBJECT_ID=subject.SUBJECT_ID', 'left');
 		$this->db->where('scores.CA1 IS NOT NULL');
 		$this->db->where('scores.CA2 IS NOT NULL');
 		$this->db->where($result_data);
 		$this->db->order_by('subject.SUBJECT','ASC');
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->result();
 		}
 		else{
 			return false;
 		 	
 		}
 	}

 	//FETCH BEHAIVOURAL COMMENTS FOR EXAMINATION RESULT SHEET
 	function fetch_bahaviour($score_data){
 		$this->db->select('*');
 		$this->db->from('behaviour');
 		$this->db->where($score_data);
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->row();
 		}
 		else{
 			return false;
 		}
 	}

 	//FETCH EXAM RESULT
 	function fetch_exam_result($result_data){
 		$this->db->select('scores.CA1 CA1, scores.CA2 CA2, scores.CA3 CA3, scores.EXAM EXAM, scores.SUBJECT_ID SUBJECT_ID, subject.SUBJECT SUBJECT');
 		$this->db->from('scores');
 		$this->db->join('subject', 'scores.SUBJECT_ID=subject.SUBJECT_ID', 'left');
 		$this->db->where('scores.EXAM IS NOT NULL');
 		$this->db->where('scores.CA3 IS NOT NULL');
 		$this->db->where($result_data);
 		$this->db->order_by('subject.SUBJECT','ASC');
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->result();
 		}
 		else{
 			return false;
 		 	
 		}
 	}

 	//FETCH THE HIGHTEST SCORE PER SUBJECT IN A CLASS FOR CA RESULT
 	function fetch_ca_highest($subject_data){
 		$this->db->select('MAX(IFNULL(CA1, 0)+IFNULL(CA2, 0)) as TOTAL');
 		$this->db->from('scores');
 		$this->db->where($subject_data);
 		$query=$this->db->get();
 			return $query->row()->TOTAL;
 	}

 	//FETCH THE AVARAGE SCORE PER SUBJECT IN A CLASS FOR CA RESULT
 	function fetch_ca_average($subject_data){
 		$this->db->select('AVG(IFNULL(CA1, 0)+IFNULL(CA2, 0)) as AVERAGE');
 		$this->db->from('scores');
 		$this->db->where($subject_data);
 		$query=$this->db->get();
 			return $query->row()->AVERAGE;
 	}

 	//FETCH THE AVARAGE SCORE PER SUBJECT IN A CLASS FOR EXAM RESULT
 	function fetch_exam_average($subject_data){
 		$this->db->select('AVG(IFNULL(EXAM, 0)+IFNULL(CA1, 0)+IFNULL(CA2, 0)+IFNULL(CA3, 0)) as AVERAGE');
 		$this->db->from('scores');
 		$this->db->where($subject_data);
 		$query=$this->db->get();
 			return $query->row()->AVERAGE;
 	}

 	//FETCH THE HIGHTEST SCORE PER SUBJECT IN A CLASS FOR EXAM RESULT
 	function fetch_exam_highest($subject_data){
 		$this->db->select('MAX(IFNULL(EXAM, 0)+IFNULL(CA1, 0)+IFNULL(CA2, 0)+IFNULL(CA3, 0)) as TOTAL');
 		$this->db->from('scores');
 		$this->db->where($subject_data);
 		$query=$this->db->get();
 			return $query->row()->TOTAL;
 	}

 	//FETCH THE AVARAGE SCORE PER SUBJECT IN A CLASS FOR EXAM RESULT FOR S.S.3
 	function fetch_exam_average_senior($subject_data){
 		$this->db->select('AVG(IFNULL(EXAM, 0)) as AVERAGE');
 		$this->db->from('scores');
 		$this->db->where($subject_data);
 		$query=$this->db->get();
 			return $query->row()->AVERAGE;
 	}

 	//FETCH THE HIGHTEST SCORE PER SUBJECT IN A CLASS FOR EXAM RESULT FOR SS3
 	function fetch_exam_highest_senior($subject_data){
 		$this->db->select('MAX(IFNULL(EXAM, 0)) as TOTAL');
 		$this->db->from('scores');
 		$this->db->where($subject_data);
 		$query=$this->db->get();
 			return $query->row()->TOTAL;
 	}

 	//GENERATE GRADE LIST FOR SPECIFIED SUBJECT, TERM, SESSION AND CLASS

 	function fetch_grade_list($result_data){
 		$this->db->select('subject.SUBJECT SUBJECT, scores.SCORE_ID SCORE_ID, students.FIRSTNAME FIRSTNAME, students.OTHERNAME OTHERNAME, students.SURNAME SURNAME, students.ADMISSION_NUMBER ADMISSION_NUMBER, scores.CA1 CA1, scores.CA2 CA2, scores.CA3 CA3, scores.EXAM EXAM');
 		$this->db->from('scores');
 		$this->db->join('students', 'scores.STUDENT_NUMBER=students.ADMISSION_NUMBER', 'left');
 		$this->db->join('subject', 'scores.SUBJECT_ID=subject.SUBJECT_ID', 'left');
 		$this->db->where('scores.SUBJECT_ID', $result_data['SUBJECT']);
 		$this->db->where('scores.TERM',$result_data['TERM']);
 		$this->db->where('scores.SESSION',$result_data['SESSION']);
 		$this->db->where('scores.CLASS',$result_data['CLASS']);
 		$this->db->order_by('scores.STUDENT_NUMBER','ASC');
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->result();
 		}
 		else{
 			return false;
 		 	
 		}
 	}
 
 	//FETCH SCORE DETAIL
 	function fetch_score_info($score_id){
 		$this->db->select('scores.EXAM EXAM, scores.CA1 CA1, scores.CA2 CA2, scores.CA3 CA3, students.ADMISSION_NUMBER ADMISSION_NUMBER, students.FIRSTNAME FIRSTNAME, students.OTHERNAME OTHERNAME, students.SURNAME SURNAME, scores.SCORE_ID SCORE_ID');
 		$this->db->from('scores');
 		$this->db->join('students', 'scores.STUDENT_NUMBER=students.ADMISSION_NUMBER', 'left');
 		$this->db->where('scores.SCORE_ID', $score_id);
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->row();
 		}
 		else{
 			return false;
 		}
 	}

 	//UPDATE SCORE
 	function update_score($score_info){
 		
 		$this->db->where('SCORE_ID', $score_info['SCORE_ID']);
		if($this->db->update('scores', $score_info)){
			return true;
		}
		else{
	 		return false;
	 	}
 	}


	//DELETE SCORE
 	function delete_score($score_id){
 		$this->db->where('SCORE_ID', $score_id);
		if($this->db->delete('scores')){
			return true;
		}
		else{
			return false;
		}
 	}

 	//GET STUDENT LIST FOR THE ENTRY OF STUDENT BEHAIVOUR REPORT
 	function getStudentlist_for_scoresentry($list_data, $type){
 	
 		$this->db->select('*');
 		$this->db->from('scores');
 		$this->db->where($list_data);
 		if($type=="CA"){
 			
 			if(preg_match("/^S.S.3/", $_POST["class"])){
 			 	$this->db->where('CA1 IS NOT NULL');
 			}
 			else{
 			 	$this->db->where('CA1 IS NOT NULL');
 				$this->db->where('CA2 IS NOT NULL');
 			}
 		}
 		else{
 			if(preg_match("/^S.S.3/", $_POST["class"])){
 			 	$this->db->where('EXAM IS NOT NULL');
 			}
 			else{
 			 	$this->db->where('EXAM IS NOT NULL');
 			 	$this->db->where('CA3 IS NOT NULL');
 			}
 		}
 		
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return false;
 		}
 		else{
 			$this->db->select('FIRSTNAME, SURNAME, OTHERNAME, ADMISSION_NUMBER');
	 		$this->db->from('students');
	 		$this->db->where('PRESENT_CLASS', $list_data['CLASS']);
	 		$this->db->where('STATUS', 'Active');
	 		$this->db->order_by('ADMISSION_NUMBER', 'ASC');
	 		$query=$this->db->get();
	 		return $query->result();
	 	}
 	}

 	//GET SUBJECT INFO
 	function getSsubjectName($subject_id){
 		
 			$this->db->select('SUBJECT');
	 		$this->db->from('subject');
	 		$this->db->where('SUBJECT_ID', $subject_id);
	 		$query=$this->db->get();
	 		return $query->row();

 	}

 	//PROCESS SCORES 
 	function processCAscores($report_data){
 		if($this->db->insert('scores', $report_data)){
 			return true;
 		}
 		else{
 			return false;
 		}
 	}

 	//PROCESS SINGLE CA SCORES FOR SS3 STUDENTS 
 	function processSingleSeniorCAscores($report_data){
 		$this->db->select('*');
	 	$this->db->from('scores');
	 	$this->db->where('TERM', $report_data['TERM']);
	 	$this->db->where('SESSION', $report_data['SESSION']);
	 	$this->db->where('CLASS', $report_data['CLASS']);
	 	$this->db->where('SUBJECT_ID', $report_data['SUBJECT_ID']);
	 	$this->db->where('STUDENT_NUMBER', $report_data['STUDENT_NUMBER']);
	 	$this->db->where('CA1 IS NOT NULL');
	 	$query=$this->db->get();
 		if($query->num_rows()>0){
 			return false;
 		}
 		else{
	 		if($this->db->insert('scores', $report_data)){
	 			return true;
	 		}
	 		else{
	 			return false;
	 		}
 		}
 	}

 	//PROCESS SINGLE CA SCORES FOR JSS1-SS2 STUDENTS 
 	function processSingleJuniorCAscores($report_data){
 		$this->db->select('*');
	 	$this->db->from('scores');
	 	$this->db->where('TERM', $report_data['TERM']);
	 	$this->db->where('SESSION', $report_data['SESSION']);
	 	$this->db->where('CLASS', $report_data['CLASS']);
	 	$this->db->where('SUBJECT_ID', $report_data['SUBJECT_ID']);
	 	$this->db->where('STUDENT_NUMBER', $report_data['STUDENT_NUMBER']);
	 	$this->db->where('CA1 IS NOT NULL');
	 	$this->db->where('CA2 IS NOT NULL');
	 	$query=$this->db->get();
 		if($query->num_rows()>0){
 			return false;
 		}
 		else{
	 		if($this->db->insert('scores', $report_data)){
	 			return true;
	 		}
	 		else{
	 			return false;
	 		}
 		}
 	}




 	//PROCESS EXAM SCORES FOR STUDENTS IN JSS1-SS2
 	function processJUNIOREXAMscores($report_data){

 		$this->db->select('*');
	 	$this->db->from('scores');
	 	$this->db->where('TERM', $report_data['TERM']);
	 	$this->db->where('SESSION', $report_data['SESSION']);
	 	$this->db->where('CLASS', $report_data['CLASS']);
	 	$this->db->where('SUBJECT_ID', $report_data['SUBJECT_ID']);
	 	$this->db->where('STUDENT_NUMBER', $report_data['STUDENT_NUMBER']);
	 	$this->db->where('CA1 IS NOT NULL');
	 	$this->db->where('CA2 IS NOT NULL');
	 	$query=$this->db->get();
 		if($query->num_rows()==0){

 			if($this->db->insert('scores', $report_data)){
 				return true;
	 		}
	 		else{
	 			return false;
	 		}
 		}
 		else{
 			$this->db->where('TERM', $report_data['TERM']);
		 	$this->db->where('SESSION', $report_data['SESSION']);
		 	$this->db->where('CLASS', $report_data['CLASS']);
		 	$this->db->where('SUBJECT_ID', $report_data['SUBJECT_ID']);
		 	$this->db->where('STUDENT_NUMBER', $report_data['STUDENT_NUMBER']);
			if($this->db->update('scores', $report_data)){
				return true;
			}
			else{
		 		return false;
		 	}
 		}
 	}

 	//PROCESS SINGLE EXAM SCORES FOR STUDENTS IN JSS1-SS2
 	function processSingleJUNIOREXAMscores($report_data){
 		$this->db->select('*');
	 	$this->db->from('scores');
	 	$this->db->where('TERM', $report_data['TERM']);
	 	$this->db->where('SESSION', $report_data['SESSION']);
	 	$this->db->where('CLASS', $report_data['CLASS']);
	 	$this->db->where('SUBJECT_ID', $report_data['SUBJECT_ID']);
	 	$this->db->where('STUDENT_NUMBER', $report_data['STUDENT_NUMBER']);
	 	$this->db->where('CA3 IS NOT NULL');
	 	$this->db->where('EXAM IS NOT NULL');
	 	$query=$this->db->get();
 		if($query->num_rows()>0){
 			return false;
 		}
 		else{
 			$this->db->select('*');
		 	$this->db->from('scores');
		 	$this->db->where('TERM', $report_data['TERM']);
		 	$this->db->where('SESSION', $report_data['SESSION']);
		 	$this->db->where('CLASS', $report_data['CLASS']);
		 	$this->db->where('SUBJECT_ID', $report_data['SUBJECT_ID']);
		 	$this->db->where('STUDENT_NUMBER', $report_data['STUDENT_NUMBER']);
		 	$this->db->where('CA1 IS NOT NULL');
		 	$this->db->where('CA2 IS NOT NULL');
		 	$query=$this->db->get();
	 		if($query->num_rows()==0){

	 			if($this->db->insert('scores', $report_data)){
	 				return true;
		 		}
		 		else{
		 			return false;
		 		}
	 		}
	 		else{
	 			$this->db->where('TERM', $report_data['TERM']);
			 	$this->db->where('SESSION', $report_data['SESSION']);
			 	$this->db->where('CLASS', $report_data['CLASS']);
			 	$this->db->where('SUBJECT_ID', $report_data['SUBJECT_ID']);
			 	$this->db->where('STUDENT_NUMBER', $report_data['STUDENT_NUMBER']);
				if($this->db->update('scores', $report_data)){
					return true;
				}
				else{
			 		return false;
			 	}
	 		}
 		}
 	}

 	//PROCESS SINGLE EXAM SCORES FOR STUDENTS IN SS3
 	function processSingleSENIOREXAMscores($report_data){
 		$this->db->select('*');
	 	$this->db->from('scores');
	 	$this->db->where('TERM', $report_data['TERM']);
	 	$this->db->where('SESSION', $report_data['SESSION']);
	 	$this->db->where('CLASS', $report_data['CLASS']);
	 	$this->db->where('SUBJECT_ID', $report_data['SUBJECT_ID']);
	 	$this->db->where('STUDENT_NUMBER', $report_data['STUDENT_NUMBER']);
	 	$this->db->where('EXAM IS NOT NULL');
	 	$query=$this->db->get();
 		if($query->num_rows()>0){
 			return false;
 		}
 		else{
 			$this->db->select('*');
		 	$this->db->from('scores');
		 	$this->db->where('TERM', $report_data['TERM']);
		 	$this->db->where('SESSION', $report_data['SESSION']);
		 	$this->db->where('CLASS', $report_data['CLASS']);
		 	$this->db->where('SUBJECT_ID', $report_data['SUBJECT_ID']);
		 	$this->db->where('STUDENT_NUMBER', $report_data['STUDENT_NUMBER']);
		 	$this->db->where('CA1 IS NOT NULL');
		 	$query=$this->db->get();
	 		if($query->num_rows()==0){
	 			if($this->db->insert('scores', $report_data)){
	 				return true;
		 		}
		 		else{
		 			return false;
		 		}
	 		}
	 		else{
	 			$this->db->where('TERM', $report_data['TERM']);
			 	$this->db->where('SESSION', $report_data['SESSION']);
			 	$this->db->where('CLASS', $report_data['CLASS']);
			 	$this->db->where('SUBJECT_ID', $report_data['SUBJECT_ID']);
			 	$this->db->where('STUDENT_NUMBER', $report_data['STUDENT_NUMBER']);
				if($this->db->update('scores', $report_data)){
					return true;
				}
				else{
			 		return false;
			 	}
	 		}
 		}
 	}


 	//PROCESS EXAM SCORES FOR STUDENTS IN SS3
 	function processSENIOREXAMscores($report_data){
 		$this->db->select('*');
	 	$this->db->from('scores');
	 	$this->db->where('TERM', $report_data['TERM']);
	 	$this->db->where('SESSION', $report_data['SESSION']);
	 	$this->db->where('CLASS', $report_data['CLASS']);
	 	$this->db->where('SUBJECT_ID', $report_data['SUBJECT_ID']);
	 	$this->db->where('STUDENT_NUMBER', $report_data['STUDENT_NUMBER']);
	 	$this->db->where('CA1 IS NOT NULL');
	 	$query=$this->db->get();
 		if($query->num_rows()==0){
 			if($this->db->insert('scores', $report_data)){
 				return true;
	 		}
	 		else{
	 			return false;
	 		}
 		}
 		else{
 			$this->db->where('TERM', $report_data['TERM']);
		 	$this->db->where('SESSION', $report_data['SESSION']);
		 	$this->db->where('CLASS', $report_data['CLASS']);
		 	$this->db->where('SUBJECT_ID', $report_data['SUBJECT_ID']);
		 	$this->db->where('STUDENT_NUMBER', $report_data['STUDENT_NUMBER']);
			if($this->db->update('scores', $report_data)){
				return true;
			}
			else{
		 		return false;
		 	}
 		}
 	}

 	//GENERATE STUDENT LIST PER CLASS
 	function get_student_list_class($class){
 		$this->db->select('CONCAT(FIRSTNAME, " ", OTHERNAME, " ", SURNAME) as NAME, ADMISSION_NUMBER');
	 	$this->db->from('students');
	 	$this->db->where('PRESENT_CLASS', $class);
	 	$this->db->where('STATUS', 'Active');
	 	$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->result();
 		}
 		else{
 			return false;
 		}
 	}


}


?>