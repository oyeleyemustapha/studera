
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="dashboard">
                   <div class="white-box">
                       <h1 class="text-center">Learning Resources</h1>
                        <div class='row resources'>
                       <?php
                      

                        if($category){

                          

                          foreach ($category as $category) {
                            switch ($category->CATEGORY) {
                              case 'Ebooks':
                                $icon="fa-book";
                                break;

                              case 'Pictures':
                                $icon="fa-image";
                                break;

                              case 'Videos':
                                $icon="fa-film";
                                break;

                              case 'Links':
                                $icon="fa-link";
                                break;

                              case 'Animations':
                                $icon="fa-file-movie-o";
                                break;

                              default:
                                $icon="fa-file";
                                break;
                            }
                            echo'
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                  <a href="'.base_url().'resources/'.$category->ID.'">
                                    <div class="well">
                                      <h1 class="text-center"><i class="fa '.$icon.' fa-2x"></i></h1>
                                      <h1 class="text-center">'.$category->CATEGORY.'</h1>
                                      <p class="text-center"><span class="badge">'.$category->TOTAL.' '.strtolower($category->CATEGORY).'</span></p>
                                    </div>
                                  </a>
                                </div>
                            ';
                          }
                         
                        }
                        else{
                          echo"

                            <div class='well col-lg-8 col-lg-offset-2'>
                              <h1 class='text-center'>
                              <i class='fa fa-exclamation-triangle fa-2x'></i><br>
                              No Learning Resources Available</h1>
                            </div>


                          ";
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
   
