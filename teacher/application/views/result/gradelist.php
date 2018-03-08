<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>'../../../assets/icons/icon16.png">
    <title>Grade List | Adelayo Academy</title>
    <link href="<?php echo base_url(); ?>../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>../assets/css/gradelist.css" rel="stylesheet">
</head>
<body class="resultBG">
    <p class="text-center"><img src="<?php echo base_url(); ?>../assets/img/banner.png"></p>

    <h1 class="text-center">Grade List</h1>

    <?php

    if($grade_list){

        switch ($this->input->post('term')) {
            case '1':
                $term="First";
                break;
            case '2':
                $term="Second";
                break;
            case '3':
                $term="Third";
                break;
        }

        echo' <h2 class="text-center"><span>SUBJECT: </span>'.$grade_list[0]->SUBJECT.' | <span>CLASS :</span> '.$_POST["class"].' | <span>TERM :</span> '.$term.' Term | <span>SESSION: </span>'.$_POST["session"].'</h2>';

        echo'<div class="container">

        <div class="alert alert-success">

        </div>
        <button class="btn btn-primary EditscoreBtn">Edit Score</button>
        <div class="clearfix"></div>
        <br>
            <table class="table table-hover table-bordered">
        <thead>
            <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>ADMISSION NO</th>
            <th>1<sup>ST</sup> CA</th>
            <th>2<sup>ND</sup> CA</th>
            <th>3<sup>RD</sup> CA</th>
            <th>EXAM</th>
            <th>TOTAL
            </th>
            </tr>
        </thead>
        <tbody>
        ';

        $counter=1;

        foreach ($grade_list as $grade) {
            if(is_null($grade->CA1)){
                $CA1=0;
            }
            else{
                $CA1=$grade->CA1;
            }
            if(is_null($grade->CA2)){
                $CA2=0;
            }
            else{
                $CA2=$grade->CA2;
            }
            if(is_null($grade->CA3)){
                $CA3=0;
            }
            else{
                $CA3=$grade->CA3;
            }
            $total=$CA1+$CA2+$CA3+$grade->EXAM;
            
            echo"
                 <tr>
                    <td>$counter</td>
                    <td>".strtoupper($grade->SURNAME.' '.$grade->FIRSTNAME.' '.$grade->OTHERNAME)."</td>
                    <td>$grade->ADMISSION_NUMBER</td>
                    <td>$grade->CA1</td>
                    <td>$grade->CA2</td>
                    <td>$grade->CA3</td>
                    <td>$grade->EXAM</td>
                    <td>$total

                    
                        <button class='btn btn-primary btn-xs toggleEditscore' id='$grade->SCORE_ID'>Edit Score</button>

                        <button class='btn btn-danger btn-xs toggleDeletescore' id='$grade->SCORE_ID'>Delete Score</button>
                    </td>
                </tr>
            ";
            $counter++;
        }

        echo'</tbody></table></div>';
    }
    else{
        echo"

            <div class='jumbotron'>
                <h1 class='text-center'>No Result Found</h1>
            </div>
        ";
    }

    ?>


<div class="modal fade" id="editScoreModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title text-center">Edit Scores</h4>
            </div>
            <div class="modal-body">
                
            </div>
            </div>
    </div>
</div>  
           
<script src="<?php echo base_url(); ?>../assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>../assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>../assets/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>asset/teacher.js"></script>
</body>
</html>