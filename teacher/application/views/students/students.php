
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="dashboard">
                   <div class="white-box">
                       <h1 class="text-center"><i class="fa fa-users fa-fw"></i>&nbsp; STUDENTS</h1>
                   </div>
                   <div class="white-box">
                    <div class="row">
                     
                      <?php
                            if($this->session->flashdata('message')){
                              echo"<div class='alert alert-info'><h1 class='text-center'>".$this->session->flashdata('message')."</h1></div>";
                            }
                            
                          ?>
                      <div class="col-lg-12">

                        <?php
                          if(!is_null($_SESSION['classes'])){
                            echo "<button class='btn btn-danger btn-lg' data-toggle='modal' href='#generateStudentlistModal'>Student List</button>";
                          }
                        ?>
                        <h1 class="text-center">Search Student Record</h1>
                        <div class="searchStudent">
                          <form method="post">
                            <div class="form-group">
                              <input type="text" class="form-control input-lg" placeholder="Type Name or Student Number" required name="searchStudent">
                            </div>
                          </form>
                          <div class="searchresult">
                          </div>
                        </div>


                        
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
  

  <div class="modal fade" id="generateStudentlistModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title text-center">Generate Student List</h4>
        </div>
        <div class="modal-body">
          <form method="post" target="_blank" action="<?php echo base_url() ?>studentlist">
            <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-building fa-fw"></i> CLASS</div>
                             <select class="form-control input-lg" name="class" required>
                                <option value="">Select Class</option>
                                <?php echo $classes;?>
                            </select>
                        </div>
                    </div>

                    <button class="btn btn-warning">Generate List</button>
          </form>
        </div>
      </div>
    </div>
  </div>