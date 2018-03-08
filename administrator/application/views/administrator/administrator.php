
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="dashboard">
                   <div class="white-box">
                       <h1 class="text-center"><i class="fa fa-male fa-fw"></i>&nbsp; ADMINISTRATORS</h1>
                   </div>
                   <div class="white-box">
                    <button class="btn btn-primary pull-right" data-toggle="modal" href='#teacherMOdal'><i class="fa fa-plus fa-fw"></i> Add Administrator</button>
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

                          if(count($admin_list)==1){
                            echo"<div class='alert alert-warning'><h1 class='text-center'>No record found</h1></div>";
                          }
                          else{



                            if($admin_list){
                                  echo'<table class="table table-hover table-striped table-bordered table-condensed classList subjects display">
                                   <thead>
                                     <tr>
                                       <th>ID</th>
                                       <th>NAME</th>
                                       <th>USERNAME</th>
                                   
                                       <th></th>
                                     </tr>
                                   </thead>
                                   <tbody>';
                            }
                            $counter=1;
                            foreach ($admin_list as $admin) {
                            
                            if($admin->ADMIN_ID==1){
                              continue;
                            }
                              echo"
                                 <tr>
                                   <td>$counter</td>
                                   <td><a href='admin/$admin->ADMIN_ID'>$admin->NAME</a></td>
                                   <td>$admin->USERNAME</td>
                                   <td>
                                    <a href='#' class='btn btn-info EditAdmin' id='".$admin->ADMIN_ID."'><i class='fa fa-edit fa-fw'></i> Edit</a>
                                   <a href='".base_url()."deleteAdmin/$admin->ADMIN_ID' class='btn btn-danger'><i class='fa fa-trash fa-fw'></i> Delete</a></td>
                                 </tr>
                              ";
                              $counter++;
                            }
                            echo' </tbody></table>';
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
  
  <!--ADD ADMIN MODAL-->
  <div class="modal fade" id="teacherMOdal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title text-center">Create Administrator Account</h4>
        </div>
        <div class="modal-body">
          <form method="post" action="<?php echo base_url(); ?>addAdmin">

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-fw fa-male"></i>NAME</div>
                <input type="text" class="form-control" name="name" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-fw fa-user"></i>USERNAME</div>
                <input type="text" name="username" class="form-control" required>
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

            <button class="btn btn-primary btn-block">ADD</button>
          </form>
        </div>
      </div>
    </div>
  </div>