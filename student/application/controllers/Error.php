<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//MAIN CLASS FOR THE ADMIN
class Error extends CI_Controller {

	public function __construct(){
        parent::__construct();

    }

   

    //PAGE NOT FOUND PAGE
	public function index(){
		$this->output>set_status_header('404');
		$this->load->view('errorpage');

	}




	
}


