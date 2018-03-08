
        <div id="page-wrapper">
            <div class="container-fluid">
                
                <!-- row -->
                <div class="dashboard">
                   
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="white-box">
                                        
                            <h1 class="text-center">Welcome, <?php echo $_SESSION['teacher_name']; ?></h1>
                                    </div>
                        <div class="row dashboardMenu">
                            <div class="col-lg-6 col-sm-6">
                                <a href="<?php  base_url() ?>students.html">
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
                                        <h1 class="text-center">Results</h1>
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
   

