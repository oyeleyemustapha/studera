
        <div id="page-wrapper">
            <div class="container-fluid">
                
                <!-- row -->
                <div class="dashboard">
                    <?php
                        if($password_status){
                            echo"<div class='alert alert-info'>
                            <h1>You still using the default password, Change your password</h1>
                            <p class='text-center'><a href='".base_url()."profile' class='btn btn-primary'>Change Password</a></p>
                            </div>";
                        }

                        if($student_info->GENDER=="Male"){
                            $gender="<i class='fa fa-male fa-fw'></i>";
                        }
                        else{
                             $gender="<i class='fa fa-female fa-fw'></i>";
                        }
                    ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div class="white-box banner row">
                            <div class="col-lg-12"><p class="text-center"><?php echo $gender; ?> Your Ward is <strong><?php echo $student_info->SURNAME." ".$student_info->FIRSTNAME." ".$student_info->OTHERNAME ?></strong></p>
                            </div>
                        </div>

                       

                            <div class="col-lg-6 col-sm-6">
                                <a href="<?php  base_url() ?>result.html">
                                    <div class="white-box">
                                        <p class="text-center"><i class="fa fa-file-text fa-5x"></i></p>
                                        <h1 class="text-center">Report Card</h1>
                                    </div>
                                </a>
                            </div>

                             <div class="row dashboardMenu">
                                <div class="col-lg-6 col-sm-6">
                                    <a href="<?php  base_url() ?>performance.html">
                                        <div class="white-box">
                                            <p class="text-center"><i class="fa fa-bar-chart fa-5x"></i></p>
                                            <h1 class="text-center">PERFORMANCE</h1>
                                        </div>
                                    </a>
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
   

