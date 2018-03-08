<!DOCTYPE HTML>
<html>
<head>
<title>Studera : Student Management System</title>
<link rel="icon" href="../assets/icons/icon32.png">
<link href="../assets/css/animate.css" rel="stylesheet" type="text/css" media="all"/>
<link href="../assets/css/login.css" rel="stylesheet" type="text/css" media="all"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="This is a student management system being used by Adelayo Academy">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>
<body class="b">
	<?php
		if ($this->session->flashdata('error')) {
			echo'<div class="error"><h3>'.$this->session->flashdata('error').'</h3></div>';
		}
	?>
<div class="login animated bounce">

	<h2>TEACHERS' PORTAL</h2>
		<h2><img src="asset/teacher.png" alt="Studera Logo">
		</h2>
		<form method="post" action="<?php echo base_url() ?>login">
			<input type="text" name="username" placeholder="Username" autofocus required>
			<input type="password" name="password" placeholder="Password" required>
			<div class="send">
				<input type="submit" value="Sign In">
			</div>
        </form>	
	</div>
</div>	
</body>
</html>
