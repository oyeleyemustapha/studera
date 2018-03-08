
<div id="page-wrapper">
  <div class="container-fluid">
    <!-- row -->
    <div class="dashboard">
      <div class="row">
        <div class="white-box banner">
          <div class="btn-group">
            <button type="button" class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-plus fa-fw"></i>Add Scores <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a data-toggle="modal" href='#addScoresModal'><i class="fa fa-plus fa-fw"></i>Add Multiple Scores</a></li>
              <li><a data-toggle="modal" href='#addSingleScoresModal'><i class="fa fa-plus fa-fw"></i>Add Single Score</a></li>
            </ul>                 
            <button class="btn btn-danger btn-lg" data-toggle="modal" href='#gradeListModal'><i class="fa fa-file-text fa-fw"></i>Grade List</button>
            


            <?php
                if(!is_null($_SESSION['classes'])){
                  echo'
                       <button class="btn btn-info btn-lg" data-toggle="modal" href="#reportsheetModal"><i class="fa fa-file-text-o fa-fw"></i>Generate Report Card</button>
                      <button class="btn btn-success btn-lg" data-toggle="modal" href="#behaivioutReport"><i class="fa fa-file-text fa-fw"></i>Behaviour Report</button>
                      <button class="btn btn-danger btn-lg" data-toggle="modal" href="#promotionModal"><i class="fa fa-check fa-fw"></i>Promote</button>
                  ';
                }
            ?>
           
          </div>
        </div>
      </div>
                   

      <div class="row">
        <div class="col-lg-12">
          <?php
                                                
                                                if ($this->session->flashdata('message')) {

                                                    echo' <div class="alert alert-info"><h4 class="text-center">'.$this->session->flashdata('message').'</h4></div>';
                                                }
                                            ?>
                                           
                                <div class="white-box banner setting">
                                    <div class="studentList"></div>
                                   
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
   

<!--====ADD MULTIPLE SCORES MODAL==-->

<div class="modal fade" id="addScoresModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center">ADD MULTIPLE SCORES</h4>
            </div>
            <div class="modal-body">
                <form id="addscoresform" method="post">
                   <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-fw fa-book"></i>SCORE TYPE</div>
                            <select class="form-control" name="scoreType" required>
                              <option value="CA">CA</option>
                              <option value="EXAM">EXAM</option>
                            </select>
                          </div>
                    </div>

                   <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-fw fa-book"></i>SUBJECT</div>
                            <select class="form-control" name="subject" required>
                              <?php echo $subjects; ?>
                            </select>
                          </div>
                    </div>

                   <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-building fa-fw"></i> CLASS</div>
                            <select class="form-control input-lg classes" name="class" style="width: 100%" required>
                                <option value="">Select Class</option>
                                <?php echo classes();?>
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
                        <button class="btn btn-primary btn-block">Generate</button>
                </form>
            </div>
           
        </div>
    </div>
</div>

<!--====ADD SINGLE SCORES MODAL==-->

<div class="modal fade" id="addSingleScoresModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center">ADD SINGLE SCORES</h4>
            </div>
            <div class="modal-body">
                <form id="addscoresform" method="post" action="teacher/process_singleScore">

                  <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-fw fa-male"></i>NAME</div>
                            <select class="form-control" name="regNo" id="studentslist" style="width:100%;" required>
                              <option></option>
                             
                            </select>
                          </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-building fa-fw"></i> CLASS</div>
                            <select class="form-control input-lg classes" name="class" style="width: 100%" required>
                                <option value="">Select Class</option>
                                <?php echo classes();?>
                            </select>
                        </div>
                    </div>

                   <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-fw fa-book"></i>SCORE TYPE</div>
                            <select class="form-control" name="scoreType" id="scoreType" required>
                              <option>Score type</option>
                              <option value="CA">CA</option>
                              <option value="EXAM">EXAM</option>
                            </select>
                          </div>
                    </div>
                    <div class="newForm"></div>

                   <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-fw fa-book"></i>SUBJECT</div>
                            <select class="form-control" name="subject" required>
                              <?php echo $subjects; ?>
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
                        <button class="btn btn-primary btn-block">Generate</button>
                </form>
            </div>
           
        </div>
    </div>
</div>

<!--====GRADE LIST MODAL==-->
<div class="modal fade" id="gradeListModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center">Generate Grade List</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url(); ?>gradelist" method="post" target="_blank">
                    <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-fw fa-book"></i>SUBJECT</div>
                            <select class="form-control" name="subject" required>
                              <?php echo $subjects; ?>
                            </select>
                          </div>
                    </div>

                   <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-building fa-fw"></i> CLASS</div>
                            <select class="form-control input-lg classes" name="class" style="width: 100%" required>
                                <option value="">Select Class</option>
                                <?php echo classes();?>
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
                        <button class="btn btn-primary btn-block">Generate</button>
                </form>
            </div>
           
        </div>
    </div>
</div>





<!--====REPORT SHEET MODAL==-->
<div class="modal fade" id="reportsheetModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center">Generate Report Sheet</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="reportcardform">
                   <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-fw fa-book"></i>TYPE</div>
                            <select class="form-control" name="type" required>
                              <option value="CA">CA</option>
                               <option value="EXAM">EXAM</option>
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
                                <?php session_year(); ?>
                            </select>
                        </div>
                    </div>

                   <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-building fa-fw"></i> CLASS</div>
                             <select class="form-control input-lg" name="class" required>
                                <option value="">Select Class</option>
                                <?php echo $classes;?>
                            </select>
                        </div>
                    </div>
       
                        <button class="btn btn-primary btn-block">Generate</button>
                </form>
            </div>
           
        </div>
    </div>
</div>



<!--====PROMOTION MODAL==-->
<div class="modal fade" id="promotionModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center">Promote Students</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="promotionForm">
                  
                   <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-building fa-fw"></i>PRESENT CLASS</div>
                             <select class="form-control input-lg" name="presentClass" required>
                                <option value="">Select Class</option>
                                <?php echo $classes;?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-building fa-fw"></i>PROMOTE TO</div>
                             <select class="form-control input-lg classes" name="promoteClass" style="width: 100%" required>
                                <option value="">Select Class</option>
                                <?php echo classes();?>
                            </select>
                        </div>
                    </div>
       
                        <button class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
           
        </div>
    </div>
</div>


<!--====BEHAIVOURAL MODAL==-->
<div class="modal fade" id="behaivioutReport">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center">Enter Behaivour Report</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="getBehaivourReportform">
                  
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
                                <?php session_year(); ?>
                            </select>
                        </div>
                    </div>

                   <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-building fa-fw"></i> CLASS</div>
                             <select class="form-control input-lg" name="class"  required>
                                <option value="">Select Class</option>
                                <?php echo $classes;?>
                            </select>
                        </div>
                    </div>
       
                        <button class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
           
        </div>
    </div>
</div>


