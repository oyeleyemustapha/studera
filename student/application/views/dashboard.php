
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
                    ?>
                   
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div class="white-box banner row">
                            <div class="col-lg-3"><p class="text-center"><img src="../assets/studentpic/<?php echo $student_info->PICTURE; ?>" class="school-logo" alt="Student Picture"></p></div>
                            <div class="col-lg-9"><br><p class="text-center"><?php echo $student_info->SURNAME." ".$student_info->FIRSTNAME." ".$student_info->OTHERNAME ?></p>
                                <p class="text-center"><?php echo $student_info->ADMISSION_NUMBER; ?></p>
                                
                            </div>
                        </div>

                        <div class="row dashboardMenu">
                            <div class="col-lg-6 col-sm-6">
                                <a href="<?php  base_url() ?>record.html">
                                    <div class="white-box">
                                        <p class="text-center"><i class="fa fa-male fa-5x"></i></p>
                                        <h1 class="text-center">Student Information</h1>
                                    </div>
                                </a>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <a href="<?php  base_url() ?>result.html">
                                    <div class="white-box">
                                        <p class="text-center"><i class="fa fa-file-text fa-5x"></i></p>
                                        <h1 class="text-center">Report Card</h1>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
            <br>
            <footer class="footer text-center"> &copy; <?php echo date('Y');  ?>. Studera Student Management System.</footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
   

