<?php

if($adminInfo){
  echo'


  <form method="post" action="'.base_url().'editAdmin">
    <input type="hidden" value="'.$adminInfo->ADMIN_ID.'" name="admin_id">
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-fw fa-male"></i>NAME</div>
                <input type="text" class="form-control" name="name" value="'.$adminInfo->NAME.'" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-fw fa-user"></i>USERNAME</div>
                <input type="text" name="username" class="form-control" value="'.$adminInfo->USERNAME.'" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-fw fa-key"></i>PASSWORD</div>
                <input type="password" name="password" class="form-control" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-fw fa-key"></i>CONFIRM PASSWORD</div>
                <input type="password" name="cpassword" class="form-control" required>
              </div>
            </div>

            <button class="btn btn-primary btn-block">UPDATE</button>
          </form>
  ';
}

?>