<?php
  echo"<form method='post' action='teacher/process_EXAMscores'>
      <input type='hidden' name='term' value='".$_POST['term']."' required>
      <input type='hidden' name='session' value='".$_POST['session']."' required>
      <input type='hidden' name='class' value='".$_POST['class']."' required>
      <input type='hidden' name='subject' value='".$_POST['subject']."' required>
            <table class='scoreEntry table table-hover table-bordered table-condensed'>
              <thead>
                <tr>
                  <th>S/N</th>
                  <th>NAME</th>
                  <th>REG NO</th>
                  <th>3<sup>RD</sup> CA</th>
                  <th>EXAM SCORE</th>
                </tr>
              </thead>
              <tbody>
          ";
          $counter=1;
          foreach ($students as $student) {
            echo"
              <tr>
                  <td>$counter</td>
                  <td>{$student->SURNAME} {$student->FIRSTNAME} {$student->OTHERNAME}</td>
                  <td>$student->ADMISSION_NUMBER
                    <input type='hidden' class='form-control input-lg' name='REGNO[]' value='$student->ADMISSION_NUMBER'>
                  </td>
                  <td><input type='text' class='form-control input-lg' name='CA3[]'></td>
                  <td><input type='text' class='form-control input-lg' name='EXAM[]'></td>
              </tr>
            ";
            $counter++;
          }
          echo"</tbody></table><button class='btn btn-primary'>Submit</button></form>";
?>


    