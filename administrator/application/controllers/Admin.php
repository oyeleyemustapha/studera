<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('admin_model');  
        require('../assets/inc/function.php');
    }

    //VERIFY USER FOR SECURITY PURPOSES
    public function verify(){
    	if(is_null($this->session->userdata('username')) && is_null($this->session->userdata('password'))){
			redirect(base_url());
		}
		else{
			if($this->admin_model->verify_user($this->session->userdata('username'),$this->session->userdata('password'))==false){
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
			if($this->admin_model->process_login($username, $password)){
				$administrator=$this->admin_model->process_login($username, $password);
				foreach ($administrator as $administrator) {
					$admin_id=$administrator->ADMIN_ID;
					$username=$administrator->USERNAME;
					$password=$administrator->PASSWORD;
					$name=$administrator->NAME;
				}
				
				$session_data=array('username' => $username, 'password' => $password, 'admin_id'=>$admin_id, 'name'=> $name);
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
	
		if($this->admin_model->fetch_teachers_list()){
			$data['no_teachers']=count($this->admin_model->fetch_teachers_list());
		}
		else{
			$data['no_teachers']=0;
		}
		$data['no_active_students']=$this->admin_model->no_of_student();
		$this->load->view('parts/head', $data);
		$this->load->view('dashboard', $data);
		$this->load->view('parts/javascript', $data);
	}

	
	//=============================================
	//=============================================
	//----------------CLASS-----------------------
	//=============================================
	//=============================================

	
	public function classes(){
		$this->verify();
		$data['title']="Class";
		$data['class_list']=$this->admin_model->get_classes();
		$data['teachers']=$this->admin_model->fetch_teachers_list();
		$this->load->view('parts/head', $data);
		$this->load->view('class/class', $data);
		$this->load->view('parts/javascript', $data);
	}


	//ADD NEW CLASS
	public function add_class(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('class', "Class", 'trim|required|is_unique[class.CLASS]', array('is_unique' => 'Class has been added before'));
		if($this->form_validation->run()){
			$class_info=array(
				'CLASS'=>strtoupper($this->input->post('class'))
			);

			if($this->admin_model->add_class($class_info)){
				$this->session->set_flashdata('message', 'Class has been added');
				redirect('/class');
			}
			else{
				$this->session->set_flashdata('message', 'There is a problem adding New class');
				redirect('/class');
			}
		}
		else{
			if(form_error('class')){
				$this->session->set_flashdata('message', form_error('class'));
				redirect('/class');
			}
		}
	}

	//ASSIGN CLASS TO TEACHER
	public function assign_class(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('class', "Class", 'trim|required');
		$this->form_validation->set_rules('teacher', "Teacher", 'trim|required');
		if($this->form_validation->run()){
			$info=array(
				'class'=>$this->input->post('class'),
				'teacher'=>$this->input->post('teacher')
			);

			if($this->admin_model->assign_class($info)){
				$this->session->set_flashdata('message', 'Class has been assigned to a teacher successfully');
				redirect('/class');
			}
			else{
				$this->session->set_flashdata('message', 'There is a problem assigning class to a teacher');
				redirect('/class');
			}
		}
		else{
			$error="";
			if(form_error('class')){
				$error.=form_error('class')."<br>";
			}
			if(form_error('teacher')){
				$error.=form_error('teacher')."<br>";
			}
			$this->session->set_flashdata('message', $error);
				redirect('/class');
		}
	}


	//DELETE CLASS
	public function delete_class($class_id){
		if(is_numeric($class_id)){
			if($this->admin_model->delete_class($class_id)){
				$this->session->set_flashdata('message', 'Class has been deleted');
					redirect('/class');
			}
			else{
				$this->session->set_flashdata('message', 'There is an error deleting Class.');
					redirect('/class');
			}
		}
		else{
			redirect(base_url());
		}
	}


	//=============================================
	//=============================================
	//----------------SUBJECT-----------------------
	//=============================================
	//=============================================

	public function subjects($id='list'){
		$this->verify();
		$data['title']="Subjects";
		$data['subjects']=$this->admin_model->get_subjects();
		$this->load->view('parts/head', $data);
		$this->load->view('subjects/subjects', $data);
		$this->load->view('parts/javascript', $data);
	}


	//ADD NEW SUBJECT
	public function add_subject(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('subject', "Subject", 'trim|required|is_unique[subject.SUBJECT]', array('is_unique' => 'Subject has been added before'));
		if($this->form_validation->run()){
			$subject=array(
				'SUBJECT'=>ucwords(strtolower(trim($this->input->post('subject'))))
			);

			if($this->admin_model->add_subject($subject)){
				$this->session->set_flashdata('message', 'Subject has been added');
				redirect('/subjects');
			}
			else{
				$this->session->set_flashdata('message', 'There is a problem adding New Subject');
				redirect('/subjects');
			}
		}
		else{
			if(form_error('subject')){
				$this->session->set_flashdata('message', form_error('subject'));
				redirect('/subjects');
			}
		}
	}

	//DELETE SUBJECT
	public function delete_subject($subject_id){
		if(is_numeric($subject_id)){
			if($this->admin_model->delete_subject($subject_id)){
				$this->session->set_flashdata('message', 'Subject has been deleted');
					redirect('/subjects');
			}
			else{
				$this->session->set_flashdata('message', 'There is an error deleting Subject.');
					redirect('/subjects');
			}
		}
		else{
			redirect(base_url());
		}
	}


	//FETCH SUBJECT INFO
	public function fetch_subject_info(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('subject_id', "Subject ID", 'trim|required|numeric');
		if($this->form_validation->run()){
			$subject=$this->admin_model->fetch_subject_info($this->input->post('subject_id'));
			 echo "
			 		<form method='post' action='".base_url()."updateSubject'>
                            <div class='input-group'>
                            <input type='hidden' value='$subject->SUBJECT_ID' name='subject_id'>
                              <input type='text' class='form-control input-lg' value='$subject->SUBJECT' name='subject' placeholder='Subject' required>
                              <span class='input-group-btn input-group-lg'>
                                <button type='submit' class='btn btn-danger btn-lg'><i class='fa fa-pencil fa-fw'></i>Update</button>
                              </span>
                            </div>
                         </form>
			 ";
		}
		else{
			$this->session->set_flashdata('message', form_error('subject_id'));
			redirect('/subjects');
		}
	}


	//UPDATE SUBJECT
	public function update_subject(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('subject', "Subject", 'trim|required');
		$this->form_validation->set_rules('subject_id', "Subject ID", 'numeric|required');
		if($this->form_validation->run()){
			$subject_info=array(
				'SUBJECT'=>ucwords(strtolower(trim($this->input->post('subject')))),
				'SUBJECT_ID'=>$this->input->post('subject_id')
			);
			$update=$this->admin_model->update_subject($subject_info);

			if($update){
				$this->session->set_flashdata('message', 'Subject has been updated');
				redirect('/subjects');
			}
			else{
				$this->session->set_flashdata('message', 'There is a problem updating Subject');
				redirect('/subjects');
			}
		}
		else{
			if(form_error('subject')){
				$this->session->set_flashdata('message', form_error('subject'));
				redirect('/subjects');
			}
		}
	}


	//FETCH SUBEJCT LIST [TO BE USED IN SELECT2 PLUGIN]
	public function get_seubjects_list(){
		$this->verify();
		$subjects=$this->admin_model->fetch_subjects_list($_GET['search']);
		foreach ($subjects as $key => $value) {
			$data[] = array('id' => $value['SUBJECT_ID'], 'text' => $value['SUBJECT']);			 	
   		}
		echo $officers=json_encode($data);
	}



	//=============================================
	//=============================================
	//----------------TEACHERS--------------------
	//=============================================
	//=============================================

	public function teachers(){
		$this->verify();
		$data['title']="Teachers";
		$data['subjects']=$this->admin_model->get_subjects();
		$data['teachers']=$this->admin_model->fetch_teachers_list();
		$this->load->view('parts/head', $data);
		$this->load->view('teachers/teachers', $data);
		$this->load->view('parts/javascript', $data);
	}


	//ADD NEW TEACHER RECORD
	public function add_teacher(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required|numeric');
		$this->form_validation->set_rules('subject[]', 'Subject', 'trim|required');
		$this->form_validation->set_rules('username', "Username", 'trim|required|is_unique[teachers.USERNAME]', array('is_unique' => 'Username has been taken'));
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');
		if($this->form_validation->run()){
			$subject=implode(', ', $this->input->post('subject'));

			$teacher_info=array(
				'NAME'=>ucwords(strtolower($this->input->post('name'))),
				'EMAIL'=>trim($this->input->post('email')),
				'PHONE'=>trim($this->input->post('phone')),
				'SUBJECT'=>$subject,
				'USERNAME'=>strtolower($this->input->post('username')),
				'PASSWORD'=>md5(strtolower($this->input->post('password')))
			);

	
			if($this->admin_model->add_teacher($teacher_info)){
				$this->session->set_flashdata('message', 'Teacher Record has been created');
				redirect('/teachers');
			}
			else{
				$this->session->set_flashdata('message', 'There is a problem creating teacher record');
				redirect('/teachers');
			}
		}
		else{
			$error="";
			if(form_error('name')){
				$error.=form_error('name')."<br>";
			}

			if(form_error('email')){
				$error.=form_error('email')."<br>";
			}

			if(form_error('phone')){
				$error.=form_error('phone')."<br>";
			}

			if(form_error('subject[]')){
				$error.=form_error('subject[]')."<br>";
			}

			if(form_error('username')){
				$error.=form_error('username')."<br>";
			}

			if(form_error('password')){
				$error.=form_error('password')."<br>";
			}

			if(form_error('cpassword')){
				$error.=form_error('cpassword')."<br>";
			}

			$this->session->set_flashdata('message', $error);
			redirect('/teachers');
		}

	}


	//DELETE TEACHER
	public function delete_teacher($teacher_id){
		if(is_numeric($teacher_id)){
			if($this->admin_model->delete_teacher($teacher_id)){
				$this->session->set_flashdata('message', 'Teachers\' Record has been deleted');
					redirect('/teachers');
			}
			else{
				$this->session->set_flashdata('message', 'There is an error deleting Teacher\' Record');
					redirect('/teachers');
			}
		}
		else{
			redirect(base_url());
		}
	}


	//TEACHER PROFILE PAGE
	public function teacher($id=0){
		$this->verify();
		$data['title']="Teacher's Profile";
		$data['subjects']=$this->admin_model->get_subjects();
		$data['teacher_profile']=$this->admin_model->fetch_teacher_info($id);
		$this->load->view('parts/head', $data);
		$this->load->view('teachers/teacherprofile', $data);
		$this->load->view('parts/javascript', $data);
	}


	//UPDATE TEACHER INFORMATION
	public function update_teacher_info(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required|numeric');
		$this->form_validation->set_rules('subject[]', 'Subject', 'trim|required');
		if($this->form_validation->run()){
			$subject=implode(', ', $this->input->post('subject'));

			$teacher_info=array(
				'NAME'=>ucwords(strtolower($this->input->post('name'))),
				'EMAIL'=>trim($this->input->post('email')),
				'PHONE'=>trim($this->input->post('phone')),
				'SUBJECT'=>$subject,
				'TEACHER_ID'=>$this->input->post('teacher_id')
			);


			if($this->admin_model->update_teacher($teacher_info)){
				$this->session->set_flashdata('message', 'Teacher\'s Information has been updated');
				redirect('/teacher/'.$this->input->post('teacher_id'));
			}
			else{
				$this->session->set_flashdata('message', 'There is a problem updating Teacher\'s Information' );
				redirect('/teacher/'.$this->input->post('teacher_id'));
			}
		}
		else{
			$error="";
			if(form_error('name')){
				$error.=form_error('name')."<br>";
			}

			if(form_error('email')){
				$error.=form_error('email')."<br>";
			}

			if(form_error('phone')){
				$error.=form_error('phone')."<br>";
			}

			if(form_error('subject[]')){
				$error.=form_error('subject[]')."<br>";
			}

			$this->session->set_flashdata('message', $error);
			redirect('/teacher/'.$this->input->post('teacher_id'));
		}
	}

	//UPDATE TEACHER USERNAME AND PASSWORD 
	public function update_teacher_username(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', "Username", 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');
		if($this->form_validation->run()){
		
			$teacher_info=array(
				'USERNAME'=>strtolower($this->input->post('username')),
				'PASSWORD'=>md5(strtolower($this->input->post('password'))),
				'TEACHER_ID'=>$this->input->post('teacher_id')
			);

			if($this->admin_model->update_teacher_username($teacher_info)){
				$this->session->set_flashdata('message', 'Teacher\'s Username and Password has been updated');
				redirect('/teacher/'.$this->input->post('teacher_id'));
			}
			else{
				$this->session->set_flashdata('message', 'There is a problem updating Teacher\'s Username and Password' );
				redirect('/teacher/'.$this->input->post('teacher_id'));
			}
		}
		else{
			$error="";
			if(form_error('username')){
				$error.=form_error('username')."<br>";
			}

			if(form_error('password')){
				$error.=form_error('password')."<br>";
			}

			if(form_error('cpassword')){
				$error.=form_error('cpassword')."<br>";
			}

			$this->session->set_flashdata('message', $error);
			redirect('/teacher/'.$this->input->post('teacher_id'));
		}
	}


	//=============================================
	//=============================================
	//----------------STUDENTS--------------------
	//=============================================
	//=============================================

	public function students(){
		$this->verify();
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
			$data['search_result']=$this->admin_model->search_student($this->input->post('search'));
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
		$data['student_info']=$this->admin_model->get_student_info($student_no);
		$this->load->view('parts/head', $data);
		$this->load->view('students/studentprofile', $data);
		$this->load->view('parts/javascript', $data);
	}


	//UPDATE STUDENT ACCOUNT [ACTIVATE OR DEACTIVATE]
	public function student_account($action, $student_no){
			$student_number=str_replace('_', '/', $student_no);
			if($this->admin_model->student_account($action, $student_number)){

				if($action=="Active"){
					$this->session->set_flashdata('message', 'Student\'s Account has been activated');
				}
				else{
					$this->session->set_flashdata('message', 'Student\'s Account has been deactivated');
				}
				
					redirect('/student/'.$student_no);
			}
			else{
				$this->session->set_flashdata('message', 'There is an error updating Student\'s Account');
					redirect('/student/'.$student_no);
			}		
	}


	//EDIT STUDENT LOGIN PASSWORD
	public function change_student_login_password(){
		$this->verify();
		$student_no=str_replace('/', '_', $this->input->post('studentNumber'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');
		if($this->form_validation->run()){

			$password_data=array(
				'USERNAME'=>strtoupper($this->input->post('studentNumber')),
				'PASSWORD'=>md5(strtolower($this->input->post('password'))),
			);
			

			if($this->admin_model->change_login_password($password_data)){
				$this->session->set_flashdata('message', 'Student\'s Account password has been updated');
				redirect('/student/'.$student_no);
			}
			
		}
		else{
			$error="";
			
			if(form_error('password')){
				$error.=form_error('password')."<br>";
			}

			if(form_error('cpassword')){
				$error.=form_error('cpassword');
			}

			$this->session->set_flashdata('message', $error);
			redirect('/student/'.$student_no);
		}
	}


	//UPDATE STUDENT INFORMATION
	public function update_student_info(){
		$this->verify();
		$student_no=str_replace('/', '_', $this->input->post('admission_no'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('fname', "Firstname", 'trim|required');
		$this->form_validation->set_rules('sname', "Surname", 'trim|required');
		$this->form_validation->set_rules('oname', "Othername", 'trim');
		$this->form_validation->set_rules('admission_no', "Admission Number", 'trim|required');
		$this->form_validation->set_rules('gender', "Gender");
		$this->form_validation->set_rules('dob', "Date of Birth");
		$this->form_validation->set_rules('state', "State Of Origin");
		$this->form_validation->set_rules('lga', "Local Government Area");
		$this->form_validation->set_rules('town', "Home Town");
		$this->form_validation->set_rules('religion', "Religion");
		$this->form_validation->set_rules('YearAdmitted', "Year Admitted");
		$this->form_validation->set_rules('classAdmitted', "Class Admitted to");
		$this->form_validation->set_rules('dept', "Department");
		$this->form_validation->set_rules('school', "Schools Attended");
		$this->form_validation->set_rules('medical', "Medical Conditions");
		$this->form_validation->set_rules('medication', "Special medication");
		$this->form_validation->set_rules('home', "Home Address");
		$this->form_validation->set_rules('parentName', "Parent/Guardian Name");
		$this->form_validation->set_rules('parentPhone', "Parent/Guardian Phone");
		$this->form_validation->set_rules('studentType', "Type");
		$this->form_validation->set_rules('status', "Status", 'required');
		$this->form_validation->set_rules('class', "Present Class", "required");
		if($this->form_validation->run()){

			$student_info=array(
				'ID'=>$this->input->post('id'),
				'FIRSTNAME'=> ucwords(strtolower($this->input->post('fname'))),
				'SURNAME'=>ucwords(strtolower($this->input->post('sname'))),
				'OTHERNAME'=>ucwords(strtolower($this->input->post('oname'))),
				'ADMISSION_NUMBER'=>strtoupper($this->input->post('admission_no')),
				'GENDER'=>$this->input->post('gender'),
				'DOB'=>date('Y-m-d', strtotime($this->input->post('dob'))),
				'STATE'=> ucwords($this->input->post('state')),
				'LGA'=>trim(ucwords($this->input->post('lga'))),
				'HOME_TOWN'=>trim(ucwords($this->input->post('town'))),
				'RELIGION'=>trim(ucwords($this->input->post('religion'))),
				'YEAR_ADMITTED'=>trim($this->input->post('YearAdmitted')),
				'CLASS_ADMITTED_TO'=>trim(strtoupper($this->input->post('classAdmitted'))),
				'DEPARTMENT'=>$this->input->post('dept'),
				'SCHOOL_ATTENDED'=>trim(ucwords($this->input->post('school'))),
				'MEDICAL_CONDITION'=>trim($this->input->post('medical')),
				'SPECIAL_MEDICATION'=>trim($this->input->post('medication')),
				'HOME_ADDRESS'=>trim(ucwords($this->input->post('home'))),
				'PARENT_NAME'=>trim($this->input->post('parentName')),
				'PARENT_PHONE'=>trim($this->input->post('parentPhone')),
				'TYPE'=>$this->input->post('studentType'),
				'STATUS'=>$this->input->post('status'),
				'PRESENT_CLASS'=>$this->input->post('class')
			);
			
			if($this->admin_model->update_student_info($student_info)){
				$this->session->set_flashdata('message', 'Student Information has been updated');
				redirect('/student/'.$student_no);
			}
			else{
				$this->session->set_flashdata('message', 'Oops, there is a problem updating Student Information');
				redirect('/student/'.$student_no);
			}
		}
		else{
			$error="";
			if(form_error('fname')){
				$error.=form_error('fname')."<br>";
			}

			if(form_error('sname')){
				$error.=form_error('sname')."<br>";
			}

			if(form_error('admission_no')){
				$error.=form_error('admission_no')."<br>";
			}

			if(form_error('status')){
				$error.=form_error('status');
			}

			$this->session->set_flashdata('message', $error);
			redirect('/student/'.$student_no);
		}
	}


	//UPDATE STUDENT PICTURE
	public function Update_picture(){
			$student_no=str_replace('/', '_', $this->input->post('reg_no'));
			$config['upload_path']          = '../assets/studentpic';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 100000;
            $config['max_width']            = 500;
            $config['max_height']           = 500;
            $config['file_name']			=$this->input->post('reg_no');
            $config['overwrite']			= True;
            $config['file_ext_tolower']		= True;
            $config['remove_spaces']		= True;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('picture'))
                {
                    $error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('message', $error['error']);
					redirect('/student/'.$student_no);
                }
            else
                {
                    
                   $picture_info=array(
                    	'ADMISSION_NUMBER'=>$this->input->post('reg_no'),
                    	'PICTURE'=>$this->upload->data('file_name')
                    );

                    if($this->admin_model->update_student_picture($picture_info)){
                    	$this->session->set_flashdata('message', 'Student\'s Picture has been updated');
						redirect('/student/'.$student_no);
                    }
                    else{
                    	$this->session->set_flashdata('message', 'Oops, there is a problem updating Student\'s picture');
						redirect('/student/'.$student_no);
                    }
                }     
	}


	//CREATE NEW STUDENT RECORD
	public function create_student_info(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('fname', "Firstname", 'trim|required');
		$this->form_validation->set_rules('sname', "Surname", 'trim|required');
		$this->form_validation->set_rules('oname', "Othername", 'trim');
		$this->form_validation->set_rules('admission_no', "Admission Number", 'trim|required|is_unique[students.ADMISSION_NUMBER]', array('is_unique' => 'Admission Number has been used'));
		$this->form_validation->set_rules('gender', "Gender");
		$this->form_validation->set_rules('dob', "Date of Birth");
		$this->form_validation->set_rules('state', "State Of Origin");
		$this->form_validation->set_rules('lga', "Local Government Area");
		$this->form_validation->set_rules('town', "Home Town");
		$this->form_validation->set_rules('religion', "Religion");
		$this->form_validation->set_rules('YearAdmitted', "Year Admitted");
		$this->form_validation->set_rules('classAdmitted', "Class Admitted to");
		$this->form_validation->set_rules('dept', "Department");
		$this->form_validation->set_rules('school', "Schools Attended");
		$this->form_validation->set_rules('medical', "Medical Conditions");
		$this->form_validation->set_rules('medication', "Special medication");
		$this->form_validation->set_rules('home', "Home Address");
		$this->form_validation->set_rules('parentName', "Parent/Guardian Name");
		$this->form_validation->set_rules('parentPhone', "Parent/Guardian Phone");
		$this->form_validation->set_rules('studentType', "Type");
		$this->form_validation->set_rules('class', "Present Class", "required");
		
		if($this->form_validation->run()){

			$student_info=array(
				
				'FIRSTNAME'=> ucwords(strtolower($this->input->post('fname'))),
				'SURNAME'=>ucwords(strtolower($this->input->post('sname'))),
				'OTHERNAME'=>ucwords(strtolower($this->input->post('oname'))),
				'ADMISSION_NUMBER'=>strtoupper($this->input->post('admission_no')),
				'GENDER'=>$this->input->post('gender'),
				'DOB'=>date('Y-m-d', strtotime($this->input->post('dob'))),
				'STATE'=> ucwords($this->input->post('state')),
				'LGA'=>trim(ucwords($this->input->post('lga'))),
				'HOME_TOWN'=>trim(ucwords($this->input->post('town'))),
				'RELIGION'=>trim(ucwords($this->input->post('religion'))),
				'YEAR_ADMITTED'=>trim($this->input->post('YearAdmitted')),
				'CLASS_ADMITTED_TO'=>trim(strtoupper($this->input->post('classAdmitted'))),
				'DEPARTMENT'=>$this->input->post('dept'),
				'SCHOOL_ATTENDED'=>trim(ucwords($this->input->post('school'))),
				'MEDICAL_CONDITION'=>trim($this->input->post('medical')),
				'SPECIAL_MEDICATION'=>trim($this->input->post('medication')),
				'HOME_ADDRESS'=>trim(ucwords($this->input->post('home'))),
				'PARENT_NAME'=>trim($this->input->post('parentName')),
				'PARENT_PHONE'=>trim($this->input->post('parentPhone')),
				'TYPE'=>$this->input->post('studentType'),
				'PRESENT_CLASS'=>$this->input->post('class')
			);

			if($this->admin_model->add_student($student_info)){
				$this->session->set_flashdata('message', 'Student Record has been created');
				redirect('/students');
			}
			else{
				$this->session->set_flashdata('message', 'Oops, there is a problem creating student record');
				redirect('/students');
			}
		}
		else{
			$error="";
			if(form_error('fname')){
				$error.=form_error('fname')."<br>";
			}

			if(form_error('sname')){
				$error.=form_error('sname')."<br>";
			}

			if(form_error('admission_no')){
				$error.=form_error('admission_no')."<br>";
			}

			if(form_error('status')){
				$error.=form_error('status');
			}

			$this->session->set_flashdata('message', $error);
			redirect('/students');
		}
	}


	//=============================================
	//=============================================
	//----------------ADMINISTRATOR-----------------------
	//=============================================
	//=============================================

	public function administrator(){
		$this->verify();
		$data['title']="Administrator";
		$data['admin_list']=$this->admin_model->fetch_admin();
		$this->load->view('parts/head', $data);
		$this->load->view('administrator/administrator', $data);
		$this->load->view('parts/javascript', $data);
	}

	//ADD ADMINISTRATOR ACCOUNT
	public function add_admin(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('username', "Username", 'trim|required|is_unique[admin.USERNAME]', array('is_unique' => 'Username has been taken'));
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');
		if($this->form_validation->run()){
			$admin_info=array(
				'NAME'=>ucwords(strtolower($this->input->post('name'))),
				'USERNAME'=>strtolower($this->input->post('username')),
				'PASSWORD'=>md5(strtolower($this->input->post('password')))
			);
			if($this->admin_model->add_admin($admin_info)){
				$this->session->set_flashdata('message', 'Administrator account has been created');
				redirect('/admin');
			}
			else{
				$this->session->set_flashdata('message', 'There is a problem creating Adminstrator account');
				redirect('/admin');
			}
		}
		else{
			$error="";
			if(form_error('name')){
				$error.=form_error('name')."<br>";
			}

			if(form_error('username')){
				$error.=form_error('username')."<br>";
			}

			if(form_error('password')){
				$error.=form_error('password')."<br>";
			}

			if(form_error('cpassword')){
				$error.=form_error('cpassword')."<br>";
			}

			$this->session->set_flashdata('message', $error);
			redirect('/admin');
		}
	}

	//FETCH ADMINISTRATOR INFORMATION
	public function fetch_admin_info(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('admin_id', 'ADMIN ID', 'trim|required|numeric');
		if($this->form_validation->run()){
			
			$data['adminInfo']=$this->admin_model->fetch_admin_info($this->input->post('admin_id'));
			$this->load->view('administrator/adminInfo', $data);
			
		}
	}

	//UPDATE ADMINISTRATOR ACCOUNT
	public function update_admin(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('username', "Username", 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');
		if($this->form_validation->run()){
			

			$admin_info=array(
				'ADMIN_ID'=>$this->input->post('admin_id'),
				'NAME'=>ucwords(strtolower($this->input->post('name'))),
				'USERNAME'=>strtolower($this->input->post('username')),
				'PASSWORD'=>md5(strtolower($this->input->post('password')))
			);
			if($this->admin_model->update_admin($admin_info)){
				$this->session->set_flashdata('message', 'Administrator account has been updated');
				
				if($this->input->post('admin_id')==$_SESSION['admin_id']){

					$session_data=array('username' => strtolower($this->input->post('username')), 'password' => md5(strtolower($this->input->post('password'))), 'name'=> ucwords(strtolower($this->input->post('name'))));
					$this->session->set_userdata($session_data);
				}
			}
			else{
				$this->session->set_flashdata('message', 'There is a problem updating Adminstrator account');
			}
		}
		else{
			$error="";
			if(form_error('name')){
				$error.=form_error('name')."<br>";
			}

			if(form_error('username')){
				$error.=form_error('username')."<br>";
			}

			if(form_error('password')){
				$error.=form_error('password')."<br>";
			}

			if(form_error('cpassword')){
				$error.=form_error('cpassword');
			}

			$this->session->set_flashdata('message', $error);
			
		}
		redirect('/admin');
	}

	//DELETE ADMINSTRATOR ACCOUNT
	public function delete_admin($admin_id){
		if(is_numeric($admin_id)){

			if($_SESSION['admin_id']==$admin_id){
				$this->session->set_flashdata('message', 'You can\'t delete your account while you are logged in');
			}
			else{
				if($this->admin_model->delete_admin($admin_id)){
					$this->session->set_flashdata('message', 'Administrator\'s account has been deleted');
				}
				else{
					$this->session->set_flashdata('message', 'There is an error deleting Administrator\'s Account');
				}
			}
			
		}
		else{
			redirect(base_url());
		}
		redirect('/admin');
	}


	//=============================================
	//=============================================
	//----------------RESOURCES--------------------
	//=============================================
	//=============================================

	public function resources(){
		$this->verify();
		$data['title']="Resources";
		$data['category']=$this->admin_model->fetch_rescources_cat();
		$this->load->view('parts/head', $data);
		$this->load->view('resources/resources', $data);
		$this->load->view('parts/javascript', $data);
	}


	//ADD LINK
	public function add_link(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Link Title', 'trim|required');
		$this->form_validation->set_rules('link', "Link", 'trim|required');
		$this->form_validation->set_rules('category', "Category", 'trim|required|numeric');
		if($this->form_validation->run()){
			$link_info=array(
				'TITLE'=>trim($this->input->post('title')),
				'RESOURCE_CAT'=>$this->input->post('category'),
				'RESOURCES'=>trim($this->input->post('link'))
			);
			if($this->admin_model->add_link($link_info)){
				$this->session->set_flashdata('message', 'Link has been added to resources');
			}
			else{
				$this->session->set_flashdata('message', 'There is a problem adding link to resources');
			}
		}
		else{
			$error="";
			if(form_error('title')){
				$error.=form_error('title');
			}

			if(form_error('link')){
				$error.=form_error('link');
			}

			if(form_error('category')){
				$error.=form_error('category');
			}

			$this->session->set_flashdata('message', $error);
			
		}
		redirect('/resources');
	}

	//ADD OTHER RESOURCES
	public function add_resources(){
			
			$config['upload_path']          = '../assets/myResources';
            $config['allowed_types']        = 'gif|jpg|png|mp4|jpeg|mp3|flv|mkv|pdf|ppt|doc|docx';
            $config['max_size']             = 100000;
            $config['max_width']            = 5000;
            $config['max_height']           = 5000;
            $config['file_name']			=uniqid();
            $config['overwrite']			= True;
            $config['file_ext_tolower']		= True;
            $config['remove_spaces']		= True;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file'))
                {
                    $error = array('error' => $this->upload->display_errors());
					$this->session->set_flashdata('message', $error['error']);
					redirect('/resources');
                }
            else
                {
                    $this->load->library('form_validation');
					$this->form_validation->set_rules('title', 'Link Title', 'trim|required');
					$this->form_validation->set_rules('category', "Category", 'trim|required|numeric');
					if($this->form_validation->run()){
		                $resource_info=array(
		                    'TITLE'=>trim($this->input->post('title')),
		                    'RESOURCES'=>$this->upload->data('file_name'),
		                    'RESOURCE_CAT'=>$this->input->post('category')
		                );

	                    if($this->admin_model->add_other_resources($resource_info)){
	                    	$this->session->set_flashdata('message', 'Resource has been added');
	                    }
	                    else{
	                    	$this->session->set_flashdata('message', 'Oops, there is a problem adding resource');
	                    }
	                }
	                else{
							$error="";
							if(form_error('title')){
								$error.=form_error('title');
							}

							if(form_error('category')){
								$error.=form_error('category');
							}

							$this->session->set_flashdata('message', $error);	
						}
                }  

                redirect('/resources');   
	}

	//RESOURCES CATEGORY PAGE
	public function resourcesCatgory($id){
		$this->verify();
		$data['title']="Resources";
		$data['resources']=$this->admin_model->fetch_resources($id);
		$this->load->view('parts/head', $data);
		$this->load->view('resources/resourcesCat', $data);
		$this->load->view('parts/javascript', $data);
	}


	//RESOURCES CATEGORY PAGE
	public function deleteResource($id){
		$this->verify();
		if($this->admin_model->delete_resource($id)){
			$this->session->set_flashdata('message', 'Resource has been deleted');
		}
		else{
			$this->session->set_flashdata('message', 'Oops, there is a problem deleting resource');
		}	
		 redirect('/resources');   	
	}



	//=============================================
	//=============================================
	//----------------SETTINGS--------------------
	//=============================================
	//=============================================

	public function settings(){
		$this->verify();
		$data['title']="Settings";
		$this->load->view('parts/head', $data);
		$this->load->view('settings', $data);
		$this->load->view('parts/javascript', $data);
	}

	//BACK UP DATABASE IN CSV
	public function backup(){
		$this->verify();
		$this->load->dbutil();
		$this->load->helper('file');
		$this->load->helper('download');
		$this->load->library('zip');
		$database_tables=['admin','behaviour','class','comments','parentlogin','resources','resources_cat','scores','studentlogin','students','subject','teachers'];
		foreach ($database_tables as $tables) {
			$query = $this->db->query("SELECT * FROM ".$tables);
			$data=$this->dbutil->csv_from_result($query);
			write_file('../backup/'.$tables.'-'.date("F-d-Y").'.csv', $data);
			
		}
		$this->zip->read_dir('../backup', TRUE);
		$this->zip->read_dir('../assets/myResources');
		//$this->zip->read_dir('assets/documents', FALSE);
		//$this->zip->download('officers_credential.zip');
		delete_files('../backup/');
		$this->zip->download('backup'.date("F-d-Y").'.zip');
	}

	//RESET PARENT PORTAL PASSWORD 
	public function reset_parent_portal_password(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('student_regNo', 'Student Reg Number', 'trim|required');
		if($this->form_validation->run()){

			if($this->admin_model->reset_parent_password(strtoupper($this->input->post('student_regNo')))){
				$this->session->set_flashdata('message', 'Parent Password has been reset');
			}
			else{
				$this->session->set_flashdata('message', 'There is a problem reseting Parent Password.');
			}
		}
		else{
			$error="";
			if(form_error('student_regNo')){
				$error.=form_error('student_regNo');
			}
			$this->session->set_flashdata('message', $error);
		}
		redirect('/settings');
	}


	//DEACTIVATE PARENT PORTAL PASSWORD 
	public function deactivate_parent_account(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('student_regNo', 'Student Reg Number', 'trim|required');
		if($this->form_validation->run()){

			if($this->admin_model->deactivate_parent_login(strtoupper($this->input->post('student_regNo')))){
				$this->session->set_flashdata('message', 'Parent Account has been deactivated');
			}
			else{
				$this->session->set_flashdata('message', 'There is a problem deactivating Parent Account.');
			}
		}
		else{
			$error="";
			if(form_error('student_regNo')){
				$error.=form_error('student_regNo');
			}
			$this->session->set_flashdata('message', $error);
		}
		redirect('/settings');
	}

	//ACTIVATE PARENT PORTAL PASSWORD 
	public function activate_parent_account(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('student_regNo', 'Student Reg Number', 'trim|required');
		if($this->form_validation->run()){

			if($this->admin_model->activate_parent_login(strtoupper($this->input->post('student_regNo')))){
				$this->session->set_flashdata('message', 'Parent Account has been activated');
			}
			else{
				$this->session->set_flashdata('message', 'There is a problem activating Parent Account.');
			}
		}
		else{
			$error="";
			if(form_error('student_regNo')){
				$error.=form_error('student_regNo');
			}
			$this->session->set_flashdata('message', $error);
		}
		redirect('/settings');
	}


	//=============================================
	//=============================================
	//----------------RESULT-----------------------
	//=============================================
	//=============================================

	
	public function scores(){
		$this->verify();
		$data['title']="Result";
		//$data['class_list']=$this->admin_model->get_classes();
		//$data['teachers']=$this->admin_model->fetch_teachers_list();
		$this->load->view('parts/head', $data);
		$this->load->view('scores/scores', $data);
		$this->load->view('parts/javascript', $data);
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
			$data['grade_list']=$this->admin_model->fetch_grade_list($result_data);
			$this->load->view('scores/gradelist', $data);
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
			$data['score_info']=$this->admin_model->fetch_score_info($this->input->post('score_id'));
			$this->load->view('scores/scoreInfo', $data);
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
			if($this->admin_model->delete_score($this->input->post('score_id'))){
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
			if($this->admin_model->update_score($score_info)){
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

	//FETCH SCORESHEET
	public function fetch_scoresheet(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('type', 'Type', 'trim|required');
		$this->form_validation->set_rules('class', 'Class', 'trim|required');
		$this->form_validation->set_rules('term', 'Term', 'trim|required|numeric');
		$this->form_validation->set_rules('session', 'Session', 'trim|required');
		if($this->form_validation->run()){
			
			$data['students']=$this->admin_model->fetch_scoresheet($this->input->post('class'));
			
			if($this->input->post('type')=='CA'){
				$this->load->view('scores/caSheet', $data);
			}
			else{
				$this->load->view('scores/examSheet', $data);
			}
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

	//FETCH STUDENTLIST
	public function fetch_studentlist(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('type', 'Type', 'trim|required');
		$this->form_validation->set_rules('class', 'Class', 'trim|required');
		$this->form_validation->set_rules('term', 'Term', 'trim|required|numeric');
		$this->form_validation->set_rules('session', 'Session', 'trim|required');
		if($this->form_validation->run()){
			$data['students']=$this->admin_model->fetch_student_list($this->input->post('class'));
			$this->load->view('scores/studentList', $data);
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
		
		$data['student_info']=$this->admin_model->fetch_student_info($result_data['STUDENT_NUMBER']);
		$data['comments']=$this->admin_model->fetch_comments($result_data);
		$data['result_data']=$result_data;
		//GET CA RESULT BASED ON CLASS (S.S.3 CA RESULT SHEET IS DIFFERENT FROM OTHER CLASSES LIKE J.S.S.1-S.S.2)
		if(preg_match("/^S.S.3/", $result_data['CLASS'])){
			$data['ca_result']=$this->admin_model->fetch_ca_resultSenior($result_data);
			$this->load->view('scores/ca_senior',$data); //USE S.S.3 CA RESULT SHEET
		}
		else{
			$data['ca_result']=$this->admin_model->fetch_ca_result($result_data);
			$this->load->view('scores/ca_junior',$data); //USE CA RESULT SHEET FOR J.S.S.1-S.S.2
		}
	}

	//GET EXAM RESULT
	public function getExam($result_data){

		$data['student_info']=$this->admin_model->fetch_student_info($result_data['STUDENT_NUMBER']);
		$data['comments']=$this->admin_model->fetch_comments($result_data);
		$data['behaviour']=$this->admin_model->fetch_bahaviour($result_data);
		$data['result_data']=$result_data;
		//GET CA RESULT BASED ON CLASS (S.S.3 EXAM RESULT SHEET IS DIFFERENT FROM OTHER CLASSES LIKE J.S.S.1-S.S.2)
		if(preg_match("/^S.S.3/", $result_data['CLASS'])){
			$data['exam_result']=$this->admin_model->fetch_exam_resultSenior($result_data);
			$this->load->view('scores/examSenior',$data); //USE S.S.3 EXAM RESULT SHEET
		}
		else{
			switch ($result_data['TERM']) {
				case '1':
					$data['exam_result']=$this->admin_model->fetch_exam_result($result_data); 
					$this->load->view('scores/examJuniorfirstterm', $data); //USE J.S.S.1-S.S.2 FIRST TERM EXAM RESULT SHEET
					break;
				case '2':
					$data['exam_result']=$this->admin_model->fetch_exam_result($result_data);
					$this->load->view('scores/examJuniorSecondterm', $data); //USE J.S.S.1-S.S.2 SECOND TERM EXAM RESULT SHEET
					break;
				case '3':
					$data['exam_result']=$this->admin_model->fetch_exam_result($result_data);
					$this->load->view('scores/examJuniorThirdterm', $data); //USE J.S.S.1-S.S.2 THIRD TERM EXAM RESULT SHEET
					break;
			}
		}
	}


	//=============================================
	//=============================================
	//----------------COMMENTS---------------------
	//=============================================
	//=============================================

	//ADD PRINCIPAL CA COMMMENT
	public function add_principal_ca_comment(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('term', 'Term', 'trim|numeric|required');
		$this->form_validation->set_rules('session', 'Session', 'trim|required');
		$this->form_validation->set_rules('class', 'Class', 'trim|required');
		$this->form_validation->set_rules('regNo', 'Registration Number', 'trim|required');
		$this->form_validation->set_rules('comment_id', 'Comment ID', 'trim');
		$this->form_validation->set_rules('principalComment', 'Comment', 'trim|required');
		if($this->form_validation->run()){
			$comment_data=array(
				'STUDENT_NUMBER'=>$this->input->post('regNo'),
				'TERM'=>$this->input->post('term'),
				'SESSION'=>$this->input->post('session'),
				'CLASS'=>$this->input->post('class'),
				'ID'=>$this->input->post('comment_id'),
				'PRINCIPAL_CA'=>trim($this->input->post('principalComment')),
				'PRINCIPAL_CA_DATE'=>date('F d, Y')
			);
			if($this->admin_model->add_principal_comment($comment_data)){
				$this->session->set_flashdata('message', "Principal's comment has been added");
			}
			else{
				$this->session->set_flashdata('message', "There is a problem adding Principal's comment");
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

	//ADD PRINCIPAL CA COMMMENT
	public function add_principal_exam_comment(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('term', 'Term', 'trim|numeric|required');
		$this->form_validation->set_rules('session', 'Session', 'trim|required');
		$this->form_validation->set_rules('class', 'Class', 'trim|required');
		$this->form_validation->set_rules('regNo', 'Registration Number', 'trim|required');
		$this->form_validation->set_rules('comment_id', 'Comment ID', 'trim');
		$this->form_validation->set_rules('principalComment', 'Comment', 'trim|required');
		if($this->form_validation->run()){
			$comment_data=array(
				'STUDENT_NUMBER'=>$this->input->post('regNo'),
				'TERM'=>$this->input->post('term'),
				'SESSION'=>$this->input->post('session'),
				'CLASS'=>$this->input->post('class'),
				'ID'=>$this->input->post('comment_id'),
				'PRINCIPAL_EXAM'=>trim($this->input->post('principalComment')),
				'PRINCIPAL_EXAM_DATE'=>date('F d, Y')
			);
			if($this->admin_model->add_principal_exam_comment($comment_data)){
				$this->session->set_flashdata('message', "Principal's comment has been added");
			}
			else{
				$this->session->set_flashdata('message', "There is a problem adding Principal's comment");
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
			if($this->admin_model->add_teacher_comment($comment_data)){
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
			if($this->admin_model->add_teacher_exam_comment($comment_data)){
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

	//EDIT PRINCIPAL CA COMMENT
	public function edit_principal_ca_comment(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('term', 'Term', 'trim|numeric|required');
		$this->form_validation->set_rules('session', 'Session', 'trim|required');
		$this->form_validation->set_rules('class', 'Class', 'trim|required');
		$this->form_validation->set_rules('regNo', 'Registration Number', 'trim|required');
		$this->form_validation->set_rules('comment_id', 'Comment ID', 'trim|required|numeric');
		$this->form_validation->set_rules('principalComment', 'Comment', 'trim|required');
		if($this->form_validation->run()){
			$comment_data=array(
				'ID'=>$this->input->post('comment_id'),
				'PRINCIPAL_CA'=>trim($this->input->post('principalComment')),
			);
			if($this->admin_model->edit_principal_comment($comment_data)){
				$this->session->set_flashdata('message', "Principal's comment has been updated");
			}
			else{
				$this->session->set_flashdata('message', "There is a problem updating Principal's comment");
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

	//EDIT PRINCIPAL EXAM COMMENT
	public function edit_principal_exam_comment(){
		$this->verify();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('term', 'Term', 'trim|numeric|required');
		$this->form_validation->set_rules('session', 'Session', 'trim|required');
		$this->form_validation->set_rules('class', 'Class', 'trim|required');
		$this->form_validation->set_rules('regNo', 'Registration Number', 'trim|required');
		$this->form_validation->set_rules('comment_id', 'Comment ID', 'trim|required|numeric');
		$this->form_validation->set_rules('principalComment', 'Comment', 'trim|required');
		if($this->form_validation->run()){
			$comment_data=array(
				'ID'=>$this->input->post('comment_id'),
				'PRINCIPAL_EXAM'=>trim($this->input->post('principalComment')),
			);
			if($this->admin_model->edit_principal_exam_comment($comment_data)){
				$this->session->set_flashdata('message', "Principal's comment has been updated");
			}
			else{
				$this->session->set_flashdata('message', "There is a problem updating Principal's comment");
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
			if($this->admin_model->edit_teacher_comment($comment_data)){
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
			if($this->admin_model->edit_teacher_exam_comment($comment_data)){
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
			$data['students']=$this->admin_model->getStudentlist_for_behaivour($list_data);
			$this->load->view('scores/studentlist2', $data);	
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
				$this->admin_model->processBehaivourReport($report_data);

			}

			$this->session->set_flashdata('message', "Behavioural Reports has been submitted");
			redirect('/result');
		}
	}

	//================
	//===============
	//SCORE ENTRY
	//==================
	//==================


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
			$data['students']=$this->admin_model->getStudentlist_for_scoresentry($list_data, $this->input->post('scoreType'));
			$this->load->view('scores/ScoreEntry', $data);	
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
						if($this->admin_model->processSingleSeniorCAscores($report_data)){
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
						if($this->admin_model->processSingleJuniorCAscores($report_data)){
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
						if($this->admin_model->processSingleSENIOREXAMscores($report_data)){
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
						if($this->admin_model->processSingleJUNIOREXAMscores($report_data)){
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
				$this->admin_model->processCAscores($report_data);
			}
			$this->session->set_flashdata('message', "Scores has been entered");
			redirect('/result');
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
					$this->admin_model->processSENIOREXAMscores($report_data);
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
					$this->admin_model->processJUNIOREXAMscores($report_data);
				}
			}
			$this->session->set_flashdata('message', "Scores has been entered");
			redirect('/result');
		}
	}

	//FETCH STUDENT LIST [TO BE USED IN SELECT2 PLUGIN]
	public function get_students_list_select(){
		$this->verify();
		$students=$this->admin_model->getStudentlistSELECT2($_GET['search']);
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
			$data['students']=$this->admin_model->promotion_list($this->input->post('presentClass'));
			$this->load->view('scores/promotionlist', $data);
			
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
				$this->admin_model->PromoteStudent($promote);
			}
			$this->session->set_flashdata('message', "Student has been promoted");
			redirect('/result');
		}
	}

	
}
