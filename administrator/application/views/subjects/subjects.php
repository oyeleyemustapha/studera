
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="dashboard">
                   <div class="white-box">
                       <h1 class="text-center"><i class="fa fa-book fa-fw"></i>&nbsp; SUBJECTS</h1>
                   </div>
                   <div class="white-box">
                       <div class="row">
                        <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2">
                          <?php
                            if($this->session->flashdata('message')){
                              echo"<div class='alert alert-info'><h1 class='text-center'>".$this->session->flashdata('message')."</h1></div>";
                            }

                          ?>
                         <form method="post" action="<?php echo base_url(); ?>addSubject">
                            <div class="input-group">
                              <input type="text" class="form-control input-lg"  name="subject" placeholder="Subject" required>
                              <span class="input-group-btn input-group-lg">
                                <button type="submit" class="btn btn-danger btn-lg"><i class="fa fa-plus fa-fw"></i>Add</button>
                              </span>
                            </div>
                         </form>

                         <br>
                         <?php

                        

                            if($subjects){
                                  echo'<table class="table table-hover table-striped table-bordered table-condensed classList subjects display">
                                   <thead>
                                     <tr>
                                       <th>ID</th>
                                       <th>SUBJECT</th>
                                       <th></th>
                                     </tr>
                                   </thead>
                                   <tbody>';
                            }
                            $counter=1;
                            foreach ($subjects as $subject) {
                             
                              echo"
                                 <tr>
                                   <td>$counter</td>
                                   <td>$subject->SUBJECT</td>
                                   <td><a href='#' id='$subject->SUBJECT_ID' class='btn btn-warning editSubject'><i class='fa fa-edit fa-fw'></i> Edit</a> 
                                   <a href='".base_url()."deleteSubject/$subject->SUBJECT_ID' class='btn btn-danger'><i class='fa fa-trash fa-fw'></i> Delete</a></td>
                                 </tr>
                              ";
                              $counter++;
                            }
                            echo' </tbody></table>';

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
   <div class="modal fade" id="modal-id">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h4 class="modal-title text-center">UPDATE SUBJECT</h4>
         </div>
         <div class="modal-body">
           
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
       </div>
     </div>
   </div>
