
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="dashboard">
                   <div class="white-box">
                       <h1 class="text-center"><i class="fa fa-briefcase fa-fw"></i>&nbsp; Resources</h1>
                       <p class="text-center"><button class="btn btn-primary" data-toggle="modal" href='#addResourcesModal'><i class="fa fa-plus fa-fw"></i>Add Resources</button></p>
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
                                  <a href="'.base_url().'resourcesCategory/'.$category->ID.'">
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
                </div>
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> &copy; <?php echo date('Y'); ?>. Adelayo Academy Student Management System.</footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

   <div class="modal fade" id="addResourcesModal">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
           <h4 class="modal-title text-center">ADD RESOURCES</h4>
         </div>
         <div class="modal-body">
          <div class="row">
            <form method="post" id="getcatgoryinputform">
                <select class="form-control input-lg getCategoryform" name="resources_category" required>
                  <option value="">Choose Category</option>
                  <option value="1">Ebooks</option>
                  <option value="2">Pictures</option>
                  <option value="3">Animations</option>
                  <option value="4">Videos</option>
                  <option value="5">Web Links</option>
                </select>
            </form>
          </div>
          <br>
          <div class="row">

            <div id="resourcesinputform">
              
            </div>
            
          </div>


         </div>
       </div>
     </div>
   </div>