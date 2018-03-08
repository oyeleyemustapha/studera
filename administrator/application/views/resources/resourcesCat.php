
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="dashboard">
                   <div class="white-box">
                       <h1 class="text-center"> <?php echo $resources[0]->CATEGORY; ?></h1>
                   </div>
                   <div class="white-box">
                       <div class="row">
                        <div class="col-lg-12">
                          <?php
                            if($this->session->flashdata('message')){
                              echo"<div class='alert alert-info'><h1 class='text-center'>".$this->session->flashdata('message')."</h1></div>";
                            }

                          ?>

                        <br>
                         <div class='row resources'>
                       <?php
                          if($resources){


                            
                            echo'  
                            <div class="table-responsive col-lg-8 col-lg-offset-2">
                               <table class="table table-hover table-striped table-bordered">
                                 <thead>
                                   <tr>
                                     <th>ID</th>
                                     <th>RESOURCES</th>
                                     <th></th>
                                   </tr>
                                 </thead>
                                 <tbody>
                            ';
                            $counter=1;
                            foreach ($resources as $resources) {

                              switch ($resources->CATEGORY) {
                                case 'Links':
                                  $link="<a href='$resources->RESOURCES' target='_blank'>$resources->TITLE</a>";
                                  break;

                                case 'Ebooks':
                                  $link="<a href='".base_url()."../assets/myResources/$resources->RESOURCES' target='_blank'>$resources->TITLE</a>";
                                  break;

                                case 'Pictures':
                                  $link="<a href='".base_url()."../assets/myResources/$resources->RESOURCES' target='_blank'>$resources->TITLE</a>";
                                  break;

                                case 'Videos':
                                  $link="<a href='".base_url()."../assets/myResources/$resources->RESOURCES' target='_blank'>$resources->TITLE</a>";
                                  break;

                                case 'Animations':
                                  $link="<a href='".base_url()."../assets/myResources/$resources->RESOURCES' target='_blank'>$resources->TITLE</a>";
                                  break;
                                
                                default:
                                   $link="<a href='".base_url()."../assets/myResources/$resources->RESOURCES' target='_blank'>$resources->TITLE</a>";
                                  break;
                              }
                              echo"
                                  <tr>
                                   <td>$counter</td>
                                    <td>$link</td>
                                    <td><a href='".base_url()."deleteResource/".$resources->ID."' class='btn btn-danger'>Delete</a></td>
                                 </tr>
                              ";
                              $counter++;
                            }
                            echo'</tbody></table></div>';
                          }
                          else{
                            echo'
                              <div class="col-lg-8 col-lg-offset-2 well">
                                <h1 class="text-center">No Learning Resources found in this Category</h1>
                              </div>
                            ';
                          }

                       ?>
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

   