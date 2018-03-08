<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>'../../../assets/icons/icon16.png">
    <title>Score Sheet | Adelayo Academy</title>
    <link href="<?php echo base_url(); ?>../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>../assets/css/gradelist.css" rel="stylesheet">
</head>
<body class="resultBG">
    <p class="text-center"><img src="<?php echo base_url(); ?>../assets/img/banner.png"></p>

    <h1 class="text-center">CA SCORE SHEET</h1>

    <?php

    if($students){

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

        echo' <h2 class="text-center"><span>SUBJECT: </span> ____________________________ | <span>CLASS :</span> '.$_POST["class"].' | <span>TERM :</span> '.$term.' Term | <span>SESSION: </span>'.$_POST["session"].'</h2>';


        
          //IF THE CLASS IS J.S.S.3 OR S.S.3 USE THIS TABLE
        if (preg_match("/^S.S.3/", $_POST["class"])) {
            echo'<div class="container">
            <br>
            <table class="table table-hover table-bordered">
            <thead>
                <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>REGISTRATION NUMBER</th>
                <th>SCORES (100 marks)</th>
                </th>
                </tr>
            </thead>
            <tbody>
            ';
            $counter=1;
            foreach ($students as $student) {
                
                echo"
                     <tr>
                        <td>$counter</td>
                        <td>".strtoupper($student->SURNAME.' '.$student->FIRSTNAME.' '.$student->OTHERNAME)."</td>
                        <td>$student->ADMISSION_NUMBER</td>
                        <td></td>
                    </tr>
                ";
                $counter++;
            }
        }
        else{
            //IF THE CLASS IS J.S.S.1-J.S.S.2 OR S.S.1-S.S.2 USE THIS TABLE
            echo'<div class="container">
            <br>
            <table class="table table-hover table-bordered">
            <thead>
                <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>REGISTRATION NUMBER</th>
                <th>1<sup>ST</sup> CA (10mks)</th>
                <th>2<sup>ND</sup> CA (10mks)</th>
                </th>
                </tr>
            </thead>
            <tbody>
            ';

            $counter=1;
            foreach ($students as $student) {
                
                echo"
                     <tr>
                        <td>$counter</td>
                        <td>".strtoupper($student->SURNAME.' '.$student->FIRSTNAME.' '.$student->OTHERNAME)."</td>
                        <td>$student->ADMISSION_NUMBER</td>
                        <td></td>
                        <td></td>
                    </tr>
                ";
                $counter++;
            }
        }
       

       


        echo'</tbody></table>
        <h3>Teacher\'s Name _________________________________</h3>
         <h3 class="text-right">Signature___________________ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date__________________</h3>
        </div>
        ';
    }
    else{
        echo"

            <div class='jumbotron'>
                <h1 class='text-center'>No Result Found</h1>
            </div>
        ";
    }

    ?>

</body>
</html>