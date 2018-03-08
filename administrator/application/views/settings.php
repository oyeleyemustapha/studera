
        <div id="page-wrapper">
            <div class="container-fluid">
                
                <!-- row -->
                <div class="dashboard">
                 
                   

                        <div class="row">
                             <div class="col-lg-12">
                                <?php
                                                
                                                if ($this->session->flashdata('message')) {

                                                    echo' <div class="alert alert-info"><h4 class="text-center">'.$this->session->flashdata('message').'</h4></div>';
                                                }
                                            ?>
                                           
                                <div class="white-box banner setting">
                                    
                                    <div role="tabpanel">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-pills" role="tablist">
                                            <li role="presentation" class="active">
                                                <a href="#database" aria-controls="database" role="tab" data-toggle="tab"><i class="fa fa-database fa-fw"></i> Back Up Database</a>
                                            </li>
                                            <li role="presentation">
                                                <a href="#tab" aria-controls="tab" role="tab" data-toggle="tab"><i class="fa fa-edit fa-fw"></i>Reset Parent Account</a>
                                            </li>
                                        </ul>
                                    
                                        <!-- Tab panes -->
                                        <div class="tab-content">

                                            <div role="tabpanel" class="tab-pane active" id="database">
                                                <br><br>
                                                <div class="col-lg-8 col-lg-offset-2">
                                                      <a href="<?php echo base_url() ?>backup" class="btn btn-primary btn-lg btn-block"><i class="fa fa-database fa-2x fa-fw"></i><br>Back Up Database</a>
                                                </div>
                                            </div>

                                            <div role="tabpanel" class="tab-pane" id="tab">
                                                <div class="btn btn-group">
                                                    <a class="btn btn-primary btn-lg" data-toggle="modal" href='#activateAccountModal'>Activate Account</a>
                                                    <a class="btn btn-warning btn-lg" data-toggle="modal" href='#deactivateAccountModal'>Deactivate Account</a>
                                                    <a class="btn btn-danger btn-lg" data-toggle="modal" href='#resetPasswordModal'>Reset Password</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                           
                        </div>
                       
                       
                       
                           
                  
                </div>
            </div>
            <!-- /.container-fluid -->
            <br>
            <footer class="footer text-center"> &copy; <?php echo date('Y');  ?>. Adelayo Academy Student Management System.</footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
   

<!--=====RESET PASSWORD MODAL==-->
<div class="modal fade" id="resetPasswordModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center">Reset Parent Password</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo base_url(); ?>PasswordReset">
                    <div class="form-group">
                        <div class="input-group">
                              <input type="text" class="form-control input-lg" name="student_regNo" placeholder="Student Registration No" autocomplete="off" required>
                              <span class="input-group-btn input-group-lg">
                                <button type="submit" class="btn btn-danger btn-lg"><i class="fa fa-refresh fa-fw"></i>Reset</button>
                              </span>
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--=====DEACTIVATE PARENT ACCOUNT==-->
<div class="modal fade" id="deactivateAccountModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center">Deactivate Parent Account</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo base_url(); ?>DeactivateParentAccount">
                    <div class="form-group">
                        <div class="input-group">
                              <input type="text" class="form-control input-lg" name="student_regNo" placeholder="Student Registration No" autocomplete="off"  required>
                              <span class="input-group-btn input-group-lg">
                                <button type="submit" class="btn btn-danger btn-lg">Deactivate account</button>
                              </span>
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--=====ACTIVATE PARENT ACCOUNT==-->
<div class="modal fade" id="activateAccountModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center">Activate Parent Account</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo base_url(); ?>ActivateParentAccount">
                    <div class="form-group">
                        <div class="input-group">
                              <input type="text" class="form-control input-lg" name="student_regNo" placeholder="Student Registration No" autocomplete="off"  required>
                              <span class="input-group-btn input-group-lg">
                                <button type="submit" class="btn btn-danger btn-lg">Activate account</button>
                              </span>
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>