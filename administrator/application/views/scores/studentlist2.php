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
<h2 class="text-center">BEHAVIOURAL REPORT</h2>

<h3 class="text-center">CLASS: '.$_POST["class"].' | TERM: '.$term.' Term | SESSION: '.$_POST["session"].'</h3>';
  

echo"<form action='admin/process_behaivour_report' method='post'>
<input type='hidden' name='class' value='".$_POST["class"]."'>
<input type='hidden' name='term' value='".$_POST['term']."'>
<input type='hidden' name='session' value='".$_POST["session"]."'>

<div class='row'>
  <div class='col-lg-6'>
    <div class='form-group'>
      <div class='input-group'>
        <span class='input-group-addon'><i class='fa fa-calendar-o'></i> NO. OF TIME SCHOOL OPENED</span> 
        <input type='text' class='form-control' name='SCHOOL_OPENED' required>
      </div>
    </div>
  </div>

  <div class='col-lg-6'>
    <div class='form-group'>
      <div class='input-group'>
        <span class='input-group-addon'><i class='fa fa-calendar'></i> DATE OF RESUMPTION</span> 
        <input type='text' class='form-control' name='DATE_RESUMPTION' placeholder='e.g December 20, 2013'required>
      </div>
    </div>
  </div>
</div>
<br>

<table class='table table-bordered table-condensed'>
  <thead>
    <tr>
      <th>NAME</th>
      <th>NO. OF TIMES PRESENT</th>
      <th>NEATNESS</th>
      <th>ATITUDE TO WORK</th>
      <th>ATTENTIVENESS</th>
      <th>VERBAL FLUENCY</th>
      <th>HAND WRITING</th>
      <th>HONESTY</th>
    </tr>
  </thead>
  <tbody>
";
foreach ($students as $student) {
  echo"
  <tr>
    <td>
      {$student->SURNAME} {$student->FIRSTNAME}  {$student->OTHERNAME}
      <input type='hidden' name='REGNO[]' value='{$student->ADMISSION_NUMBER}' required>
    </td>

    <td>
      <input type='text' name='PRESENT[]' class='form-control input-sm' required>
    </td>
    <td>
      <select class='form-control' name='neatness[]'>
        <option value='1'>Excellent</option>
        <option value='2'>Good</option> 
        <option value='3'>Fair</option>
        <option value='4'>Poor</option>
      </select>
    </td>
    <td>
      <select class='form-control' name='attitude[]'>
        <option value='1'>Excellent</option>
        <option value='2'>Good</option> 
        <option value='3'>Fair</option>
        <option value='4'>Poor</option>
      </select>
    </td>
    <td>
      <select class='form-control' name='attentive[]'>
        <option value='1'>Excellent</option>
        <option value='2'>Good</option> 
        <option value='3'>Fair</option>
        <option value='4'>Poor</option>
      </select>
    </td>
    <td>
      <select class='form-control' name='fluency[]'>
        <option value='1'>Excellent</option>
        <option value='2'>Good</option> 
        <option value='3'>Fair</option>
        <option value='4'>Poor</option> 
      </select>
    </td>
    <td>
      <select class='form-control' name='writing[]'>
          <option value='1'>Excellent</option>
          <option value='2'>Good</option> 
          <option value='3'>Fair</option>
          <option value='4'>Poor</option>
      </select>
    </td>
    <td>
      <select class='form-control' name='honesty[]'>
        <option value='1'>Excellent</option>
        <option value='2'>Good</option> 
        <option value='3'>Fair</option>
        <option value='4'>Poor</option>
      </select>
    </td>
  </tr>
";
 }

echo "
</tbody>
</table>
<button class='btn btn-primary'>Submit</button>
</form>
";
}
else{
  echo"<div class='jumbotron'><h2 class='text-center'>Behaviour Report has been entered before</h2></div>";
}


?>

