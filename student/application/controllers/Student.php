<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('student_model');  
        require('../assets/inc/function.php');
    }

    //VERIFY USER
    public function verify(){
    	if(is_null($this->session->userdata('username')) && is_null($this->session->userdata('password'))){
			redirect(base_url());
		}
		else{
			if($this->student_model->verify_admin($this->session->userdata('username'),$this->session->userdata('password'))==false){
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
			if($this->student_model->process_login($username, $password)){
				$student=$this->student_model->process_login($username, $password);
				foreach ($student as $student) {
					$student_id=$student->ID;
					$username=$student->USERNAME;
					$password=$student->PASSWORD;
					$status=$student->STATUS;
				}
				//COMMIT STUDENT INFO TO MEMORY
				$session_data=array('username' => $username, 'password' => $password, 'student_id'=>$student_id, 'status'=>$status);
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
		$this->session->unset_userdata('student_id');
		redirect($this->index());
	}
	
	//LOGIN PAGE
	public function index()
	{
	
		$this->load->view('login');
	}

	//DASHBOARD
	public function dashboard()
	{
		$this->verify();
		$data['title']="Dashboard";
		$data['student_info']=$this->student_model->fetch_student_info($_SESSION['username']);
		$data['password_status']=$this->check_current_password();
		$this->load->view('parts/head', $data);
		$this->load->view('dashboard', $data);
		$this->load->view('parts/javascript', $data);
	}

	//STUDENT RECORD / INFORMATION
	public function record()
	{
		$this->verify();
		$data['title']="My Information";
		$data['student_info']=$this->student_model->fetch_student_info($_SESSION['username']);
		$this->load->view('parts/head', $data);
		$this->load->view('record', $data);
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
		$data['student_info']=$this->student_model->fetch_student_info($_SESSION['username']);
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
		
		$data['student_info']=$this->student_model->fetch_student_info($result_data['STUDENT_NUMBER']);
		$data['comments']=$this->student_model->fetch_comments($result_data);

		//GET CA RESULT BASED ON CLASS (S.S.3 CA RESULT SHEET IS DIFFERENT FROM OTHER CLASSES LIKE J.S.S.1-S.S.2)
		if(preg_match("/^S.S.3/", $result_data['CLASS'])){
			$data['ca_result']=$this->student_model->fetch_ca_resultSenior($result_data);
			$this->load->view('result/ca_senior',$data); //USE S.S.3 CA RESULT SHEET
			if(isset($_POST['generate'])){
				$this->load->library('pdfgenerator');
				$html =$this->load->view('result/ca_senior',$data,true);
	    		$filename = 'report_'.time();
	    		$this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');
			}
		}
		else{
			$data['ca_result']=$this->student_model->fetch_ca_result($result_data);
			$this->load->view('result/ca_junior',$data); //USE CA RESULT SHEET FOR J.S.S.1-S.S.2
			
			if(isset($_POST['generate'])){
				$this->load->library('pdfgenerator');
				$html =$this->load->view('result/ca_junior',$data,true);
	    		$filename = 'report_'.time();
	    		$this->pdfgenerator->generate($html, $filename, true, 'A4', 'portrait');	
			}
		}
	}

	//GET EXAM RESULT
	public function getExam($result_data){

		$data['student_info']=$this->student_model->fetch_student_info($result_data['STUDENT_NUMBER']);
		$data['comments']=$this->student_model->fetch_comments($result_data);
		$data['behaviour']=$this->student_model->fetch_bahaviour($result_data);
		//GET CA RESULT BASED ON CLASS (S.S.3 EXAM RESULT SHEET IS DIFFERENT FROM OTHER CLASSES LIKE J.S.S.1-S.S.2)
		if(preg_match("/^S.S.3/", $result_data['CLASS'])){
			$data['exam_result']=$this->student_model->fetch_exam_resultSenior($result_data);
			$this->load->view('result/examSenior',$data); //USE S.S.3 EXAM RESULT SHEET
		}
		else{
			switch ($result_data['TERM']) {
				case '1':
					$data['exam_result']=$this->student_model->fetch_exam_result($result_data); 
					$this->load->view('result/examJuniorfirstterm', $data); //USE J.S.S.1-S.S.2 FIRST TERM EXAM RESULT SHEET

					break;
				case '2':
					$data['exam_result']=$this->student_model->fetch_exam_result($result_data);
					$this->load->view('result/examJuniorSecondterm', $data); //USE J.S.S.1-S.S.2 SECOND TERM EXAM RESULT SHEET
					break;
				case '3':
					$data['exam_result']=$this->student_model->fetch_exam_result($result_data);
					$this->load->view('result/examJuniorThirdterm', $data); //USE J.S.S.1-S.S.2 THIRD TERM EXAM RESULT SHEET
					break;
			}
		}
	}


	//=============================================
	//=============================================
	//----------------RESOURCES-----------------------
	//=============================================
	//=============================================

	//RESULT PAGE
	public function my_resources($id){
		$this->verify();
		$data['title']="Learning Resources";
		$data['student_info']=$this->student_model->fetch_student_info($_SESSION['username']);
		$data['category']=$this->student_model->fetch_rescources_cat();
		 
			$this->load->view('parts/head', $data);
			if($id=='category'){
				$this->load->view('resources/resources', $data);
			}
			elseif(is_numeric($id)){
				$data['category']=$this->student_model->fetch_resources($id);
				$this->load->view('resources/category', $data);
			}
			else{
				$this->logout();
				redirect($this->index());
			}
			$this->load->view('parts/javascript', $data);
	}



	
	//=============================================
	//=============================================
	//----------------PROFILE-----------------------
	//=============================================
	//=============================================

	public function profile(){
		$this->verify();
		$data['title']="My Profile";
		$data['student_info']=$this->student_model->fetch_student_info($_SESSION['username']);
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
			if($this->student_model->update_password($password)){
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
		$student_info=$this->student_model->fetch_student_info($_SESSION['username']);

		if($_SESSION['password']===md5(strtolower($student_info->SURNAME))){
			return true;
		}

	}
	

	  
}
