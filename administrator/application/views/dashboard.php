
        <div id="page-wrapper">
            <div class="container-fluid">
                
                <!-- row -->
                <div class="dashboard">
                 
                   

                        <div class="row">
                             <div class="col-lg-6">
                                <div class="white-box banner stat">
                                    <h1 style="font-size:50px;" class="text-center"><?php echo $no_active_students->NO_OF_STUDENTS; ?></h1>
                                    <h2 class="text-center">No of Active Students</h2>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="white-box banner stat">
                                    <h1 style="font-size:50px;" class="text-center"><?php echo $no_teachers; ?></h1>
                                    <h2 class="text-center">No of Teachers</h2>
                                </div>
                            </div>
                        </div>
                       
                       
                       
                            <div class="row">

                                <div class="col-lg-4">
                                    <a href="<?php  base_url() ?>result.html">
                                        <div class="white-box">
                                            <p class="text-center"><i class="fa fa-file-text fa-5x"></i></p>
                                            <h1 class="text-center">Report Card</h1>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-lg-4">
                                    <a href="<?php  base_url() ?>students.html">
                                        <div class="white-box">
                                            <p class="text-center"><i class="fa fa-users fa-5x"></i></p>
                                            <h1 class="text-center">Students</h1>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-lg-4">
                                    <a href="<?php  base_url() ?>admin.html">
                                        <div class="white-box">
                                            <p class="text-center"><i class="fa fa-male fa-5x"></i></p>
                                            <h1 class="text-center">Administrators</h1>
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
   

