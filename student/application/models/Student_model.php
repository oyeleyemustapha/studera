<?php
 defined('BASEPATH') OR exit('No direct script access allowed');
 class Student_model extends CI_Model{


 	//PROCESS LOGIN
 	function process_login($username, $password){
 		$this->db->select('*');
 		$this->db->from('studentlogin');
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

 	//VERIFY ADMIN
 	function verify_admin($username, $password){
 		$this->db->select('*');
 		$this->db->from('studentlogin');
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


 	//=======================================
 	//=======================================
 	//-------------REESOURCES---------------
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

 	//FETCH RESOURCES PER CATEGORY
 	function fetch_resources($category){
 		$this->db->select('resources.TITLE TITLE, resources.RESOURCES, resources_cat.CATEGORY CATEGORY');
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

 	//UPDATE PASSWORD
 	function update_password($password){
 		$this->db->set('PASSWORD', $password);
 		$this->db->where('USERNAME', $_SESSION['username']);
		if($this->db->update('studentlogin')){
			return true;
		}
		else{
	 		return false;
	 	}
 	}

}


?>