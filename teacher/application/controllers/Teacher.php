<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('teacher_model');  
        require('../assets/inc/function.php');
    }

    //VERIFY USER
    public function verify(){
    	if(is_null($this->session->userdata('username')) && is_null($this->session->userdata('password'))){
			redirect(base_url());
		}
		else{
			if($this->teacher_model->verify_admin($this->session->userdata('username'),$this->session->userdata('password'))==false){
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
			if($this->teacher_model->process_login($username, $password)){
				$teacher=$this->teacher_model->process_login($username, $password);
				foreach ($teacher as $teacher) {
					$teacher_id=$teacher->TEACHER_ID;
					$teacher_name=$teacher->NAME;
					$username=$teacher->USERNAME;
					$password=$teacher->PASSWORD;
					$classes=$teacher->CLASS_ID;
					$subject=$teacher->SUBJECT;
					$email=$teacher->EMAIL;
					$phone=$teacher->PHONE;
				}
				//COMMIT TEACHER INFO TO MEMORY
				$session_data=array(
					'username' => $username, 
					'password' => $password, 
					'teacher_id'=>$teacher_id, 
					'teacher_name'=>$teacher_name,
					'classes'=>$classes,
					'subject'=>$subject,
					'email'=>$email,
					'phone'=>$phone
				);
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
		$this->session->unset_userdata('teacher_id');
		$this->session->unset_userdata('teacher_name');
		$this->session->unset_userdata('classes');
		$this->session->unset_userdata('subject');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('phone');
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
		$this->load->view('parts/head', $data);
		$this->load->view('dashboard', $data);
		$this->load->view('parts/javascript', $data);
	}

	//==================
	//=================
	//----STUDENTS-----
	//=================
	//=================

	//STUDENTS
	public function students(){
		$this->verify();
		if($_SESSION['classes']){
            $class=explode(',', $_SESSION['classes']);
            $class_list='';
            foreach ($class as $class) {
            	$class_list.="<option value='".$this->teacher_model->get_class_name($class)->CLASS."'>".$this->teacher_model->get_class_name($class)->CLASS."</option>";                        
            }
        }
		$data['classes']=$class_list;
		$data['title']="Students";
		$this->load->view('parts/head', $data);
		$this->load->view('students/students', $data);
		$this->load->view('parts/javascript', $data);
	}

	//SEARCH STUDENT RECORD USING ADMISSION NUMBER OR NAMES
	public function search_student(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('search', "Search", 'trim|required');
		if($this->form_validation->run()){
			$data['search_result']=$this->teacher_model->search_student($this->input->post('search'));
			$this->load->view('students/searchResult', $data);
			
		}
		else{
			form_error('search');
		}
	}

	//FETCH STUDENT INFORMATION
	public function student($student_no){
		$student_no=str_replace('_', '/', $student_no);
		$this->verify();
		$data['title']="Student's Profile";
		$data['student_info']=$this->teacher_model->get_student_info($student_no);
		$this->load->view('parts/head', $data);
		$this->load->view('students/studentprofile', $data);
		$this->load->view('parts/javascript', $data);
	}

	//==================
	//=================
	//----PROFILE-----
	//=================
	//=================

	public function profile(){
		$this->verify();
		$data['title']="My Profile";
		$this->load->view('parts/head', $data);
		$this->load->view('profile', $data);
		$this->load->view('parts/javascript', $data);
	}


	//UPDATE LOGIN DETAILS
	public function update_login(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', "Username", 'trim|required');
		$this->form_validation->set_rules('password', "Password", 'trim|required');
		if($this->form_validation->run()){
			$login_info=array(
				'USERNAME'=> trim(strtolower($this->input->post('username'))),
				'PASSWORD'=>md5(strtolower($this->input->post('password'))),
				'TEACHER_ID'=>$_SESSION['teacher_id']
			);
			if($this->teacher_model->update_login_info($login_info)){
				$_SESSION['username']=$login_info['USERNAME'];
				$_SESSION['password']=$login_info['PASSWORD'];

				$this->session->set_flashdata('message', "Your login details has been updated");
			}

			
		}
		else{
			$error="";
			if(form_error('username')){
				$error.=form_error('username');
			}

			if(form_error('password')){
				$error.=form_error('password');
			}
			$this->session->set_flashdata('message', $error);
		}
		redirect('/profile');
	}

	//UPDATE INFORMATION DETAILS
	public function update_information(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', "Name", 'trim|required');
		$this->form_validation->set_rules('email', "Email", 'trim|valid_email');
		$this->form_validation->set_rules('phone', "phone", 'trim|numeric');
		if($this->form_validation->run()){
			$info=array(
				'NAME'=> trim(ucwords($this->input->post('name'))),
				'EMAIL'=>trim($this->input->post('email')),
				'PHONE'=>trim($this->input->post('phone'))
			);
			if($this->teacher_model->update_info($info)){
				$_SESSION['teacher_name']=$info['NAME'];
				$_SESSION['email']=$info['EMAIL'];
				$_SESSION['phone']=$info['PHONE'];
				$this->session->set_flashdata('message', "Your information has been updated");
			}
		}
		else{
			$error="";
			if(form_error('name')){
				$error.=form_error('name');
			}

			if(form_error('email')){
				$error.=form_error('email');
			}

			if(form_error('phone')){
				$error.=form_error('phone');
			}
			$this->session->set_flashdata('message', $error);
		}
		redirect('/profile');
	}

	//==================
	//=================
	//----RESULT-----
	//=================
	//=================

	public function scores(){
		$this->verify();
		$data['title']="Result";
		if($_SESSION['subject']){
            $subject=explode(',', $_SESSION['subject']);
            $subject_list='';
            foreach ($subject as $subjects) {
            	$subject_list.="<option value='$subjects'>". $this->teacher_model->get_subject_name($subjects)->SUBJECT."</option>"; 
            }
        }

        if($_SESSION['classes']){
            $class=explode(',', $_SESSION['classes']);
            $class_list='';
            foreach ($class as $class) {
            	$class_list.="<option value='".$this->teacher_model->get_class_name($class)->CLASS."'>".$this->teacher_model->get_class_name($class)->CLASS."</option>";                        
            }
        }

		$data['subjects']=$subject_list;
		$data['classes']=$class_list;
		$this->load->view('parts/head', $data);
		$this->load->view('result/scores', $data);
		$this->load->view('parts/javascript', $data);
	}


	//FETCH STUDENT LIST [TO BE USED IN SELECT2 PLUGIN]
	public function get_students_list_select(){
		$this->verify();
		$students=$this->teacher_model->getStudentlistSELECT2($_GET['search']);
		foreach ($students as $key => $value) {
			$data[] = array('id' => $value['ADMISSION_NUMBER'], 'text' => $value['NAME']);			 	
   		}
		echo json_encode($data);
	}

	//GET PROMOTION LIST
	public function get_promotion_list(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('presentClass', 'Present Class', 'trim|required');
		$this->form_validation->set_rules('promoteClass', 'Class Promote to', 'trim|required');
		if($this->form_validation->run()){
			$data['students']=$this->teacher_model->promotion_list($this->input->post('presentClass'));
			$this->load->view('result/promotionlist', $data);
			
		}
	}

	//PROMOTE STUDENTS
	public function promote_students(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('promoteClass', 'Class Promote to', 'trim|required');
		if($this->form_validation->run()){
			for ($i=0; $i <count($this->input->post('student')); $i++) { 
				$promote=array(
					'ADMISSION_NUMBER'=>$_POST['student'][$i],
					'PROMOTE_CLASS'=>$this->input->post('promoteClass')
				);
				$this->teacher_model->PromoteStudent($promote);
			}
			$this->session->set_flashdata('message', "Students has been promoted");
			redirect('/result');
		}
	}


	//================
	//===============
	//BEHAIVOURAL REPORT
	//==================
	//==================

	//GET STUDENT LIST FOR BEHAIVOURAL REPORT
	public function getListforBehaivour(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('term', 'Term', 'trim|numeric|required');
		$this->form_validation->set_rules('session', 'Session', 'trim|required');
		$this->form_validation->set_rules('class', 'Class', 'trim|required');
		
		if($this->form_validation->run()){
			$list_data=array(
				'TERM'=>$this->input->post('term'),
				'CLASS'=>$this->input->post('class'),
				'SESSION'=>$this->input->post('session')
			);
			$data['students']=$this->teacher_model->getStudentlist_for_behaivour($list_data);
			$this->load->view('result/studentlist2', $data);	
		}
	}

	//SUBMIT BEHAIVOUR REPORT
	public function process_behaivour_report(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('term', 'Term', 'trim|numeric|required');
		$this->form_validation->set_rules('session', 'Session', 'trim|required');
		$this->form_validation->set_rules('class', 'Class', 'trim|required');

		if($this->form_validation->run()){
			for ($i=0; $i <count($this->input->post('REGNO')) ; $i++) { 
				$report_data=array(
					'STUDENT_NUMBER'=>$_POST['REGNO'][$i],
					'TERM'=>$this->input->post('term'),
					'SESSION'=>$this->input->post('session'),
					'CLASS'=>$this->input->post('class'),
					'NO_SCHOOL'=>$this->input->post('SCHOOL_OPENED'),
					'NO_PRESENT'=>trim($_POST['PRESENT'][$i]),
					'NO_ABSENT'=>$this->input->post('SCHOOL_OPENED')-trim($_POST['PRESENT'][$i]),
					'RESUMPTION_DATE'=>$this->input->post('DATE_RESUMPTION'),
					'NEATNESS'=>$_POST['neatness'][$i],
					'ATTITUDE'=>$_POST['attitude'][$i],
					'ATTENTION'=>$_POST['attentive'][$i],
					'FLUENCY'=>$_POST['fluency'][$i],
					'WRITING'=>$_POST['writing'][$i],
					'HONESTY'=>$_POST['honesty'][$i]
				);
				$this->teacher_model->processBehaivourReport($report_data);

			}

			$this->session->set_flashdata('message', "Behavioural Reports has been submitted");
			redirect('/result');
		}
	}


	//FETCH STUDENTLIST
	public function fetch_studentlist(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('type', 'Type', 'trim|required');
		$this->form_validation->set_rules('class', 'Class', 'trim|required');
		$this->form_validation->set_rules('term', 'Term', 'trim|required|numeric');
		$this->form_validation->set_rules('session', 'Session', 'trim|required');
		if($this->form_validation->run()){
			$data['students']=$this->teacher_model->fetch_student_list($this->input->post('class'));
			$this->load->view('result/studentList', $data);
		}
		else{
			$error="";
			if(form_error('type')){
				$error.=form_error('type');
			}
			if(form_error('class')){
				$error.=form_error('class');
			}
			if(form_error('term')){
				$error.=form_error('term');
			}
			if(form_error('session')){
				$error.=form_error('session');
			}
			$this->session->set_flashdata('message', $error);
			redirect('/result');
		}	
	}

	//GENERATE REPORT SHEET
	public function reportsheet($regNo,$class,$type,$term,$session){
		$type=$type;

		$result_data=array(
			'SESSION'=>str_replace("_", '/', $session),
			'TERM'=> $term,
			'CLASS'=> $class,
			'STUDENT_NUMBER'=>str_replace("_", '/', $regNo)
		);

		if($type=="CA"){
			$this->getCA($result_data);
		}
		else{
			$this->getExam($result_data);
		}
	}

	//GET CA RESULT
	public function getCA($result_data){
		
		$data['student_info']=$this->teacher_model->fetch_student_info($result_data['STUDENT_NUMBER']);
		$data['comments']=$this->teacher_model->fetch_comments($result_data);
		$data['result_data']=$result_data;
		//GET CA RESULT BASED ON CLASS (S.S.3 CA RESULT SHEET IS DIFFERENT FROM OTHER CLASSES LIKE J.S.S.1-S.S.2)
		if(preg_match("/^S.S.3/", $result_data['CLASS'])){
			$data['ca_result']=$this->teacher_model->fetch_ca_resultSenior($result_data);
			$this->load->view('result/ca_senior',$data); //USE S.S.3 CA RESULT SHEET
		}
		else{
			$data['ca_result']=$this->teacher_model->fetch_ca_result($result_data);
			$this->load->view('result/ca_junior',$data); //USE CA RESULT SHEET FOR J.S.S.1-S.S.2
		}
	}

	//GET EXAM RESULT
	public function getExam($result_data){

		$data['student_info']=$this->teacher_model->fetch_student_info($result_data['STUDENT_NUMBER']);
		$data['comments']=$this->teacher_model->fetch_comments($result_data);
		$data['behaviour']=$this->teacher_model->fetch_bahaviour($result_data);
		$data['result_data']=$result_data;
		//GET CA RESULT BASED ON CLASS (S.S.3 EXAM RESULT SHEET IS DIFFERENT FROM OTHER CLASSES LIKE J.S.S.1-S.S.2)
		if(preg_match("/^S.S.3/", $result_data['CLASS'])){
			$data['exam_result']=$this->teacher_model->fetch_exam_resultSenior($result_data);
			$this->load->view('result/examSenior',$data); //USE S.S.3 EXAM RESULT SHEET
		}
		else{
			switch ($result_data['TERM']) {
				case '1':
					$data['exam_result']=$this->teacher_model->fetch_exam_result($result_data); 
					$this->load->view('result/examJuniorfirstterm', $data); //USE J.S.S.1-S.S.2 FIRST TERM EXAM RESULT SHEET
					break;
				case '2':
					$data['exam_result']=$this->teacher_model->fetch_exam_result($result_data);
					$this->load->view('result/examJuniorSecondterm', $data); //USE J.S.S.1-S.S.2 SECOND TERM EXAM RESULT SHEET
					break;
				case '3':
					$data['exam_result']=$this->teacher_model->fetch_exam_result($result_data);
					$this->load->view('result/examJuniorThirdterm', $data); //USE J.S.S.1-S.S.2 THIRD TERM EXAM RESULT SHEET
					break;
			}
		}
	}

	//ADD TEACHER CA COMMMENT
	public function add_teacher_ca_comment(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('term', 'Term', 'trim|numeric|required');
		$this->form_validation->set_rules('session', 'Session', 'trim|required');
		$this->form_validation->set_rules('class', 'Class', 'trim|required');
		$this->form_validation->set_rules('regNo', 'Registration Number', 'trim|required');
		$this->form_validation->set_rules('comment_id', 'Comment ID');
		$this->form_validation->set_rules('comment', 'Comment', 'trim|required');
		if($this->form_validation->run()){
			$comment_data=array(
				'STUDENT_NUMBER'=>$this->input->post('regNo'),
				'TERM'=>$this->input->post('term'),
				'SESSION'=>$this->input->post('session'),
				'CLASS'=>$this->input->post('class'),
				'ID'=>$this->input->post('comment_id'),
				'TEACHER_CA'=>trim($this->input->post('comment')),
				'TEACHER_CA_DATE'=>date('F d, Y')
			);
			if($this->teacher_model->add_teacher_comment($comment_data)){
				$this->session->set_flashdata('message', "Teacher's comment has been added");
			}
			else{
				$this->session->set_flashdata('message', "There is a problem adding Teacher's comment");
			}
			  $type='CA';
			  $session=str_replace('/', '_', $this->input->post('session'));
			  $term=$this->input->post('term');
			  $class=$this->input->post('class');
			  $regno=str_replace('/', '_', $this->input->post('regNo'));
    		  $URL='reportsheet/'.$regno.'/'.$class.'/'.$type.'/'.$term.'/'.$session;
		 	  redirect('/'.$URL);
		}
	}

	//ADD TEACHER CA COMMMENT
	public function add_teacher_exam_comment(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('term', 'Term', 'trim|numeric|required');
		$this->form_validation->set_rules('session', 'Session', 'trim|required');
		$this->form_validation->set_rules('class', 'Class', 'trim|required');
		$this->form_validation->set_rules('regNo', 'Registration Number', 'trim|required');
		$this->form_validation->set_rules('comment_id', 'Comment ID');
		$this->form_validation->set_rules('comment', 'Comment', 'trim|required');
		if($this->form_validation->run()){
			$comment_data=array(
				'STUDENT_NUMBER'=>$this->input->post('regNo'),
				'TERM'=>$this->input->post('term'),
				'SESSION'=>$this->input->post('session'),
				'CLASS'=>$this->input->post('class'),
				'ID'=>$this->input->post('comment_id'),
				'TEACHER_EXAM'=>trim($this->input->post('comment')),
				'TEACHER_EXAM_DATE'=>date('F d, Y')
			);
			if($this->teacher_model->add_teacher_exam_comment($comment_data)){
				$this->session->set_flashdata('message', "Teacher's comment has been added");
			}
			else{
				$this->session->set_flashdata('message', "There is a problem adding Teacher's comment");
			}
			  $type='EXAM';
			  $session=str_replace('/', '_', $this->input->post('session'));
			  $term=$this->input->post('term');
			  $class=$this->input->post('class');
			  $regno=str_replace('/', '_', $this->input->post('regNo'));
    		  $URL='reportsheet/'.$regno.'/'.$class.'/'.$type.'/'.$term.'/'.$session;
		 	  redirect('/'.$URL);
		}
	}

	//EDIT TEACHER CA COMMENT
	public function edit_teacher_ca_comment(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('term', 'Term', 'trim|numeric|required');
		$this->form_validation->set_rules('session', 'Session', 'trim|required');
		$this->form_validation->set_rules('class', 'Class', 'trim|required');
		$this->form_validation->set_rules('regNo', 'Registration Number', 'trim|required');
		$this->form_validation->set_rules('comment_id', 'Comment ID', 'trim|required|numeric');
		$this->form_validation->set_rules('comment', 'Comment', 'trim|required');
		if($this->form_validation->run()){
			$comment_data=array(
				'ID'=>$this->input->post('comment_id'),
				'TEACHER_CA'=>trim($this->input->post('comment')),
			);
			if($this->teacher_model->edit_teacher_comment($comment_data)){
				$this->session->set_flashdata('message', "Teacher's comment has been updated");
			}
			else{
				$this->session->set_flashdata('message', "There is a problem updating Teacher's comment");
			}
			  $type='CA';
			  $session=str_replace('/', '_', $this->input->post('session'));
			  $term=$this->input->post('term');
			  $class=$this->input->post('class');
			  $regno=str_replace('/', '_', $this->input->post('regNo'));
    		  $URL='reportsheet/'.$regno.'/'.$class.'/'.$type.'/'.$term.'/'.$session;
		 	  redirect('/'.$URL);
		}
	}

	//EDIT TEACHER EXAM COMMENT
	public function edit_teacher_exam_comment(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('term', 'Term', 'trim|numeric|required');
		$this->form_validation->set_rules('session', 'Session', 'trim|required');
		$this->form_validation->set_rules('class', 'Class', 'trim|required');
		$this->form_validation->set_rules('regNo', 'Registration Number', 'trim|required');
		$this->form_validation->set_rules('comment_id', 'Comment ID', 'trim|required|numeric');
		$this->form_validation->set_rules('comment', 'Comment', 'trim|required');
		if($this->form_validation->run()){
			$comment_data=array(
				'ID'=>$this->input->post('comment_id'),
				'TEACHER_EXAM'=>trim($this->input->post('comment')),
			);
			if($this->teacher_model->edit_teacher_exam_comment($comment_data)){
				$this->session->set_flashdata('message', "Teacher's comment has been updated");
			}
			else{
				$this->session->set_flashdata('message', "There is a problem updating Teacher's comment");
			}
			  $type='EXAM';
			  $session=str_replace('/', '_', $this->input->post('session'));
			  $term=$this->input->post('term');
			  $class=$this->input->post('class');
			  $regno=str_replace('/', '_', $this->input->post('regNo'));
    		  $URL='reportsheet/'.$regno.'/'.$class.'/'.$type.'/'.$term.'/'.$session;
		 	  redirect('/'.$URL);
		}
	}

	//FETCH GRADE LIST FOR SPECIFIED SUBJECT, SESSION, TERM AND CLASS
	public function fetch_grade_list(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required');
		$this->form_validation->set_rules('class', 'Class', 'trim|required');
		$this->form_validation->set_rules('term', 'Term', 'trim|required|numeric');
		$this->form_validation->set_rules('session', 'Session', 'trim|required');
		if($this->form_validation->run()){
			$result_data=array(
				'SUBJECT'=>$this->input->post('subject'),
				'CLASS'=>$this->input->post('class'),
				'TERM'=>$this->input->post('term'),
				'SESSION'=>$this->input->post('session')
			);
			$data['grade_list']=$this->teacher_model->fetch_grade_list($result_data);
			$this->load->view('result/gradelist', $data);
		}
		else{
			$error="";
			if(form_error('subject')){
				$error.=form_error('subject');
			}
			if(form_error('class')){
				$error.=form_error('class');
			}
			if(form_error('term')){
				$error.=form_error('term');
			}
			if(form_error('session')){
				$error.=form_error('session');
			}
			$this->session->set_flashdata('message', $error);
			redirect('/result');
		}	
	}

	//FETCH SCORE DETAIL
	public function fetch_score_detail(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('score_id', 'Score Id', 'trim|required|numeric');
		if($this->form_validation->run()){
			$data['score_info']=$this->teacher_model->fetch_score_info($this->input->post('score_id'));
			$this->load->view('result/scoreInfo', $data);
		}
		else{
			$error="";
			if(form_error('score_id')){
				$error.=form_error('score_id');
			}
		}	
	}

	//DELETE SCORE
	public function delete_score(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('score_id', 'Score Id', 'trim|required|numeric');
		if($this->form_validation->run()){
			if($this->teacher_model->delete_score($this->input->post('score_id'))){
				echo"Score has been deleted";
			}
			else{
				echo "There is a problem deleting Score";
			}
		
		}
		else{
			$error="";
			if(form_error('score_id')){
				$error.=form_error('score_id');
			}
		}	
	}

	//UPDATE SCORE INFO
	public function update_score_info(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('exam', 'Exam Score', 'trim');
		$this->form_validation->set_rules('ca1', 'First CA Score', 'trim');
		$this->form_validation->set_rules('ca2', 'Second CA Score', 'trim');
		$this->form_validation->set_rules('ca3', 'Third CA Score', 'trim');
		if($this->form_validation->run()){

			if(empty($this->input->post('exam'))){
				$exam_score=null;
			}
			else{
				$exam_score=$this->input->post('exam');
			}

			if(empty($this->input->post('ca1'))){
				$ca1=null;
			}
			else{
				$ca1=$this->input->post('ca1');
			}

			if(empty($this->input->post('ca2'))){
				$ca2=null;
			}
			else{
				$ca2=$this->input->post('ca2');
			}

			if(empty($this->input->post('ca3'))){
				$ca3=null;
			}
			else{
				$ca3=$this->input->post('ca3');
			}

			$score_info=array(
				'EXAM'=>$exam_score,
				'CA1'=>$ca1,
				'CA2'=>$ca2,
				'CA3'=>$ca3,
				'SCORE_ID'=>$this->input->post('score_id')
			);
			if($this->teacher_model->update_score($score_info)){
				echo"<h1 class='text-center'>Score has been updated</h1>";
			}
			else{
				echo"<h1 class='text-center'>There is a problem updating score</h1>";
			}
		
		}
		else{
			
			if(form_error('exam')){
				echo form_error('exam');
			}
			if(form_error('ca1')){
				echo form_error('ca1');
			}
			if(form_error('ca2')){
				echo form_error('ca2');
			}
			if(form_error('ca3')){
				echo form_error('ca3');
			}
		}	
	}



	//GET STUDENT LIST FOR SCORES ENTRY
	public function getListforscoresEntry(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('term', 'Term', 'trim|numeric|required');
		$this->form_validation->set_rules('session', 'Session', 'trim|required');
		$this->form_validation->set_rules('class', 'Class', 'trim|required');
		$this->form_validation->set_rules('scoreType', 'Scores Type', 'trim|required');
		$this->form_validation->set_rules('subject', 'Subjects', 'trim|required|numeric');
		if($this->form_validation->run()){
			$list_data=array(
				'TERM'=>$this->input->post('term'),
				'CLASS'=>$this->input->post('class'),
				'SESSION'=>$this->input->post('session'),
				'SUBJECT_ID'=>$this->input->post('subject')
			);
			$data['students']=$this->teacher_model->getStudentlist_for_scoresentry($list_data, $this->input->post('scoreType'));
			$this->load->view('result/ScoreEntry', $data);	
		}
	}

	//PROCESS EXAM SCORES ENTRY FORM
	public function process_EXAMscores(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('term', 'Term', 'trim|numeric|required');
		$this->form_validation->set_rules('session', 'Session', 'trim|required');
		$this->form_validation->set_rules('class', 'Class', 'trim|required');
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required|numeric');
		if($this->form_validation->run()){
			for ($i=0; $i <count($this->input->post('REGNO')) ; $i++) { 

				//USE THIS FOR SS3 STUDENTS
				if(preg_match("/^S.S.3/", $_POST["class"])){
					if($_POST['EXAM'][$i]==""){
						continue;
					}
					$report_data=array(
						'SUBJECT_ID'=>$this->input->post('subject'),
						'STUDENT_NUMBER'=>$_POST['REGNO'][$i],
						'TERM'=>$this->input->post('term'),
						'SESSION'=>$this->input->post('session'),
						'CLASS'=>$this->input->post('class'),
						'EXAM'=>$_POST['EXAM'][$i]
					);
					$this->teacher_model->processSENIOREXAMscores($report_data);
				}
				else{
					if($_POST['CA3'][$i]=="" && $_POST['EXAM'][$i]==""){
						continue;
					}
					$report_data=array(
						'SUBJECT_ID'=>$this->input->post('subject'),
						'STUDENT_NUMBER'=>$_POST['REGNO'][$i],
						'TERM'=>$this->input->post('term'),
						'SESSION'=>$this->input->post('session'),
						'CLASS'=>$this->input->post('class'),
						'CA3'=>$_POST['CA3'][$i],
						'EXAM'=>$_POST['EXAM'][$i]
					);
					$this->teacher_model->processJUNIOREXAMscores($report_data);
				}
			}
			$this->session->set_flashdata('message', "Scores has been entered");
			redirect('/result');
		}
	}

	//PROCESS CA SCORES ENTRY FORM
	public function process_CAscores(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('term', 'Term', 'trim|numeric|required');
		$this->form_validation->set_rules('session', 'Session', 'trim|required');
		$this->form_validation->set_rules('class', 'Class', 'trim|required');
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required|numeric');
		if($this->form_validation->run()){
			for ($i=0; $i <count($this->input->post('REGNO')); $i++) { 
				
				//USE THIS FOR SS3 STUDENTS
				if(preg_match("/^S.S.3/", $_POST["class"])){
					if($_POST['SCORE'][$i]==""){continue;}
					$report_data=array(
						'SUBJECT_ID'=>$this->input->post('subject'),
						'STUDENT_NUMBER'=>$_POST['REGNO'][$i],
						'TERM'=>$this->input->post('term'),
						'SESSION'=>$this->input->post('session'),
						'CLASS'=>$this->input->post('class'),
						'CA1'=>$_POST['SCORE'][$i],
					);
				}
				else{
					if($_POST['CA1'][$i]=="" && $_POST['CA2'][$i]==""){continue;}
					$report_data=array(
						'SUBJECT_ID'=>$this->input->post('subject'),
						'STUDENT_NUMBER'=>$_POST['REGNO'][$i],
						'TERM'=>$this->input->post('term'),
						'SESSION'=>$this->input->post('session'),
						'CLASS'=>$this->input->post('class'),
						'CA1'=>$_POST['CA1'][$i],
						'CA2'=>$_POST['CA2'][$i]
					);
				}
				$this->teacher_model->processCAscores($report_data);
			}
			$this->session->set_flashdata('message', "Scores has been entered");
			redirect('/result');
		}
	}
	//PROCESS SINGLE SCORE
	public function process_singleScore(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('term', 'Term', 'trim|numeric|required');
		$this->form_validation->set_rules('session', 'Session', 'trim|required');
		$this->form_validation->set_rules('class', 'Class', 'trim|required');
		$this->form_validation->set_rules('regNo', 'Registration Number', 'trim|required');
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required|numeric');
		$this->form_validation->set_rules('scoreType', 'Subject', 'trim|required');
		if($this->form_validation->run()){
			
				if($this->input->post('scoreType')=="CA"){
					//USE THIS TO PROCESS SS3 CA SCORE
					if(preg_match("/^S.S.3/", $_POST["class"])){
						$report_data=array(
							'SUBJECT_ID'=>$this->input->post('subject'),
							'STUDENT_NUMBER'=>$this->input->post('regNo'),
							'TERM'=>$this->input->post('term'),
							'SESSION'=>$this->input->post('session'),
							'CLASS'=>$this->input->post('class'),
							'CA1'=>$this->input->post('CA1')
						);
						if($this->teacher_model->processSingleSeniorCAscores($report_data)){
							$this->session->set_flashdata('message', "Scores has been entered");
						}
						else{
							$this->session->set_flashdata('message', "Scores has been entered before");
						}
					}
					else{
						$report_data=array(
							'SUBJECT_ID'=>$this->input->post('subject'),
							'STUDENT_NUMBER'=>$this->input->post('regNo'),
							'TERM'=>$this->input->post('term'),
							'SESSION'=>$this->input->post('session'),
							'CLASS'=>$this->input->post('class'),
							'CA1'=>$this->input->post('CA1'),
							'CA2'=>$this->input->post('CA2')
						);
						if($this->teacher_model->processSingleJuniorCAscores($report_data)){
							$this->session->set_flashdata('message', "Scores has been entered");
						}
						else{
							$this->session->set_flashdata('message', "Scores has been entered before");
						}
					}
				}
				else{
					if(preg_match("/^S.S.3/", $_POST["class"])){
						$report_data=array(
							'SUBJECT_ID'=>$this->input->post('subject'),
							'STUDENT_NUMBER'=>$this->input->post('regNo'),
							'TERM'=>$this->input->post('term'),
							'SESSION'=>$this->input->post('session'),
							'CLASS'=>$this->input->post('class'),
							'EXAM'=>$this->input->post('EXAM')
						);
						if($this->teacher_model->processSingleSENIOREXAMscores($report_data)){
							$this->session->set_flashdata('message', "Scores has been entered");
						}
						else{
							$this->session->set_flashdata('message', "Scores has been entered before");
						}
					}
					else{
						$report_data=array(
							'SUBJECT_ID'=>$this->input->post('subject'),
							'STUDENT_NUMBER'=>$this->input->post('regNo'),
							'TERM'=>$this->input->post('term'),
							'SESSION'=>$this->input->post('session'),
							'CLASS'=>$this->input->post('class'),
							'CA3'=>$this->input->post('CA3'),
							'EXAM'=>$this->input->post('EXAM')
						);
						if($this->teacher_model->processSingleJUNIOREXAMscores($report_data)){
							$this->session->set_flashdata('message', "Scores has been entered");
						}
						else{
							$this->session->set_flashdata('message', "Scores has been entered before");
						}
					}
				}
			redirect('/result');
		}
		
	}

	//GENERATE STUDENT LIST PER CLASS
	public function generate_student_list(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('class', 'Class', 'trim|required');
		if($this->form_validation->run()){
			
			$data['students']=$this->teacher_model->get_student_list_class($this->input->post('class'));

			$this->load->view('students/studentList', $data);
							
		}
	}


	 
}
