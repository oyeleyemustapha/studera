<?php

echo'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="'.base_url().'../assets/icons/icon16.png">
    <title>Studera : '.$title.' </title>
    <link href="'.base_url().'../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="'.base_url().'../assets/css/sidebar-nav.min.css" rel="stylesheet">
    <link href="'.base_url().'../assets/font/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="'.base_url().'../assets/css/style.css" rel="stylesheet">
    <link href="'.base_url().'../assets/css/colors/default-dark.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <div class="loading"> 
        <div class="loader"></div>
    </div>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="fa fa-bars"></i></a>
                <div class="top-left-part"><a class="logo" href=""><img src="'.base_url().'../assets/icons/icon32.png" class="hidden-lg" alt="Studera logo"><span class="hidden-xs">Studera</span></a></div>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li>
                        <a class="profile-pic " class="dropdown-toggle" data-toggle="dropdown" href="#"> <i class="fa fa-user-circle-o fa-2x fa-fw "></i>'.$student_info->FIRSTNAME.' <span class="caret"></span></a>
                         <ul class="dropdown-menu" aria-labelledby="themes">
                            <li><a href="'.base_url().'profile.html"><i class="fa fa-male fa-fw"></i> Profile</a></li>
                            <li><a href="'.base_url().'logout.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>


        <!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">

                <p class="text-center"><img src="'.base_url().'../assets/icons/icon128.png" class="hidden-xs hidden-sm hidden-md"></p>
                <ul class="nav" id="side-menu">
                    <li style="padding: 10px 0 0;">
                        <a href="'.base_url().'dashboard.html" class="waves-effect"><i class="fa fa-home fa-fw" aria-hidden="true"></i><span class="hide-menu">Dashboard</span></a>
                    </li>
                     <li style="padding: 10px 0 0;">
                        <a href="'.base_url().'record.html" class="waves-effect"><i class="fa fa-folder-open fa-fw" aria-hidden="true"></i><span class="hide-menu">My Record</span></a>
                    </li>

                    <li style="padding: 10px 0 0;">
                        <a href="'.base_url().'result.html" class="waves-effect"><i class="fa fa-file-text fa-fw" aria-hidden="true"></i><span class="hide-menu">Result</span></a>
                    </li>

                    <li style="padding: 10px 0 0;">
                        <a href="'.base_url().'resources/category.html" class="waves-effect"><i class="fa fa-book fa-fw" aria-hidden="true"></i><span class="hide-menu">Resources</span></a>
                    </li>
                </ul> 
            </div>
        </div>


        <!-- Left navbar-header end -->
        <!-- Page Content -->


';



?>