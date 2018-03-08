
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="dashboard">
                   <div class="white-box">
                       <h1 class="text-center"><i class="fa fa-users fa-fw"></i>&nbsp; STUDENTS</h1>
                   </div>
                   <div class="white-box">
                    <div class="row">
                      <button class="btn btn-danger pull-right TogglecreateRecord"><i class="fa fa-pencil fa-fw"></i>Create Record</button>
                      <div class="clearfix"></div><br>
                      <?php
                            if($this->session->flashdata('message')){
                              echo"<div class='alert alert-info'><h1 class='text-center'>".$this->session->flashdata('message')."</h1></div>";
                            }
                            
                          ?>
                      <div class="col-lg-12">

                        <div class="searchStudent">
                          <form method="post">
                            <div class="form-group">
                              <input type="text" class="form-control input-lg" placeholder="Type Name or Student Number" required name="searchStudent">
                            </div>
                          </form>
                          <div class="searchresult">
                          </div>
                        </div>


                        <form method="post" action="<?php echo base_url()?>createStudent" id="addStudent" enctype="multipart/form-data">
                                 <table class="table table-user-information">
                                    <tbody>
                                      <tr>
                                        <td><strong>FIRSTNAME : </strong></td>
                                        <td><input type="text" name="fname" class="form-control" required></td>
                                      </tr>

                                      <tr>
                                        <td><strong>SURNAME : </strong></td>
                                        <td><input type="text" name="sname" class="form-control" required></td>
                                      </tr>

                                      <tr>
                                        <td><strong>OTHERNAME : </strong></td>
                                        <td><input type="text" name="oname" class="form-control"></td>
                                      </tr>

                                      <tr>
                                        <td><strong>ADMISSION NUMBER : </strong></td>
                                        <td><input type="text" name="admission_no" class="form-control" required></td>
                                      </tr>

                                       <tr>
                                        <td><strong>PRESENT CLASS : </strong></td>
                                        <td><select class="form-control input-lg classes" name="class" style="width: 100%" required>
                                <option value="">Select Class</option>
                                <?php echo classes();?>
                            </select></td>
                                      </tr>


                                      <tr>
                                        <td><strong>GENDER : </strong></td>
                                        <td><select name="gender" class="form-control">
                                              <option value="Male">Male</option>
                                              <option value="Female">Female</option>
                                            </select>
                                        </td>
                                      </tr>

                                       <tr>
                                        <td><strong>DATE OF BIRTH : </strong></td>
                                        <td><input type="date" name="dob" class="form-control"></td>
                                      </tr>

                                       <tr>
                                        <td><strong>STATE OF ORIGIN: </strong></td>
                                        <td><input type="text" name="state" class="form-control"></td>
                                      </tr>

                                       <tr>
                                        <td><strong>LOCAL GOVERNMENT AREA : </strong></td>
                                        <td><input type="text" name="lga" class="form-control"></td>
                                      </tr>

                                       <tr>
                                        <td><strong>HOME TOWN : </strong></td>
                                        <td><input type="text" name="town" class="form-control"></td>
                                      </tr>

                                       <tr>
                                        <td><strong>RELIGION : </strong></td>
                                        <td><input type="text" name="religion" class="form-control"></td>
                                      </tr>

                                       <tr>
                                        <td><strong>YEAR ADMITTED : </strong></td>
                                        <td><input type="text" name="YearAdmitted" class="form-control"></td>
                                      </tr>

                                      <tr>
                                        <td><strong>CLASS ADMITTED TO : </strong></td>
                                        <td><input type="text" name="classAdmitted" class="form-control"></td>
                                      </tr>

                                      <tr>
                                        <td><strong>DEPARTMENT : </strong></td>
                                        <td>
                                            
                                            <select name="dept" class="form-control">
                                             
                                              <option value="Science">Science</option>
                                              <option value="Commercial">Commercial</option>
                                               <option value="Arts">Arts</option>
                                            </select></td>
                                        </td>
                                      </tr>

                                      <tr>
                                        <td><strong>SCHOOL ATTENDED : </strong></td>
                                        <td><input type="text" name="school" class="form-control"></td>
                                      </tr>

                                      <tr>
                                        <td><strong>MEDICAL CONDITION : </strong></td>
                                        <td><input type="text" name="medical" class="form-control"></td>
                                      </tr>

                                      <tr>
                                        <td><strong>SPECIAL MEDICATION : </strong></td>
                                        <td><input type="text" name="medication" class="form-control"></td>
                                      </tr>

                                      <tr>
                                        <td><strong>HOME ADDRESS : </strong></td>
                                        <td><input type="text" name="home" class="form-control"></td>
                                      </tr>

                                      <tr>
                                        <td><strong>PARENT/GUARDIAN NAME : </strong></td>
                                        <td><input type="text" name="parentName" class="form-control"></td>
                                      </tr>

                                      <tr>
                                        <td><strong>PARENT/GUARDIAN PHONE: </strong></td>
                                        <td><input type="text" name="parentPhone" class="form-control"></td>
                                      </tr>

                                      <tr>
                                        <td><strong>STUDENT TYPE : </strong></td>
                                        <td><select name="studentType" class="form-control">
                                              <option value="Day">Day</option>
                                              <option value="Boarder">Boarder</option>
                                            </select></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                <button class="btn btn-primary">Add Record</button>
                            
                        
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
  
  