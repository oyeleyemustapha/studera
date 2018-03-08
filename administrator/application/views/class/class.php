
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="dashboard">
                   <div class="white-box">
                       <h1 class="text-center"><i class="fa fa-building fa-fw"></i> CLASSES</h1>
                   </div>
                   <div class="white-box">
                       <div class="row">
                        <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2">
                          <?php
                            if($this->session->flashdata('message')){
                              echo"<div class='alert alert-info'><h1 class='text-center'>".$this->session->flashdata('message')."</h1></div>";
                            }

                          ?>
                          <button class="btn btn-primary pull-right" data-toggle="modal" href='#assignClassModal'>Assign Class Teacher</button>
                          <div class="clearfix"></div><br>
                         <form method="post" action="<?php echo base_url(); ?>addclass">
                            <div class="input-group">
                              <input type="text" class="form-control input-lg"  name="class" placeholder="Class" required>
                              <span class="input-group-btn input-group-lg">
                                <button type="submit" class="btn btn-danger btn-lg" name="addClass"><i class="fa fa-plus fa-fw"></i>Add</button>
                              </span>
                            </div>
                         </form>

                         <br>
                         <?php

                            if($class_list){
                                  echo'<div class="table-responsive"><table class="table table-hover table-striped table-bordered table-condensed classList display">
                                   <thead>
                                     <tr>
                                       <th>ID</th>
                                       <th>CLASS</th>
                                       <th>TEACHER</th>
                                       <th></th>
                                     </tr>
                                   </thead>
                                   <tbody>';
                            }
                            $counter=1;
                            foreach ($class_list as $classes) {
                              if(is_null($classes->NAME)){
                                $class_teacher="Not Assigned";
                              }
                              else{
                                $class_teacher=$classes->NAME;
                              }
                              echo"
                                 <tr>
                                   <td>$counter</td>
                                   <td>$classes->CLASS</td>
                                   <td>$class_teacher</td>
                                   <td><a href='".base_url()."deleteClass/$classes->ID' class='btn btn-danger btn-block'>Delete</a></td>
                                 </tr>
                              ";
                              $counter++;
                            }
                            echo' </tbody></table></div>';
                         ?>
                         
                        </div>
                       </div>
                   </div>
                </div>
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> &copy; <?php echo date('Y'); ?>.Adelayo Academy Student Management System.</footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
   

<div class="modal fade" id="assignClassModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-center">ASSIGN CLASS TEACHER</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url() ?>AssignClass">
          <div class="form-group">
            <select class="form-control input-lg" name="teacher" required>
              <option value="">Choose Class Teacher</option>
               <?php
                foreach ($teachers as $teachers) {
                  echo"<option value='$teachers->ID'>$teachers->NAME</option>";
                }

               ?>
            </select>
          </div>

          <div class="form-group">
            <select class="form-control input-lg" name="class" required>
              <option value="">Select Class</option>
              <?php
                foreach ($class_list as $classes) {
                  echo"<option value='$classes->ID'>$classes->CLASS</option>";
                }

               ?>
            </select>
          </div>
          <button class="btn btn-info btn-block">Assign Teacher</button>
        </form>
      </div>
    </div>
  </div>
</div>