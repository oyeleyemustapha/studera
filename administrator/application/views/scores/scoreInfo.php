<?php


if($score_info){
    echo'
    <form method="post" id="updatescoreForm">
        <input type="hidden" name="score_id" value="'.$score_info->SCORE_ID.'">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-building fa-fw"></i> NAME</div>
                   <input type="text" class="form-control" value="'.$score_info->SURNAME.' '.$score_info->FIRSTNAME.' '.$score_info->OTHERNAME.'" disabled>
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-building fa-fw"></i> ADMISSION NUMBER</div>
                   <input type="text" class="form-control" value="'.$score_info->ADMISSION_NUMBER.'" disabled>
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-building fa-fw"></i> 1<sup>ST</sup> CA</div>
                   <input type="text" class="form-control" value="'.$score_info->CA1.'" name="ca1">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-building fa-fw"></i> 2<sup>ND</sup> CA</div>
                   <input type="text" class="form-control" value="'.$score_info->CA2.'" name="ca2">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-building fa-fw"></i> 3<sup>RD</sup> CA</div>
                   <input type="text" class="form-control" value="'.$score_info->CA3.'" name="ca3">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-building fa-fw"></i> EXAM SCORE</div>
                   <input type="text" class="form-control" value="'.$score_info->EXAM.'" name="exam">
            </div>
        </div>

        <button class="btn btn-primary">Update Course</button>

        </form>

    ';
}


?>