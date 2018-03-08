<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 class Admin_model extends CI_Model{


 	//PROCESS LOGIN
 	function process_login($username, $password){
 		$this->db->select('*');
 		$this->db->from('admin');
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

 	//VERIFY USER
 	function verify_user($username, $password){
 		$this->db->select('*');
 		$this->db->from('admin');
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


 	//===============================================
 	//===============================================
 	//===============RESULT=========================
 	//===============================================
 	//===============================================

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

 	//FETCH THE AVARAGE SCORE PER SUBJECT IN A CLASS FOR EXAM RESULT FOR S.S.3
 	function fetch_exam_average_senior($subject_data){
 		$this->db->select('AVG(IFNULL(EXAM, 0)) as AVERAGE');
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

 	//FETCH THE HIGHTEST SCORE PER SUBJECT IN A CLASS FOR EXAM RESULT FOR SS3
 	function fetch_exam_highest_senior($subject_data){
 		$this->db->select('MAX(IFNULL(EXAM, 0)) as TOTAL');
 		$this->db->from('scores');
 		$this->db->where($subject_data);
 		$query=$this->db->get();
 			return $query->row()->TOTAL;
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


 	//=======================================
 	//=======================================
 	//-------------BEHAIVOUR------------------
 	//=======================================
 	//=======================================

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


 	//UPDATE PASSWORD
 	function update_password($password){
 		$this->db->set('PASSWORD', $password);
 		$this->db->where('USERNAME', $_SESSION['username']);
		if($this->db->update('parentlogin')){
			return true;
		}
		else{
	 		return false;
	 	}
 	}


 	//FETCH SUBJECT LIST
 	function fetch_subject_list(){
 		$this->db->select('*');
 		$this->db->from('subject');
 		$this->db->order_by('SUBJECT', 'ASC');
 		$query=$this->db->get();
 		return $query->result();
 	}


 	//FETCH DATA FOR PERFROMANCE TREND FOR S.S.2-J.S.S3
 	function fetch_performance_data($performance_data){
 		$this->db->select('TERM, IFNULL(EXAM, 0)+IFNULL(CA1, 0)+IFNULL(CA2, 0)+IFNULL(CA3, 0) AS TOTAL, CLASS');
 		$this->db->from('scores');
 		$this->db->where($performance_data);
 		$this->db->order_by('TERM', 'ASC');
 		$query=$this->db->get();

 		if($query->num_rows()>0){
 			return $query->result_array();
 		}
 		else{
 			return false;
 		}
 		
 	}

 	//FETCH DATA FOR PERFROMANCE TREND FOR S.S.3
 	function fetch_performance_data_senior($performance_data){
 		$this->db->select('TERM, EXAM, CLASS');
 		$this->db->from('scores');
 		$this->db->where($performance_data);
 		$this->db->order_by('TERM', 'ASC');
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->result_array();
 		}
 		else{
 			return false;
 		}
 		
 	}


 	//=======================================
 	//=======================================
 	//-------------CLASS------------------
 	//=======================================
 	//=======================================


 	//ADD NEW CLASS
 	function add_class($class_info){
 		if($this->db->insert('class', $class_info)){
 			return true;
 		}
 		else{
 			return false;
 		}
 	}

 	//FETCH LIST OF CLASS
 	function get_classes(){
 		$this->db->select('class.ID ID, class.CLASS CLASS, teachers.NAME NAME');
 		$this->db->from('class');
 		$this->db->join('teachers', 'class.ID=teachers.CLASS_ID', 'left');
 		$this->db->order_by('class.CLASS','ASC');
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->result();
 		}
 		else{
 			return false;
 		 	
 		}
 	}

 	//DELETE CLASS
 	function delete_class($class_id){
 		$this->db->where('ID', $class_id);
		if($this->db->delete('class')){
			return true;
		}
		else{
			return false;
		}
 	}


 	//ASSIGN CLASS TO TEACHER
 	function assign_class($info){
 		$this->db->set('CLASS_ID', $info['class']);
 		$this->db->where('TEACHER_ID', $info['teacher']);
 		$update=$this->db->update('teachers');
 		if($update){
 			return true;
 		}
 		else{
 			return false;
 		}
 	}

 	//=======================================
 	//=======================================
 	//-------------SUBJECT------------------
 	//=======================================
 	//=======================================

 	//FETCH LIST OF SUBJECTS
 	function get_subjects(){
 		$this->db->select('*');
 		$this->db->from('subject');
 		$this->db->order_by('SUBJECT','ASC');
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->result();
 		}
 		else{
 			return false;
 		 	
 		}
 	}

 	//FETCH SUBJECT LIST TO BE USED IN SELECT2 PLUGIN
 	function fetch_subjects_list($search){
 		$this->db->select('SUBJECT_ID, SUBJECT');
 		$this->db->from('subject');
 		$this->db->where('SUBJECT REGEXP', $search);
 		$query=$this->db->get();
 		return $query->result_array();
 	}

 	//ADD NEW SUBJECT
 	function add_subject($subject){
 		if($this->db->insert('subject', $subject)){
 			return true;
 		}
 		else{
 			return false;
 		}
 	}

 	//DELETE SUBJECT
 	function delete_subject($subject_id){
 		$this->db->where('SUBJECT_ID', $subject_id);
		if($this->db->delete('subject')){
			return true;
		}
		else{
			return false;
		}
 	}

 	//FETCH SUBJECT INFORMATION
 	function fetch_subject_info($subject_id){
 		$this->db->select('*');
 		$this->db->from('subject');
 		$this->db->where('SUBJECT_ID', $subject_id);
 		$query=$this->db->get();
 		return $query->row();
 	}

 	//UPDATE SUBJECT
 	function update_subject($subject_info){
 		$this->db->set('SUBJECT',$subject_info['SUBJECT']);
 		$this->db->where('SUBJECT_ID', $subject_info['SUBJECT_ID']);
 		$update=$this->db->update('subject');
 		if($update){
 			return true;
 		}
 		else{
 			return false;
 		}
 	}


 	//=======================================
 	//=======================================
 	//-------------TEACHERS------------------
 	//=======================================
 	//=======================================


 	//FETCH TEACHERS LIST
 	function fetch_teachers_list(){
 		$this->db->select('teachers.TEACHER_ID ID, teachers.NAME NAME, teachers.USERNAME USERNAME, class.CLASS CLASS, teachers.SUBJECT SUBJECT, teachers.EMAIL EMAIL, teachers.PHONE PHONE');
 		$this->db->from('teachers');
 		$this->db->join('class', 'class.ID=teachers.CLASS_ID', 'left');
 		$this->db->order_by('teachers.TEACHER_ID','ASC');
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->result();
 		}
 		else{
 			return false;
 		 	
 		}
 	}

 	//ADD TEACHER RECORD
 	function add_teacher($teacher_info){
 		if($this->db->insert('teachers', $teacher_info)){
 			return true;
 		}
 		else{
 			return false;
 		}
 	}

 	//DELETE TEACHER
 	function delete_teacher($teacher_id){
 		$this->db->where('TEACHER_ID', $teacher_id);
		if($this->db->delete('teachers')){
			return true;
		}
		else{
			return false;
		}
 	}


 	//UPDATE TEACHER INFO
 	function update_teacher($teacher_info){
 		$this->db->set($teacher_info);
 		$this->db->where('TEACHER_ID', $teacher_info['TEACHER_ID']);
 		$update=$this->db->update('teachers');
 		if($update){
 			return true;
 		}
 		else{
 			return false;
 		}
 	}

 	//UPDATE TEACHER USERNAME AND PASSWORD
 	function update_teacher_username($teacher_info){
 		$this->db->set($teacher_info);
 		$this->db->where('TEACHER_ID', $teacher_info['TEACHER_ID']);
 		$update=$this->db->update('teachers');
 		if($update){
 			return true;
 		}
 		else{
 			return false;
 		}
 	}


 	//FETCH TECAHER INFORMATION
 	function fetch_teacher_info($teacher_id){
 		$this->db->select('teachers.TEACHER_ID ID, teachers.NAME NAME, teachers.USERNAME USERNAME, class.CLASS CLASS, teachers.SUBJECT SUBJECT, teachers.EMAIL EMAIL, teachers.PHONE PHONE');
 		$this->db->from('teachers');
 		$this->db->join('class', 'class.ID=teachers.CLASS_ID', 'left');
 		$this->db->where('TEACHER_ID', $teacher_id);
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->row();
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

 	//DEACTIVATE STUDENT ACCOUNT
 	function student_account($action, $student_no){
 		$this->db->set('STATUS', $action);
 		$this->db->where('USERNAME', $student_no);
		if($this->db->update('studentlogin')){
			return true;
		}
		else{
	 		return false;
	 	}
 	}

 	//CHANGE STUDENT LOGIN PASSWORD
 	function change_login_password($password_data){
 		$this->db->set('PASSWORD', $password_data['PASSWORD']);
 		$this->db->where('USERNAME', $password_data['USERNAME']);
		if($this->db->update('studentlogin')){
			return true;
		}
		else{
	 		return false;
	 	}
 	}

 	//UPDATE STUDENT INFORMATION
 	function update_student_info($student_info){
 		$this->db->set($student_info);
 		$this->db->where('ID', $student_info['ID']);
		if($this->db->update('students')){
			return true;
		}
		else{
	 		return false;
	 	}
 	}

 	//UPDATE STUDENT PICTURE
 	function update_student_picture($picture_info){
 		$this->db->set($picture_info);
 		$this->db->where('ADMISSION_NUMBER', $picture_info['ADMISSION_NUMBER']);
		if($this->db->update('students')){
			return true;
		}
		else{
	 		return false;
	 	}
 	}

 	//ADD NEW STUDENT
 	function add_student($student_info){
 		if($this->db->insert('students', $student_info)){
 			$account_login=array(
 				'USERNAME' => strtoupper($student_info['ADMISSION_NUMBER']),
 				'PASSWORD'=>md5(strtolower($student_info['SURNAME']))
 			);
 			$this->db->insert('studentlogin', $account_login);
 			return true;
 		}
 		else{
 			return false;
 		}
 	}

 	//=======================================
 	//=======================================
 	//-------------ADMINISTRATOR-------------
 	//=======================================
 	//=======================================

 	//FETCH THE LIST ADMINISTRATOR
 	function fetch_admin(){
 		$this->db->select('*');
 		$this->db->from('admin');
 		$this->db->order_by('NAME', 'ASC');
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->result();
 		}
 		else{
 			return false;
 		}
 	}

 	//FETCH ADMINISTRATOR INFORMATION
 	function fetch_admin_info($admin_id){
 		$this->db->select('*');
 		$this->db->from('admin');
 		$this->db->where('ADMIN_ID', $admin_id);
 		$query=$this->db->get();
 		if($query->num_rows()==1){
 			return $query->row();
 		}
 		else{
 			return false;
 		}
 	}

 	//ADD ADMINISTRATOR ACCOUNT
 	function add_admin($admin_info){
 		if($this->db->insert('admin', $admin_info)){
 			return true;
 		}
 		else{
 			return false;
 		}
 	}

 	//DELETE ADMINISTRATOR
 	function delete_admin($admin_id){
 		$this->db->where('ADMIN_ID', $admin_id);
		if($this->db->delete('admin')){
			return true;
		}
		else{
			return false;
		}
 	}


 	//UPDATE ADMINISTRATOR'S ACCOUNT
 	function update_admin($admin_info){
 		$this->db->set($admin_info);
 		$this->db->where('ADMIN_ID', $admin_info['ADMIN_ID']);
 		if($this->db->update('admin')){
 			return true;
 		}
 		else{
 			return false;
 		}
 	}

 	//FETCH NUMBER OF ACTIVE STUDENTS
 	function no_of_student(){
 		$this->db->select('COUNT(*) AS NO_OF_STUDENTS');
 		$this->db->from('students');
 		$this->db->where('STATUS', 'Active');
 		$query=$this->db->get();
 			return $query->row();
 	}

 	//=======================================
 	//=======================================
 	//-------------RESOURCES-------------
 	//=======================================
 	//=======================================

	//FETCH RESOURCES CATEGORY
 	function fetch_rescources_cat(){
 		$this->db->select('count(resources.RESOURCE_CAT) TOTAL, resources_cat.CATEGORY CATEGORY, resources_cat.ID ID');
 		$this->db->from('resources');
 		$this->db->join('resources_cat', 'resources.RESOURCE_CAT=resources_cat.ID', 'left');
 		$this->db->group_by('resources.RESOURCE_CAT');
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->result();
 		}
 		else{
 			return false;
 		}
 	}

 	//ADD LINK TO RESOURCES
 	function add_link($link_info){
 		if($this->db->insert('resources', $link_info)){
 			return true;
 		}
 		else{
 			return false;
 		}
 	}

 	//ADD OTHER RESOURCES
 	function add_other_resources($resource_info){
 		if($this->db->insert('resources', $resource_info)){
 			return true;
 		}
 		else{
 			return false;
 		}
 	}

 	//FETCH RESOURCES PER CATEGORY
 	function fetch_resources($category){
 		$this->db->select('resources.ID ID, resources.TITLE TITLE, resources.RESOURCES, resources_cat.CATEGORY CATEGORY');
 		$this->db->from('resources');
 		$this->db->join('resources_cat', 'resources.RESOURCE_CAT=resources_cat.ID', 'left');
 		$this->db->where('RESOURCE_CAT', $category);
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->result();
 		}
 		else{
 			return false;
 		}
 	}

 	//DELETE RESOURCES
 	function delete_resource($resource_id){
 		$this->db->select('RESOURCES');
 		$this->db->from('resources');
 		$this->db->where('ID', $resource_id);
 		$query=$this->db->get();
 		$file=$query->row()->RESOURCES;
 		if(file_exists('../assets/myResources/'.$file)){
 			unlink('../assets/myResources/'.$file);
 		}
 		$this->db->where('ID', $resource_id);
		if($this->db->delete('resources')){

			return true;
		}
		else{
			return false;
		}
 	}


 	//RESET PARENT PORTAL PASSWORD TO DEFAULT PASSWORD
 	function reset_parent_password($student_regno){
 		$this->db->select('SURNAME');
 		$this->db->from('students');
 		$this->db->where('ADMISSION_NUMBER', $student_regno);
 		$query=$this->db->get();
 		$surname=$query->row()->SURNAME;
 		$password=md5(strtolower($surname));
 		$this->db->set('PASSWORD', $password);
 		$this->db->where('USERNAME', $student_regno);
		if($this->db->update('parentlogin')){
			return true;
		}
		else{
	 		return false;
	 	}
 	}


 	//DEACTIVATE PARENT LOGIN
 	function deactivate_parent_login($student_no){
 		$this->db->set('STATUS', 'Inactive');
 		$this->db->where('USERNAME', $student_no);
		if($this->db->update('parentlogin')){
			return true;
		}
		else{
	 		return false;
	 	}
 	}

 	//ACTIVATE PARENT LOGIN
 	function activate_parent_login($student_no){
 		$this->db->set('STATUS', 'Active');
 		$this->db->where('USERNAME', $student_no);
		if($this->db->update('parentlogin')){
			return true;
		}
		else{
	 		return false;
	 	}
 	}



 	//=======================================
 	//=======================================
 	//-------------SCORES-------------
 	//=======================================
 	//=======================================

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



 	//FETCH SCORE SHEET 
 	function fetch_scoresheet($class){
 		$this->db->select('FIRSTNAME, OTHERNAME, SURNAME, ADMISSION_NUMBER');
 		$this->db->from('students');
 		$this->db->where('PRESENT_CLASS',$class);
 		$this->db->order_by('ADMISSION_NUMBER','ASC');
 		$query=$this->db->get();
 		if($query->num_rows()>0){
 			return $query->result();
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

 	function processBehaivourReport($report_data){
 		if($this->db->insert('behaviour', $report_data)){
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


 	
	 	
 


 

 	
}


?>