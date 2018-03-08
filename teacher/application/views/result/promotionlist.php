<?php
if($students){
 echo'<h2 class="text-center">Promote to '.$_POST["promoteClass"].' </h2>
 <form method="post" action="'.base_url().'promote">
  <input type="hidden" name="promoteClass" value="'.$_POST["promoteClass"].'">
<table class="table table-hover table-condensed table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th>NAME</th>
      <th>REG NO</th>
      <th><button class="btn btn-primary selectAll" type="button"><i class="fa fa-check fa-fw"></i>Select All</button></th>
    </tr>
  </thead>
  <tbody>
 ';
$counter=1;
  foreach ($students as $student) {
    echo"
      <tr>
        <td>$counter</td>
        <td>".strtoupper($student->NAME)."</td>
        <td>$student->ADMISSION_NUMBER</td>
        <td><input type='checkbox' name='student[]' class='checkbox' value='$student->ADMISSION_NUMBER'></td>
      </tr>
    ";
    $counter++;
  }
  echo"</tbody></table>
  <button class='btn btn-primary'>Promote to ".$_POST['promoteClass']."</button>
  </form>";
}
else{
  echo"
    <div class='jumbotron'><h1 class='text-center'>No Result Found</h1></div>

  ";
}


 
  

?>

