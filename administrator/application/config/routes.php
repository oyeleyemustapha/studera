<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'admin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['logout'] = 'admin/logout';
$route['login'] = 'admin/login';
$route['dashboard'] = 'admin/dashboard';


//CLASS
$route['addclass'] = 'admin/add_class';
$route['class'] = 'admin/classes';
$route['AssignClass'] = 'admin/assign_class';

//TEACHERS
$route['addTeacher'] = 'admin/add_teacher';
$route['teachers'] = 'admin/teachers';
$route['teacher/(:num)'] = 'admin/teacher/$1';
$route['editTeacher'] = 'admin/update_teacher_info';
$route['deleteTeacher/(:num)'] = 'admin/delete_teacher/$1';
$route['editUsername'] = 'admin/update_teacher_username';

//SUBJECT
$route['addSubject'] = 'admin/add_subject';
$route['updateSubject'] = 'admin/update_subject';
$route['deleteSubject/(:num)'] = 'admin/delete_subject/$1';
$route['deleteClass/(:num)'] = 'admin/delete_class/$1';
$route['subjects'] = 'admin/subjects';


//STUDENT
$route['StudentPasswordChange'] = 'admin/change_student_login_password';
$route['UpdateStudentInfo']='admin/update_student_info';
$route['students'] = 'admin/students';
$route['student/(:any)'] = 'admin/student/$1';
$route['account/(:any)/(:any)'] = 'admin/student_account/$1/$2';
$route['UpdatePicture']="admin/Update_picture";
$route['createStudent']="admin/create_student_info";


//ADMINISTRATOR
$route['admin']="admin/administrator";
$route['addAdmin'] = 'admin/add_admin';
$route['deleteAdmin/(:num)'] = 'admin/delete_admin/$1';
$route['editAdmin'] = 'admin/update_admin';


//RESOURCES
$route['resources']='admin/resources';
$route['addLink'] = 'admin/add_link';
$route['addResource'] = 'admin/add_resources';
$route['resourcesCategory/(:num)']="admin/resourcesCatgory/$1";
$route['deleteResource/(:num)']="admin/deleteResource/$1";

//RESOURCES
$route['settings']='admin/settings';
$route['backup']='admin/backup';
$route['PasswordReset']='admin/reset_parent_portal_password';
$route['DeactivateParentAccount']='admin/deactivate_parent_account';
$route['ActivateParentAccount']='admin/activate_parent_account';


//RESULT
$route['result']="admin/scores";
$route['gradelist']="admin/fetch_grade_list";
$route['scoresheet']="admin/fetch_scoresheet";
$route['reportsheet/(:any)/(:any)/(:any)/(:any)/(:any)']="admin/reportsheet/$1/$2/$3/$4/$5";