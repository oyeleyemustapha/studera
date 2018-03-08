
        <div id="page-wrapper">
            <div class="container-fluid">
                
                <!-- row -->
                <div class="dashboard">

                   
                  
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div class="white-box row">
                            <div class="col-lg-12">
                                <h1 class="text-center">Performance Trend</h1>

                                <form class="form-inline col-lg-12 col-lg-offset-2 trendForm" method="post" action="">
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-6">
                                                <div class="input-group">
                                                   <div class="input-group-addon"><i class="fa fa-book fa-fw"></i> SUBJECT</div>
                                                   <select class="form-control input-lg" name="subject" required>
                                                      <option value="">Select Subject</option>
                                                      <?php
                                                        echo $subjects;
                                                      ?>
                                                   </select>
                                                </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-4">
                                                <div class="input-group">
                                                   <div class="input-group-addon"><i class="fa fa-building fa-fw"></i> CLASS</div>
                                                   <select class="form-control input-lg" name="class" required>
                                                      <option value="">Select Class</option>
                                                      <?php
                                                        echo senior_classes();
                                                      ?>
                                                   </select>
                                                </div>
                                        </div>

                                        <div class="col-lg-4 col-sm-2">  <button class="btn btn-info btn-lg" name="generate">Generate</button></div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="white-box row">
                            <div class="col-lg-6 col-lg-offset-3 trend"><canvas id="trend" width="250" height="150"></canvas></div>
                            
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
   

<form action="" method="POST" class="form-inline" role="form">


    

    <button type="submit" class="btn btn-primary">Submit</button>
</form>