
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="dashboard">
                   <div class="white-box">
                       <h1 class="text-center">Learning Resources</h1>
                        <div class='row resources'>
                       <?php
                          if($category){


                            
                            echo'  
                            <div class="table-responsive col-lg-8 col-lg-offset-2">
                               <table class="table table-hover table-striped table-bordered">
                                 <thead>
                                   <tr>
                                     <th>ID</th>
                                     <th>RESOURCES</th>
                                   </tr>
                                 </thead>
                                 <tbody>
                            ';
                            $counter=1;
                            foreach ($category as $resources) {

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
            <!-- /.container-fluid -->
            <footer class="footer text-center"> &copy; <?php echo date('Y'); ?>. Studera Student Management System.</footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
   
