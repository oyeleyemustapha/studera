
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="dashboard">
                  
                   <div class="white-box">
                    <?php
                            if($this->session->flashdata('message')){
                              echo"<div class='alert alert-info'><h1 class='text-center'>".$this->session->flashdata('message')."</h1></div>";
                            }
                            
                          ?>
                    <?php

                    if($student_info){
                      ?>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class=" pull-right">
                              <button class="btn btn-danger toggleeditStudent"><i class="fa fa-edit fa-fw"></i>Edit Information</button>
                              
                            </div>

                           

                              <div class="dropdown pull-right">
                                <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-user fa-fw"></i> Student Account
                                <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                  <li><a href="<?php echo base_url() ?>account/Inactive/<?php echo str_replace('/', '_', $student_info->ADMISSION_NUMBER); ?>">Deactivate Account</a></li>
                                  <li><a href="<?php echo base_url() ?>account/Active/<?php echo str_replace('/', '_', $student_info->ADMISSION_NUMBER); ?>">Activate Account</a></li>
                                  <li><a data-toggle="modal" href='#editPassword'>Change Password</a></li>
                                </ul>
                              </div>

                    
                            <div class="clearfix"></div><br>

                            <div class="editstudentform">
                            <div class="col-lg-3">
                                <h2 class="text-center">PICTURE</h2>
                                <p class="text-center"><div class="picture_holder"><img src="<?php echo base_url()?>../assets/studentpic/<?php echo $student_info->PICTURE; ?>"></div></p>
                                <form method="post" action="<?php echo base_url() ?>UpdatePicture" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $student_info->ID; ?>">
                                    <input type="hidden" name="reg_no" value="<?php echo $student_info->ADMISSION_NUMBER; ?>">
                                    <input type="file" name="picture" class="form-control" id="picture">
                                    <button class="btn btn-primary">Upload</button>
                                </form>
                            </div>
                            <div class="col-lg-9">
                                <form method="post" action="<?php echo base_url()?>UpdateStudentInfo" id="editstudent">
                                    <input type="hidden" name="id" value="<?php echo $student_info->ID; ?>">

                                 <table class="table table-user-information">
                                    <tbody>
                                      <tr>
                                        <td><strong>FIRSTNAME : </strong></td>
                                        <td><input type="text" name="fname" class="form-control" value="<?php echo $student_info->FIRSTNAME; ?>" required></td>
                                      </tr>

                                      <tr>
                                        <td><strong>SURNAME : </strong></td>
                                        <td><input type="text" name="sname" class="form-control" value="<?php echo $student_info->SURNAME; ?>" required></td>
                                      </tr>

                                      <tr>
                                        <td><strong>OTHERNAME : </strong></td>
                                        <td><input type="text" name="oname" class="form-control" value="<?php echo $student_info->OTHERNAME;?>" ></td>
                                      </tr>

                                      <tr>
                                        <td><strong>ADMISSION NUMBER : </strong></td>
                                        <td><input type="text" name="admission_no" class="form-control" required value="<?php echo $student_info->ADMISSION_NUMBER;?>" ></td>
                                      </tr>

                                      <tr>
                                        <td><strong>PRESENT CLASS : </strong></td>
                                        <td>
                                          
                                          <select class="form-control input-lg classes" name="class" style="width: 100%" required>
                                          <option value="<?php echo $student_info->PRESENT_CLASS;?>"><?php echo $student_info->PRESENT_CLASS;?></option>
                                          <?php echo classes();?>
                                          </select>
                                        </td>
                                      </tr>

                                      <tr>
                                        <td><strong>GENDER : </strong></td>
                                        <td><select name="gender" class="form-control">

                                            <?php
                                                if($student_info->GENDER=="Male"){
                                                    echo'<option value="Male" selected>Male</option>';
                                                }
                                                else{
                                                    echo'<option value="Female" selected>Female</option>';
                                                }

                                            ?>
                                              <option value="Male">Male</option>
                                              <option value="Female">Female</option>
                                            </select>
                                        </td>
                                      </tr>

                                       <tr>
                                        <td><strong>DATE OF BIRTH : </strong></td>
                                        <td><input type="date" name="dob" class="form-control" value="<?php echo $student_info->DOB;?>"></td>
                                      </tr>

                                       <tr>
                                        <td><strong>STATE OF ORIGIN: </strong></td>
                                        <td><input type="text" name="state" class="form-control" value="<?php echo $student_info->STATE;?>"></td>
                                      </tr>

                                       <tr>
                                        <td><strong>LOCAL GOVERNMENT AREA : </strong></td>
                                        <td><input type="text" name="lga" class="form-control" value="<?php echo $student_info->LGA;?>"></td>
                                      </tr>

                                       <tr>
                                        <td><strong>HOME TOWN : </strong></td>
                                        <td><input type="text" name="town" class="form-control" value="<?php echo $student_info->HOME_TOWN;?>"></td>
                                      </tr>

                                       <tr>
                                        <td><strong>RELIGION : </strong></td>
                                        <td><input type="text" name="religion" class="form-control" value="<?php echo $student_info->RELIGION;?>"></td>
                                      </tr>

                                       <tr>
                                        <td><strong>YEAR ADMITTED : </strong></td>
                                        <td><input type="text" name="YearAdmitted" class="form-control" value="<?php echo $student_info->YEAR_ADMITTED;?>"></td>
                                      </tr>

                                      <tr>
                                        <td><strong>CLASS ADMITTED TO : </strong></td>
                                        <td><input type="text" name="classAdmitted" class="form-control" value="<?php echo $student_info->CLASS_ADMITTED_TO;?>"></td>
                                      </tr>

                                      <tr>
                                        <td><strong>DEPARTMENT : </strong></td>
                                        <td>
                                            
                                            <select name="dept" class="form-control">
                                             <option value="<?php echo $student_info->DEPARTMENT; ?>" selected><?php echo $student_info->DEPARTMENT; ?></option>
                                              <option value="Science">Science</option>
                                              <option value="Commercial">Commercial</option>
                                               <option value="Arts">Arts</option>
                                            </select></td>
                                        </td>
                                      </tr>

                                      <tr>
                                        <td><strong>SCHOOL ATTENDED : </strong></td>
                                        <td><input type="text" name="school" class="form-control" value="<?php echo $student_info->SCHOOL_ATTENDED;?>"></td>
                                      </tr>

                                      <tr>
                                        <td><strong>MEDICAL CONDITION : </strong></td>
                                        <td><input type="text" name="medical" class="form-control" value="<?php echo $student_info->MEDICAL_CONDITION;?>"></td>
                                      </tr>

                                      <tr>
                                        <td><strong>SPECIAL MEDICATION : </strong></td>
                                        <td><input type="text" name="medication" class="form-control" value="<?php echo $student_info->SPECIAL_MEDICATION;?>"></td>
                                      </tr>

                                      <tr>
                                        <td><strong>HOME ADDRESS : </strong></td>
                                        <td><input type="text" name="home" class="form-control" value="<?php echo $student_info->HOME_ADDRESS;?>"></td>
                                      </tr>

                                      <tr>
                                        <td><strong>PARENT/GUARDIAN NAME : </strong></td>
                                        <td><input type="text" name="parentName" class="form-control" value="<?php echo $student_info->PARENT_NAME;?>"></td>
                                      </tr>

                                      <tr>
                                        <td><strong>PARENT/GUARDIAN PHONE: </strong></td>
                                        <td><input type="text" name="parentPhone" class="form-control" value="<?php echo $student_info->PARENT_PHONE;?>"></td>
                                      </tr>

                                      <tr>
                                        <td><strong>STUDENT TYPE : </strong></td>
                                        <td><select name="studentType" class="form-control">
                                             <option value="<?php echo $student_info->TYPE; ?>" selected><?php echo $student_info->TYPE; ?></option>
                                              <option value="Day">Day</option>
                                              <option value="Boarder">Boarder</option>
                                            </select></td>
                                      </tr>

                                      <tr>
                                        <td><strong>STATUS : </strong></td>
                                        <td><select name="status" class="form-control">
                                            <option value="<?php echo $student_info->STATUS; ?>" selected><?php echo $student_info->STATUS; ?></option>
                                              <option value="Active">Active</option>
                                              <option value="Graduated">Graduated</option>
                                              <option value="Left">Left</option>
                                            </select></td>
                                      </tr>     
                                    </tbody>
                                  </table>
                                <button class="btn btn-primary">Update Information</button>
                            </form>
                            </div>
                        </div>
                            
                        <div role="tabpanel " class="studentprofile">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#personal" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-user fa-fw"></i> Personal Information</a>
                                </li>
                                <li role="presentation">
                                    <a href="#education" aria-controls="tab" role="tab" data-toggle="tab"><i class="fa fa-briefcase fa-fw"></i> Education History</a>
                                </li>
                                <li role="presentation">
                                    <a href="#medical" aria-controls="tab" role="tab" data-toggle="tab"><i class="fa fa-stethoscope fa-fw"></i> Medical Infomation</a>
                                </li>
                                <li role="presentation">
                                    <a href="#contact" aria-controls="tab" role="tab" data-toggle="tab"><i class="fa fa-address-book fa-fw"></i> Contact Information</a>
                                </li>
                            </ul>
                        
                            <!-- Tab panes -->
                            <div class="tab-content info">
                                <div role="tabpanel" class="tab-pane active white-box" id="personal">
                                <div class="row">
                                    <?php

                                    echo'
                                    <p class="text-center"><img src="'.base_url().'../assets/studentpic/'.$student_info->PICTURE.'" alt="student"></p>
                                    <div class="col-lg-8 col-lg-offset-2 table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td class="text-center"><i class="fa fa-id-badge fa-fw"></i>ADMISSION NUMBER</td>
                                                    <td>'.$student_info->ADMISSION_NUMBER.'</td>
                                                </tr>

                                                <tr>
                                                    <td class="text-center"><i class="fa fa-map-marker fa-fw"></i>PRESENT CLASS</td>
                                                    <td>'.$student_info->PRESENT_CLASS.'</td>
                                                </tr>

                                                <tr>
                                                    <td class="text-center"><i class="fa fa-user fa-fw"></i>NAME</td>
                                                    <td>'.$student_info->SURNAME." ".$student_info->FIRSTNAME." ".$student_info->OTHERNAME.'</td>
                                                </tr>

                                                 <tr>
                                                    <td class="text-center"><i class="fa fa-male fa-fw"></i>GENDER</td>
                                                    <td>'.$student_info->GENDER.'</td>
                                                </tr>

                                                <tr>
                                                    <td class="text-center"><i class="fa fa-calendar fa-fw"></i>DATE OF BIRTH</td>
                                                    <td>';

                                                    if(!is_null($student_info->DOB)){
                                                      echo date('F d, Y',strtotime($student_info->DOB));
                                                    }
                                                      echo'</td>
                                                </tr>

                                                <tr>
                                                    <td class="text-center"><i class="fa fa-map-marker fa-fw"></i>STATE OF ORIGIN</td>
                                                    <td>'.$student_info->STATE.'</td>
                                                </tr>

                                                <tr>
                                                    <td class="text-center"><i class="fa fa-map-pin fa-fw"></i>LOCAL GOVERNMENT</td>
                                                    <td>'.$student_info->LGA.'</td>
                                                </tr>

                                                <tr>
                                                    <td class="text-center"><i class="fa fa-street-view fa-fw"></i>HOME TOWN</td>
                                                    <td>'.$student_info->HOME_TOWN.'</td>
                                                </tr>

                                                <tr>
                                                    <td class="text-center"><i class="fa fa-building fa-fw"></i>RELIGION</td>
                                                    <td>'.$student_info->RELIGION.'</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                </div>

                                <div role="tabpanel" class="tab-pane white-box" id="education">
                                    <div class="row">
                                        <div class="col-lg-8 col-lg-offset-2 table-responsive">
                                         
                                            <table class="table table-hover table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center"><i class="fa fa-building fa-fw"></i>STUDENT TYPE</td>
                                                        <td>'.$student_info->TYPE.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center"><i class="fa fa-calendar-o fa-fw"></i>YEAR OF ADMISSION</td>
                                                        <td>';
                                                         if(!is_null($student_info->YEAR_ADMITTED)){
                                                            echo  date('F d, Y',strtotime($student_info->YEAR_ADMITTED));
                                                          }
                                                       
                                                          echo'</td>
                                                    </tr>

                                                    <tr>
                                                        <td class="text-center"><i class="fa fa-building fa-fw"></i>CLASS ADMITED TO</td>
                                                        <td>'.$student_info->CLASS_ADMITTED_TO.'</td>
                                                    </tr>

                                                     <tr>
                                                        <td class="text-center"><i class="fa fa-building fa-fw"></i>DEPARTMENT</td>
                                                        <td>'.$student_info->DEPARTMENT.'</td>
                                                    </tr>

                                                    

                                                    <tr>
                                                        <td class="text-center"><i class="fa fa-home fa-fw"></i>SCHOOLS ATTENDED</td>
                                                        <td>
                                                            '.$student_info->SCHOOL_ATTENDED.'
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                                <div role="tabpanel" class="tab-pane white-box" id="medical">
                                     <div class="row">
                                        <div class="col-lg-8 col-lg-offset-2 table-responsive">
                                     
                                            <table class="table table-hover table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center"><i class="fa fa-heartbeat fa-fw"></i>MEDICAL CONDITION</td>
                                                        <td>'.$student_info->MEDICAL_CONDITION.'</td>
                                                    </tr>

                                                    <tr>
                                                        <td class="text-center"><i class="fa fa-stethoscope fa-fw"></i>SPECIAL MEDICATION</td>
                                                        <td>'.$student_info->SPECIAL_MEDICATION.'</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane white-box" id="contact">
                                     <div class="row">
                                        <div class="col-lg-8 col-lg-offset-2 table-responsive">
                                     
                                            <table class="table table-hover table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center"><i class="fa fa-home fa-fw"></i>HOME ADDRESS</td>
                                                        <td>'.$student_info->HOME_ADDRESS.'</td>
                                                    </tr>

                                                    <tr>
                                                        <td class="text-center"><i class="fa fa-user-circle fa-fw"></i>PARENT/GUARDIAN NAME</td>
                                                        <td>'.$student_info->PARENT_NAME.'</td>
                                                    </tr>

                                                     <tr>
                                                        <td class="text-center"><i class="fa fa-map-marker fa-fw"></i>PARENT/GUARDIAN PHONE</td>
                                                        <td>'.$student_info->PARENT_PHONE.'</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                            '; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                       <?php
                     }
                     else{

                      echo"<div class='alert alert-danger'><h1 class='text-center'><i class='fa fa-exclamation-triangle fa-2x'></i><br>No Record found</h1></div>";

                     }

                     ?>
                     
                       </div>
                      </div>
                  </div>
                    
                </div>
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> &copy; <?php echo date('Y'); ?>. Adelayo Academy Student Management System.</footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
  
  <!--===========================
    EDIT PASSWORD MODAL
    ====================-->

    <div class="modal fade" id="editPassword">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-center">CHANGE PASSWORD</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?php echo base_url(); ?>StudentPasswordChange">
                        <input type="hidden" name="studentNumber" value="<?php echo $student_info->ADMISSION_NUMBER; ?>">
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>

                        <div class="form-group">
                            <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password" required>
                        </div>
                        <button class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>