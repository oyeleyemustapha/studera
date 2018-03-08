
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="dashboard">
                   <div class="white-box">
                       <h1 class="text-center"><i class="fa fa-male fa-fw"></i>&nbsp; TEACHERS</h1>
                   </div>
                   <div class="white-box">
                    <button class="btn btn-primary pull-right" data-toggle="modal" href='#teacherMOdal'><i class="fa fa-plus fa-fw"></i> Add Teacher</button>
                    <div class="clearfix"></div>
                       <div class="row">
                        <div class="table-responsive">
                          <?php
                            if($this->session->flashdata('message')){
                              echo"<div class='alert alert-info'><h1 class='text-center'>".$this->session->flashdata('message')."</h1></div>";
                            }
                            
                          ?>
                        
                         <br>
                         <?php

                        

                            if($teachers){
                                  echo'<table class="table table-hover table-striped table-bordered table-condensed classList subjects display">
                                   <thead>
                                     <tr>
                                       <th>ID</th>
                                       <th>NAME</th>
                                       <th>SUBJECT</th>
                                       <th>CLASS</th>
                                       
                                       <th>USERNAME</th>
                                       <th></th>
                                     </tr>
                                   </thead>
                                   <tbody>';
                           
                            $counter=1;
                            foreach ($teachers as $teacher) {
                             if(is_null($teacher->CLASS)){
                                $class_teacher="Not Defined";
                             }
                             else{
                                $class_teacher=$teacher->CLASS;
                             }

                             $subjects=explode(', ', $teacher->SUBJECT);

                             $subject_taught=[];

                             foreach ($subjects as $subject) {
                               $subject=$this->admin_model->fetch_subject_info($subject);
                               $subject_taught[]=$subject->SUBJECT;

                             }
                              echo"
                                 <tr>
                                   <td>$counter</td>
                                   <td><a href='teacher/$teacher->ID'>$teacher->NAME</a></td>
                                   <td>".implode(', ', $subject_taught)."</td>
                                   <td>$class_teacher</td>
                                
                                   <td>$teacher->USERNAME</td>
                                   <td>
                                   <a href='".base_url()."deleteTeacher/$teacher->ID' class='btn btn-danger btn-block'><i class='fa fa-trash fa-fw'></i> Delete</a></td>
                                 </tr>
                              ";
                              $counter++;
                            }
                            echo' </tbody></table>';
                          }
                          else{
                            echo "<div class='text-center jumbotron'>No Result Found</div>";
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
  
  <div class="modal fade" id="teacherMOdal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title text-center">CREATE TEACHER RECORD</h4>
        </div>
        <div class="modal-body">
          <form method="post" action="<?php echo base_url(); ?>addTeacher">

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-fw fa-male"></i>NAME</div>
                <input type="text" class="form-control" name="name">
              </div>
            </div>
            

            <div class="form-group">  
                <div class="input-group">
                  <div class="input-group-addon"><i class="fa fa-fw fa-envelope"></i>EMAIL</div>
                  <input type="email" class="form-control" name="email">
                </div>
            </div>
             
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-fw fa-mobile"></i>PHONE</div>
                <input type="tel" class="form-control" name="phone">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-fw fa-book"></i>SUBJECT</div>
                <select class="form-control" name="subject[]" id="subjects" style="width: 100%" multiple>
                  <option></option>
                </select>
              </div>
              
            </div>
             

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-fw fa-user"></i>USERNAME</div>
                <input type="text" name="username" class="form-control">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-fw fa-key"></i>PASSWORD</div>
                <input type="password" name="password" class="form-control">
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-fw fa-key"></i>CONFIRM PASSWORD</div>
                <input type="password" name="cpassword" class="form-control">
              </div>
            </div>

            <button class="btn btn-primary btn-block">ADD</button>









          </form>
        </div>
      </div>
    </div>
  </div>