
        <div id="page-wrapper">
            <div class="container-fluid">
                
                <!-- row -->
                <div class="dashboard">
                   
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        

                        <div class="row">
                            

                            <div class="col-lg-12">
                                
                                    <div class="white-box">
                                        <div class="row">
                                        <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
                                            <h1 class="text-center">Change Password</h1>
                                            <?php
                                                
                                                if ($this->session->flashdata('message')) {

                                                    echo' <div class="alert alert-info"><h4 class="text-center">'.$this->session->flashdata('message').'</h4></div>';
                                                }
                                            ?>
                                           
                                            <form method="post" action="<?php echo base_url(); ?>updatePassword">
                                                <div class="form-group">
                                                    <input type="password" class="input-lg form-control" name="password" placeholder="Password">
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="input-lg form-control" name="confirmpassword" placeholder="Confirm Password">
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-primary btn-lg"><i class="fa fa-edit fa-fw"></i>Update</button>
                                                </div>
                                            </form>
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
   

