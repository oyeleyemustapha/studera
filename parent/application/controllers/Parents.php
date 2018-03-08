
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parents extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('parent_model');  
        require('../assets/inc/function.php');
    }

    //VERIFY USER FOR SECURITY PURPOSES
    public function verify(){
    	if(is_null($this->session->userdata('username')) && is_null($this->session->userdata('password'))){
			redirect(base_url());
		}
		else{
			if($this->parent_model->verify_user($this->session->userdata('username'),$this->session->userdata('password'))==false){
				redirect(base_url());
			}
		}
    }

    //PROCESS LOGIN
	public function login(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if($this->form_validation->run()){
			$username=strtoupper($this->input->post('username'));
			$password=md5(strtolower($this->input->post('password')));
			if($this->parent_model->process_login($username, $password)){
				$parent=$this->parent_model->process_login($username, $password);
				foreach ($parent as $parent) {
					$parent_id=$parent->ID;
					$username=$parent->USERNAME;
					$password=$parent->PASSWORD;
				}
				
				$session_data=array('username' => $username, 'password' => $password, 'parent_id'=>$parent_id);
				$this->session->set_userdata($session_data);
					redirect(base_url()."dashboard");	
			}
			else{
				$this->session->set_flashdata('error', 'Invalid Username or password');
				redirect(base_url());
			}	
		}
		else{
			$this->index();
		}
	}

	//LOGOUT
	public function logout(){
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('password');
		$this->session->unset_userdata('parent_id');
		redirect($this->index());
	}
	
	//LOGIN PAGE
	public function index(){
		$this->load->view('login');
	}

	//DASHBOARD
	public function dashboard()
	{
		$this->verify();
		$data['title']="Dashboard";
		$data['student_info']=$this->parent_model->fetch_student_info($_SESSION['username']);
		$data['password_status']=$this->check_current_password();
		$this->load->view('parts/head', $data);
		$this->load->view('dashboard', $data);
		$this->load->view('parts/javascript', $data);
	}

	
	//=============================================
	//=============================================
	//----------------RESULT-----------------------
	//=============================================
	//=============================================

	//RESULT PAGE
	public function result(){
		$this->verify();
		$data['title']="My Results";
		$data['student_info']=$this->parent_model->fetch_student_info($_SESSION['username']);
		$this->load->view('parts/head', $data);
		$this->load->view('result/result', $data);
		$this->load->view('parts/javascript', $data);
	}

	//GET RESULT
	public function reports(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('class', "Class", 'required');
		$this->form_validation->set_rules('type', 'Result Type', 'required');
		$this->form_validation->set_rules('term', 'Term', 'required');
		$this->form_validation->set_rules('session', 'Session', 'required');
		if($this->form_validation->run()){
			$result_data=array(
				'CLASS'=>$this->input->post('class'),
				'TERM'=>$this->input->post('term'),
				'SESSION'=>$this->input->post('session'),
				'STUDENT_NUMBER'=>$_SESSION['username']
			);

			//GET RESULT SHEET BASED ON THE TYPE OF RESULT
			if($this->input->post('type')==="CA"){
				$this->getCA($result_data);
			}
			else{
				$this->getExam($result_data);
			}
		}
		else{
			if(form_error('class')){
				echo form_error('class')."<br>";
			}
			if(form_error('type')){
				echo form_error('type')."<br>";
			}
			if(form_error('term')){
				echo form_error('term')."<br>";
			}
			if(form_error('session')){
				echo form_error('session')."<br>";
			}
		}
	}

	//GET CA RESULT
	public function getCA($result_data){
		
		$data['student_info']=$this->parent_model->fetch_student_info($result_data['STUDENT_NUMBER']);
		$data['comments']=$this->parent_model->fetch_comments($result_data);

		//GET CA RESULT BASED ON CLASS (S.S.3 CA RESULT SHEET IS DIFFERENT FROM OTHER CLASSES LIKE J.S.S.1-S.S.2)
		if(preg_match("/^S.S.3/", $result_data['CLASS'])){
			$data['ca_result']=$this->parent_model->fetch_ca_resultSenior($result_data);
			$this->load->view('result/ca_senior',$data); //USE S.S.3 CA RESULT SHEET
		}
		else{
			$data['ca_result']=$this->parent_model->fetch_ca_result($result_data);
			$this->load->view('result/ca_junior',$data); //USE CA RESULT SHEET FOR J.S.S.1-S.S.2
		}
	}

	//GET EXAM RESULT
	public function getExam($result_data){
		$data['student_info']=$this->parent_model->fetch_student_info($result_data['STUDENT_NUMBER']);
		$data['comments']=$this->parent_model->fetch_comments($result_data);
		$data['behaviour']=$this->parent_model->fetch_bahaviour($result_data);
		//GET CA RESULT BASED ON CLASS (S.S.3 EXAM RESULT SHEET IS DIFFERENT FROM OTHER CLASSES LIKE J.S.S.1-S.S.2)
		if(preg_match("/^S.S.3/", $result_data['CLASS'])){
			$data['exam_result']=$this->parent_model->fetch_exam_resultSenior($result_data);
			$this->load->view('result/examSenior',$data); //USE S.S.3 EXAM RESULT SHEET
		}
		else{
			switch ($result_data['TERM']) {
				case '1':
					$data['exam_result']=$this->parent_model->fetch_exam_result($result_data); 
					$this->load->view('result/examJuniorfirstterm', $data); //USE J.S.S.1-S.S.2 FIRST TERM EXAM RESULT SHEET

					break;
				case '2':
					$data['exam_result']=$this->parent_model->fetch_exam_result($result_data);
					$this->load->view('result/examJuniorSecondterm', $data); //USE J.S.S.1-S.S.2 SECOND TERM EXAM RESULT SHEET
					break;
				case '3':
					$data['exam_result']=$this->parent_model->fetch_exam_result($result_data);
					$this->load->view('result/examJuniorThirdterm', $data); //USE J.S.S.1-S.S.2 THIRD TERM EXAM RESULT SHEET
					break;
			}
		}
	}


	//=============================================
	//=============================================
	//----------------PROFILE-----------------------
	//=============================================
	//=============================================

	public function profile(){
		$this->verify();
		$data['title']="My Profile";
		$data['student_info']=$this->parent_model->fetch_student_info($_SESSION['username']);
		$this->load->view('parts/head', $data);
		$this->load->view('profile', $data);
		$this->load->view('parts/javascript', $data);
	}
	
	
	//UPDATE PASSWORD
	public function updatePassword(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|matches[password]');
		if($this->form_validation->run()){
			$password=md5(strtolower($this->input->post('password')));
			if($this->parent_model->update_password($password)){
				$session_data=array('password' => $password);
				$this->session->set_userdata($session_data);
				$this->session->set_flashdata('message', 'Your Password has been Changed');
					redirect('/profile');
			}
			else{
				$this->session->set_flashdata('message', 'Oops, there is a problem updating your password.');
					redirect('/profile');
			}	
		}
		else{
			if(form_error('password')){
				
				$this->session->set_flashdata('message', form_error('password'));
			}
			if(form_error('confirmpassword')){
				$this->session->set_flashdata('message', form_error('confirmpassword'));
			}

			redirect('/profile');
		}
	}


	//CHECK IF CURRENT PASSWORD IS A DEFAULT PASSWORD (surname) AND ALERT THE USER TO CHANGE PASSWORD
	public function check_current_password(){
		$student_info=$this->parent_model->fetch_student_info($_SESSION['username']);

		if($_SESSION['password']===md5(strtolower($student_info->SURNAME))){
			return true;
		}
	}


	//=============================================
	//=============================================
	//-------------ACADEMIC PERFORMANCE------------
	//=============================================
	//=============================================

	public function performance(){
		$this->verify();
		$data['title']="Academic Performance";
		$data['student_info']=$this->parent_model->fetch_student_info($_SESSION['username']);
		$data['subjects']=$this->get_subjects();
		if (isset($_POST['generate'])) {
			$performance_data=array(
				'SUBJECT_ID' => $this->input->post('subject'),
				'CLASS' => $this->input->post('class'),
				'STUDENT_NUMBER'=>$this->session->userdata('username')
			);

			$data['trend']=$this->performance_data($performance_data);
		}
		$this->load->view('parts/head', $data);
		$this->load->view('performance', $data);
		$this->load->view('parts/javascript', $data);
	}
	

	public function get_subjects(){
	 	$subjects=$this->parent_model->fetch_subject_list();
	 	$subject_list="";
	 	foreach ($subjects as $subject) {
	 		$subject_list.="<option value='$subject->SUBJECT_ID'>$subject->SUBJECT</option>";
	 	}
	 	return $subject_list;
	}

	public function performance_data($performance_data){
		$term=[];
		$score=[];
		$data=[];
		$result=$this->parent_model->fetch_performance_data($performance_data);
		if(preg_match("/^S.S.3/", $result[0]['CLASS'])){


			$result=$this->parent_model->fetch_performance_data_senior($performance_data);
			if($result){
				foreach ($result as $value) {
					$term[]=$value['TERM'];
					$score[]=$value['EXAM'];
				}
				$data['Label']=$term;
				$data['Value']= $score;
				return json_encode($data);
			}
			else{
				return false;
			}	
		}
		else{
			$result=$this->parent_model->fetch_performance_data($performance_data);
			if($result){
				foreach ($result as $value) {
					$term[]=$value['TERM'];
					$score[]=$value['TOTAL'];
				}
				$data['Label']=$term;
				$data['Value']= $score;
				return json_encode($data);
			}
			else{
				return false;
			}
		}
	}
}
