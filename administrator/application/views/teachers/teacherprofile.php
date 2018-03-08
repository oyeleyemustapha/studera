
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="dashboard">
                   <div class="white-box">
                       <?php


                       if($teacher_profile){

                            if($this->session->flashdata('message')){
                              echo"<div class='alert alert-info'><h1 class='text-center'>".$this->session->flashdata('message')."</h1></div>";
                            }


                            if(is_null($teacher_profile->CLASS)){
                                    $class_teacher="Not Defined";
                                 }
                                 else{
                                    $class_teacher=$teacher_profile->CLASS;
                                 }

                                 $subjects=explode(', ', $teacher_profile->SUBJECT);

                                 $subject_taught=[];

                                 foreach ($subjects as $subject) {
                                   $subject=$this->admin_model->fetch_subject_info($subject);
                                   $subject_taught[]=$subject->SUBJECT;

                                 }

                            echo'
                            <button class="btn btn-primary pull-right" data-toggle="modal" href="#editInfo"><i class="fa fa-edit fa-fw"></i>Edit Information</button>
                            <div class="clearfix"></div>
                            <h1 class="text-center">Teacher\'s Profile</h1>
                                <div class="row">
                                   <div class="col-lg-4">
                                    <p class="text-center"><img src="'. base_Url().'../assets/img/teacher.png"></p>
                                   </div>

                                   <div class="col-lg-8">
                                     <table class="table table-user-information">
                                        <tbody>
                                            <tr>
                                                <td class="backTD"><strong>NAME : </strong></td>
                                                <td>'.$teacher_profile->NAME.'</td>
                                              </tr>
                                              <tr>
                                                <td class="backTD"><strong>EMAIL :</strong></td>
                                                <td>'.$teacher_profile->EMAIL.'</td>
                                              </tr>
                                              <tr>
                                                <td class="backTD"><strong>PHONE :</strong></td>
                                                <td>'.$teacher_profile->PHONE.'</td>
                                              </tr>
                                              <tr>
                                                <td class="backTD"><strong>SUBJECT :</strong></td>
                                                <td>'.implode(', ', $subject_taught).'</td>
                                              </tr>
                                              <tr>
                                                <td class="backTD"><strong>CLASS-IN-CHARGE :</strong></td>
                                                <td>'.$class_teacher.'</td>
                                              </tr>

                                              <tr>
                                                <td class="backTD"><strong>USERNAME :</strong></td>
                                                <td>'.$teacher_profile->USERNAME.'</td>
                                              </tr>
                                        </tbody>
                                      </table>
                                   </div>
                                 </div>
                            ';



                       }
                       else{
                        echo "<div class='alert alert-danger'>

                            <h1 class='text-center'>No Record Found</h1>
                        </div>" ;
                       }
                    
                       ?>

                       

                      






                   </div>

                    
                </div>
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> &copy; <?php echo date('Y'); ?>. Adelayo Academy Student Management System.</footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

<?php

if($teacher_profile){






?>
  
  <div class="modal fade" id="editInfo">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title text-center">UPDATE TEACHER INFORMATION</h4>
        </div>
        <div class="modal-body">

            <div role="tabpanel">
              <!-- Nav tabs -->
              <ul class="nav nav-pills" role="tablist">
                <li role="presentation" class="active">
                  <a href="#info" aria-controls="home" role="tab" data-toggle="tab">Teacher Information</a>
                </li>
                <li role="presentation">
                  <a href="#username" aria-controls="tab" role="tab" data-toggle="tab">Teacher Username</a>
                </li>
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="info">
                  <form method="post" action="<?php echo base_url(); ?>editTeacher">

                      <input type="hidden" value="<?php echo $teacher_profile->ID; ?>" name="teacher_id">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-fw fa-male"></i>NAME</div>
                          <input type="text" class="form-control" name="name" value="<?php echo $teacher_profile->NAME;  ?>" required>
                        </div>
                      </div>
                      

                      <div class="form-group">  
                          <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-fw fa-envelope"></i>EMAIL</div>
                            <input type="email" class="form-control" name="email" value="<?php echo $teacher_profile->EMAIL;  ?>" required>
                          </div>
                      </div>
                       
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-fw fa-mobile"></i>PHONE</div>
                          <input type="tel" class="form-control" name="phone" value="<?php echo $teacher_profile->PHONE;  ?>" required>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-fw fa-book"></i>SUBJECT</div>
                          <select class="form-control" name="subject[]" id="subjects" style="width: 100%" multiple required>
                            <option></option>

                          </select>
                        </div>
                        
                      </div>
                      <button class="btn btn-primary btn-block">Update Information</button>
                    </form>
                </div>
                <div role="tabpanel" class="tab-pane" id="username">
                  <form method="post"  action="<?php echo base_url(); ?>editUsername">
                     <input type="hidden" value="<?php echo $teacher_profile->ID; ?>" name="teacher_id">
                    <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-fw fa-user"></i>USERNAME</div>
                          <input type="text" name="username" class="form-control" value="<?php echo $teacher_profile->USERNAME;  ?>" required>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-fw fa-key"></i>PASSWORD</div>
                          <input type="password" name="password" class="form-control" required>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-fw fa-key"></i>CONFIRM PASSWORD</div>
                          <input type="password" name="cpassword" class="form-control" required>
                        </div>
                      </div>

                        <button class="btn btn-danger btn-block">Update</button>
                  </form>
                </div>
              </div>
            </div>



          
        </div>
      </div>
    </div>
  </div>

<?php

}

?>