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
<div class="col-lg-8 col-lg-offset-2">
<h2 class="text-center">CLASS: '.$_POST["class"].' | TERM: '.$term.' Term | SESSION: '.$_POST["session"].'</h2>
  <div class="list-group">';

  $type=$_POST["type"];
  $session=str_replace('/', '_', $_POST["session"]);
  $term=$_POST["term"];
  $class=$_POST["class"];
 
  foreach ($students as $student) {
    $regno=str_replace('/', '_', $student->ADMISSION_NUMBER);
    $URL=base_url().'reportsheet/'.$regno.'/'.$class.'/'.$type.'/'.$term.'/'.urlencode($session);
    echo'
        <a href="'.$URL.'" class="list-group-item text-center" target="_blank">'.strtoupper($student->SURNAME.' '.$student->FIRSTNAME.' '.$student->OTHERNAME).'</a>
    ';
  }
  echo'</div></div></div>';
}
else{
  echo"<div class='jumbotron'><h2 class='text-center'>No Record Found.</h2></div>";
}


?>

