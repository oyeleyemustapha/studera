<?php

if ($search_result) {
  echo"<ul class='list-group'>";

  foreach ($search_result as $result) {
    echo'
        <li class="list-group-item"><a href="student/'.str_replace('/', '_', $result->ADMISSION_NUMBER).'"><img src="'.base_url().'../assets/studentpic/'.$result->PICTURE.'" class="hidden-sm hidden-xs"> '.$result->NAME.' | '.$result->ADMISSION_NUMBER.'</a></li>
    ';
  }
  echo"<ul>";
}
else{

  echo"<div class='alert alert-danger'>

    <h1 class='text-center'>No Record Found</h1>
  </div>";
}

?>