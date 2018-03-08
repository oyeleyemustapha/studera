<?php
if($students){

  switch ($_POST['term']) {
    case '1':
      $term="First";
      break;
    case '2':
      $term="Second";
      break;
    case '3':
      $term="Third";
      break;
  }

  echo'
  <div class="row">
  <h2 class="text-center">SCORE ENTRY FORM</h2>
  <h3 class="text-center">CLASS: '.$_POST["class"].'  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TERM: '.$term.' Term &nbsp;&nbsp;&nbsp;&nbsp; SESSION: '.$_POST["session"].' &nbsp;&nbsp;&nbsp;&nbsp;SUBJECT : '.$this->teacher_model->getSsubjectName($_POST["subject"])->SUBJECT.'</h3>';

  if($_POST['scoreType']=="CA"){

      //USE THIS FOR SS3 STUDENTS
      if(preg_match("/^S.S.3/", $_POST["class"])){
        require_once('seniorCaEntry.php');
      }
      else{
        require_once('juniorCaEntry.php');
      }
  }
  else{

      //USE THIS FOR SS3 STUDENTS
      if(preg_match("/^S.S.3/", $_POST["class"])){
          require_once('seniorExamEntry.php');
      }
      else{
          require_once('juniorExamEntry.php');
      }   
  }
  


}
else{
  echo"<div class='jumbotron'><h2 class='text-center'><i class='fa fa-exclamation-triangle fa-fw fa-3x'></i><br>Scores has been entered before</h2></div>";
}


?>


    