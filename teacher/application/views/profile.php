
        <div id="page-wrapper">
            <div class="container-fluid">
                
                <!-- row -->
                <div class="dashboard">
                   
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">



                        <div class="row">
                            

                            <div class="col-lg-12">
                                
                                    <div class="white-box teacherProfile">
                                        <div class="btn-group pull-right">
                                            <button class="btn btn-primary btn-sm" data-toggle="modal" href='#editAInfoModal'><i class="fa fa-edit fa-fw"></i>Edit Information</button>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal" href='#editAccountModal'><i class="fa fa-edit fa-fw"></i>Edit Login Details</button>
                                        </div>
                                        <div class="clearfix"></div>
                                        <br>
                        
                                        <div class="row">
                                        <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
                                            <h1 class="text-center">My Profile</h1>
                                             
                                            <?php

                                             if($this->session->flashdata('message')){
                                                  echo"<div class='alert alert-info'><h1 class='text-center'>".$this->session->flashdata('message')."</h1></div>";
                                                }

                                                if($_SESSION['email']){
                                                    $email=$_SESSION['email'];
                                                }
                                                else{
                                                    $email="";
                                                }

                                                if($_SESSION['phone']){
                                                    $phone=$_SESSION['phone'];
                                                }
                                                else{
                                                    $phone="";
                                                }

                                                if($_SESSION['subject']){
                                                    $subject=explode(',', $_SESSION['subject']);
                                                    $subject_list='';
                                                    foreach ($subject as $subject) {
                                                        $subject_list.=", ".$this->teacher_model->get_subject_name($subject)->SUBJECT;


                                                    }
                                                }
                                                else{
                                                     $subject_list='';
                                                }

                                                if($_SESSION['classes']){
                                                    $class=explode(',', $_SESSION['classes']);
                                                    $class_list='';
                                                    foreach ($class as $class) {
                                                        $class_list.=", ".$this->teacher_model->get_class_name($class)->CLASS;

                                                        
                                                    }
                                                }
                                                else{
                                                     $class_list='';
                                                }


                                                echo'
                                                     <ul class="list-group">
                                                        <li class="list-group-item"><span>NAME : </span>'.$_SESSION["teacher_name"].'</li>
                                                        <li class="list-group-item"><span>USERNAME : </span>'.$_SESSION["username"].'</li>
                                                        <li class="list-group-item"><span>EMAIL : </span>'.$email.'</li>
                                                        <li class="list-group-item"><span>PHONE : </span>'.$phone.'</li>
                                                        <li class="list-group-item"><span>SUBJECT : </span>'. $subject_list.'</li>
                                                        <li class="list-group-item"><span>CLASS : </span>'.$class_list.'</li>
                                                    </ul>
                                                ';

                                            ?>
                                           
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
            <footer class="footer text-center"> &copy; <?php echo date('Y');  ?>. Adelayo Academy Student Management System.</footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
   
<!--UPDATE LOGIN DETAIL MODAL-->
<div class="modal fade" id="editAccountModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center">Update Login Details</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url(); ?>updateLogin" method="post">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">USERNAME</div>
                            <input type="text" class="form-control" name="username" value="<?php echo $_SESSION['username']; ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">PASSWORD</div>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                    </div>

                    <button class="btn btn-danger">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--UPDATE INFORMATION DETAIL MODAL-->
<div class="modal fade" id="editAInfoModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center">Update Information</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url(); ?>updateInfo" method="post">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">NAME</div>
                            <input type="text" class="form-control" name="name" value="<?php echo $_SESSION['teacher_name']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">EMAIL</div>
                            <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">PHONE</div>
                            <input type="tel" class="form-control" name="phone" value="<?php echo $phone; ?>">
                        </div>
                    </div>


                    

                    <button class="btn btn-danger">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
