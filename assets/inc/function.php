<?php

function classes(){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "studera";
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "SELECT CLASS FROM class ORDER BY CLASS ASC";
	$result = $conn->query($sql);
    $option="";
	if ($result->num_rows > 0) {

	    while($row = $result->fetch_assoc()) {
	    	$option.="<option value='". $row['CLASS']."'>". $row['CLASS']."</option>";
	    }
	} 
	return $option;
	$conn->close();
}


function senior_classes(){
	return "
	<option value='J.S.S.1'>J.S.S.1</option>
	<option value='J.S.S.2'>J.S.S.2</option>
	<option value='J.S.S.3'>J.S.S.3</option>
	<option value='S.S.1'>S.S.1</option>
	<option value='S.S.2'>S.S.2</option>
	<option value='S.S.3'>S.S.3</option>
	";
}



function session_year(){
	$date1=date('Y')-1;
    $date2=date('Y');
    $count=1;
    while($count<=10){echo "<option value='$date1/$date2'>$date1/$date2</option>\n";
        $date2--;
        $date1--;
        $count++;
    }
}


//GET GRADE FOR CA (J.S.S.1-S.S.2)
function getCA_grade_junior($score){
	if($score>=17 && $score<=20){
		$grade="A";
	}
	elseif($score>=13 && $score<=16){
		$grade="B";
	}
	elseif($score>=9 && $score<=12){
		$grade="C";
	}
	elseif($score>=5 && $score<=8){
		$grade="D";
	}
	elseif($score>=0 && $score<=4){
		$grade="E";
	}
	return $grade;
}

//GET GRADE FOR CA (S.S.3)
function getCA_grade_senior($score){
	if($score>=75){ $grade="A1"; $remark="DISTINCTION";}
	elseif($score>=70 && $score<=74){ $grade="B2";  $remark="VERY GOOD";}
	elseif($score>=65 && $score<=69){ $grade="B3";  $remark="GOOD";}
	elseif($score>=60 && $score<=64){ $grade="C4";  $remark="CREDIT";}
	elseif($score>=55 && $score<=59){ $grade="C5";  $remark="CREDIT";}
	elseif($score>=50 && $score<=54){ $grade="C6";  $remark="CREDIT";}
	elseif($score>=45 && $score<=49){ $grade="D7";  $remark="PASS";}
	elseif($score>=40 && $score<=44){ $grade="E8";  $remark="PASS";}
	else{ $grade="F9"; $remark="FAIL";}
	return $grade=[$grade,$remark];
}

//GET GRADE FOR S.S.1-S.S.3 STUDENT (EXAMINATION RESULT)
function getgradeExamSS($score){
	if($score>=75){ $grade="A1"; $remark="DISTINCTION";}
	elseif($score>=70 && $score<=74){ $grade="B2";  $remark="VERY GOOD";}
	elseif($score>=65 && $score<=69){ $grade="B3";  $remark="GOOD";}
	elseif($score>=60 && $score<=64){ $grade="C4";  $remark="CREDIT";}
	elseif($score>=55 && $score<=59){ $grade="C5";  $remark="CREDIT";}
	elseif($score>=50 && $score<=54){ $grade="C6";  $remark="CREDIT";}
	elseif($score>=45 && $score<=49){ $grade="D7";  $remark="PASS";}
	elseif($score>=40 && $score<=44){ $grade="E8";  $remark="PASS";}
	else{ $grade="F9"; $remark="FAIL";}
	return $grade=[$grade,$remark];
}

//GET GRADE FOR J.S.S.1-J.S.S.3 STUDENT (EXAMINATION RESULT)
function getgradeExamJSS($score){
	if($score>=70){ $grade="A"; $remark="DISTINCTION";}
	elseif($score>=60 && $score<=69){ $grade="B";  $remark="GOOD";}
	elseif($score>=50 && $score<=59){ $grade="C";  $remark="CREDIT";}
	elseif($score>=40 && $score<=49){ $grade="P";  $remark="PASS";}
	else{ $grade="F"; $remark="FAIL";}
	return $grade=[$grade,$remark];
}









?>