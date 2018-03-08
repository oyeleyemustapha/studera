<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'teacher';
$route['404_override'] = 'error404';
$route['translate_uri_dashes'] = FALSE;
$route['logout'] = 'teacher/logout';
$route['updatePassword'] = 'student/updatePassword';
$route['login'] = 'teacher/login';
$route['dashboard'] = 'teacher/dashboard';
$route['record'] = 'student/record';
$route['result'] = 'student/result';
$route['profile'] = 'student/profile';
$route['resources/(:any)'] = 'student/my_resources/$1';

//STUDENTS
$route['students'] = 'teacher/students';
$route['student/(:any)'] = 'teacher/student/$1';

//PROFILE
$route['profile']='teacher/profile';
$route['updateLogin']='teacher/update_login';
$route['updateInfo']='teacher/update_information';

//RESULT
$route['result']="teacher/scores";

$route['promote']="teacher/promote_students";
$route['processBehaivour']="teacher/process_behaivour_report";
$route['reportsheet/(:any)/(:any)/(:any)/(:any)/(:any)']="teacher/reportsheet/$1/$2/$3/$4/$5";
$route['addteacherCacomment']="teacher/add_teacher_ca_comment";
$route['editteacherCacomment']="teacher/edit_teacher_ca_comment";
$route['addteacherExamcomment']="teacher/add_teacher_exam_comment";
$route['editteacherExamcomment']="teacher/edit_teacher_exam_comment";
$route['gradelist']="teacher/fetch_grade_list";
$route['studentlist']="teacher/generate_student_list";