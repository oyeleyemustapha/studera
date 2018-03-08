
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="dashboard">
                   
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div role="tabpanel">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#personal" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-user fa-fw"></i> Personal Information</a>
                                </li>
                                <li role="presentation">
                                    <a href="#education" aria-controls="tab" role="tab" data-toggle="tab"><i class="fa fa-briefcase fa-fw"></i> Education History</a>
                                </li>
                                <li role="presentation">
                                    <a href="#medical" aria-controls="tab" role="tab" data-toggle="tab"><i class="fa fa-stethoscope fa-fw"></i> Medical Infomation</a>
                                </li>
                                <li role="presentation">
                                    <a href="#contact" aria-controls="tab" role="tab" data-toggle="tab"><i class="fa fa-address-book fa-fw"></i> Contact Information</a>
                                </li>
                            </ul>
                        
                            <!-- Tab panes -->
                            <div class="tab-content info">
                                <div role="tabpanel" class="tab-pane active white-box" id="personal">
                                <div class="row">
                                    <?php

                                    echo'
                                    <p class="text-center"><img src="../assets/studentpic/'.$student_info->PICTURE.'" alt="student"></p>
                                    <div class="col-lg-8 col-lg-offset-2 table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td class="text-center"><i class="fa fa-id-badge fa-fw"></i>ADMISSION NUMBER</td>
                                                    <td>'.$student_info->ADMISSION_NUMBER.'</td>
                                                </tr>

                                                <tr>
                                                    <td class="text-center"><i class="fa fa-user fa-fw"></i>NAME</td>
                                                    <td>'.$student_info->SURNAME." ".$student_info->FIRSTNAME." ".$student_info->OTHERNAME.'</td>
                                                </tr>

                                                 <tr>
                                                    <td class="text-center"><i class="fa fa-male fa-fw"></i>GENDER</td>
                                                    <td>'.$student_info->GENDER.'</td>
                                                </tr>

                                                <tr>
                                                    <td class="text-center"><i class="fa fa-calendar fa-fw"></i>DATE OF BIRTH</td>
                                                    <td>'.date('F d, Y',strtotime($student_info->DOB)).'</td>
                                                </tr>

                                                <tr>
                                                    <td class="text-center"><i class="fa fa-map-marker fa-fw"></i>STATE OF ORIGIN</td>
                                                    <td>'.$student_info->STATE.'</td>
                                                </tr>

                                                <tr>
                                                    <td class="text-center"><i class="fa fa-map-pin fa-fw"></i>LOCAL GOVERNMENT</td>
                                                    <td>'.$student_info->LGA.'</td>
                                                </tr>

                                                <tr>
                                                    <td class="text-center"><i class="fa fa-street-view fa-fw"></i>HOME TOWN</td>
                                                    <td>'.$student_info->HOME_TOWN.'</td>
                                                </tr>

                                                <tr>
                                                    <td class="text-center"><i class="fa fa-building fa-fw"></i>RELIGION</td>
                                                    <td>'.$student_info->RELIGION.'</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                </div>

                                <div role="tabpanel" class="tab-pane white-box" id="education">
                                    <div class="row">
                                        <div class="col-lg-8 col-lg-offset-2 table-responsive">
                                         
                                            <table class="table table-hover table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center"><i class="fa fa-building fa-fw"></i>STUDENT TYPE</td>
                                                        <td>'.$student_info->TYPE.'</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-center"><i class="fa fa-calendar-o fa-fw"></i>YEAR OF ADMISSION</td>
                                                        <td>'.date('F d, Y',strtotime($student_info->YEAR_ADMITTED)).'</td>
                                                    </tr>

                                                    <tr>
                                                        <td class="text-center"><i class="fa fa-building fa-fw"></i>CLASS ADMITED TO</td>
                                                        <td>'.$student_info->CLASS_ADMITTED_TO.'</td>
                                                    </tr>

                                                     <tr>
                                                        <td class="text-center"><i class="fa fa-building fa-fw"></i>DEPARTMENT</td>
                                                        <td>'.$student_info->DEPARTMENT.'</td>
                                                    </tr>

                                                    

                                                    <tr>
                                                        <td class="text-center"><i class="fa fa-home fa-fw"></i>SCHOOLS ATTENDED</td>
                                                        <td>
                                                            '.$student_info->SCHOOL_ATTENDED.'
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                                <div role="tabpanel" class="tab-pane white-box" id="medical">
                                     <div class="row">
                                        <div class="col-lg-8 col-lg-offset-2 table-responsive">
                                     
                                            <table class="table table-hover table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center"><i class="fa fa-heartbeat fa-fw"></i>MEDICAL CONDITION</td>
                                                        <td>'.$student_info->MEDICAL_CONDITION.'</td>
                                                    </tr>

                                                    <tr>
                                                        <td class="text-center"><i class="fa fa-stethoscope fa-fw"></i>SPECIAL MEDICATION</td>
                                                        <td>'.$student_info->SPECIAL_MEDICATION.'</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane white-box" id="contact">
                                     <div class="row">
                                        <div class="col-lg-8 col-lg-offset-2 table-responsive">
                                     
                                            <table class="table table-hover table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center"><i class="fa fa-home fa-fw"></i>HOME ADDRESS</td>
                                                        <td>'.$student_info->HOME_ADDRESS.'</td>
                                                    </tr>

                                                    <tr>
                                                        <td class="text-center"><i class="fa fa-user-circle fa-fw"></i>PARENT/GUARDIAN NAME</td>
                                                        <td>'.$student_info->PARENT_NAME.'</td>
                                                    </tr>

                                                     <tr>
                                                        <td class="text-center"><i class="fa fa-map-marker fa-fw"></i>PARENT/GUARDIAN PHONE</td>
                                                        <td>'.$student_info->PARENT_PHONE.'</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                            '; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
            <br>
            <footer class="footer text-center"> &copy; <?php echo date('Y');  ?>. SAdelayo Academy Student Management System.</footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
   

