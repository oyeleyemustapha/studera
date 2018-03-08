<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 class Parent_model extends CI_Model{


 	//PROCESS LOGIN
 	function process_login($username, $password){
 		$this->db->select('*');
 		$this->db->from('parentlogin');
 		$this->db->where('USERNAME', $username);
 		$this->db->where('PASSWORD', $password);
 		$this->db->where('STATUS', 'Active');
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
 		$this->db->from('parentlogin');
 		$this->db->where('USERNAME', $username);
 		$this->db->where('PASSWORD', $password);
 		$this->db->where('STATUS', 'Active');
 		$query= $this->db->get();
 		if ($query->num_rows()==1) {
 			return true;
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
 		$this->db->where('scores.SESSION', $result_data['SESSION']);
 		$this->db->where('scores.TERM', $result_data['TERM']);
 		$this->db->where('scores.CLASS REGEXP', $result_data['CLASS']);
 		$this->db->where('scores.STUDENT_NUMBER', $result_data['STUDENT_NUMBER']);
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


 	//FETCH EXAM RESULT
 	function fetch_exam_result($result_data){
 		$this->db->select('scores.CA1 CA1, scores.CA2 CA2, scores.CA3 CA3, scores.EXAM EXAM, scores.SUBJECT_ID SUBJECT_ID, subject.SUBJECT SUBJECT');
 		$this->db->from('scores');
 		$this->db->join('subject', 'scores.SUBJECT_ID=subject.SUBJECT_ID', 'left');
 		$this->db->where('scores.EXAM IS NOT NULL');
 		$this->db->where('scores.CA3 IS NOT NULL');
 		$this->db->where('scores.SESSION', $result_data['SESSION']);
 		$this->db->where('scores.TERM', $result_data['TERM']);
 		$this->db->where('scores.CLASS REGEXP', $result_data['CLASS']);
 		$this->db->where('scores.STUDENT_NUMBER', $result_data['STUDENT_NUMBER']);
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
 		$this->db->where('scores.SESSION', $result_data['SESSION']);
 		$this->db->where('scores.TERM', $result_data['TERM']);
 		$this->db->where('scores.CLASS REGEXP', $result_data['CLASS']);
 		$this->db->where('scores.STUDENT_NUMBER', $result_data['STUDENT_NUMBER']);
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
 		$this->db->where('scores.SESSION', $result_data['SESSION']);
 		$this->db->where('scores.TERM', $result_data['TERM']);
 		$this->db->where('scores.CLASS REGEXP', $result_data['CLASS']);
 		$this->db->where('scores.STUDENT_NUMBER', $result_data['STUDENT_NUMBER']);
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
 		$this->db->where('scores.SESSION', $score_data['SESSION']);
 		$this->db->where('scores.TERM', $score_data['TERM']);
 		$this->db->where('scores.CLASS REGEXP', $score_data['CLASS']);
 		$this->db->where('scores.STUDENT_NUMBER', $score_data['STUDENT_NUMBER']);
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
 		$this->db->where('scores.SESSION', $score_data['SESSION']);
 		$this->db->where('scores.TERM', $score_data['TERM']);
 		$this->db->where('scores.CLASS REGEXP', $score_data['CLASS']);
 		$this->db->where('scores.STUDENT_NUMBER', $score_data['STUDENT_NUMBER']);
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

 	
}


?>