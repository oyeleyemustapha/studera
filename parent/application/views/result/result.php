
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="dashboard">
                   <div class="white-box">
                       <h1 class="text-center">Generate Report Sheet</h1>
                       <div class="row">
                       <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2">
                       
                           <form method="post" action="<?php echo base_url() ?>reports" target="_blank">
                                

                                 <div class="form-group">
                                    <div class="input-group">
                                       <div class="input-group-addon"><i class="fa fa-building fa-fw"></i> CLASS</div>
                                       <select class="form-control input-lg" name="class" required>
                                          <option value="">Select Class</option>
                                          <?php
                                            echo classes();
                                          ?>
                                       </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                       <div class="input-group-addon"><i class="fa fa-file-text fa-fw"></i>TYPE</div>
                                       <select class="form-control input-lg" name="type" required>
                                           <option value="CA">CA</option>
                                           <option value="EXAM">EXAMINATION</option>
                                       </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                       <div class="input-group-addon"><i class="fa fa-calendar-o fa-fw"></i> TERM</div>
                                       <select class="form-control input-lg" name="term" required>
                                           <option value="1">First Term</option>
                                           <option value="2">Second Term</option>
                                           <option value="3">Third Term</option>
                                       </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                       <div class="input-group-addon"><i class="fa fa-calendar fa-fw"></i> SESSION</div>
                                       <select class="form-control input-lg" name="session" required>
                                           <?php
                                              session_year();
                                           ?>
                                       </select>
                                    </div>
                                </div>

                                <button class="btn btn-info btn-block btn-lg">Generate</button>

                            </form>
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
   
