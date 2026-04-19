<?php
if (!isset($title)) {
    $title = "Student System | Admin";
}
include_once $_SERVER['DOCUMENT_ROOT'] . "/Student_System/config.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Student Management System">
    <meta name="author" content="AdminKit">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="<?php echo $url; ?>Assets/img/icons/icon-48x48.png" />

    <title><?php echo $title; ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    
    <link href="<?php echo $url; ?>Assets/css/app.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="<?php echo $url; ?>index.php">
                    <span class="align-middle">Student System</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">Main Menu</li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?php echo $url; ?>index.php">
                            <i class="fa-solid fa-house align-middle"></i> 
                            <span class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?php echo $url; ?>Students/index.php">
                            <i class="fa-solid fa-user-graduate align-middle"></i> 
                            <span class="align-middle">Students</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?php echo $url; ?>Departments/index.php">
                            <i class="fa-solid fa-building-columns align-middle"></i> 
                            <span class="align-middle">Departments</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?php echo $url; ?>Courses/index.php">
                            <i class="fa-solid fa-list"></i> 
                            <span class="align-middle">Courses</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?php echo $url; ?>Lecturers/index.php">
                            <i class="fa-solid fa-person"></i> 
                            <span class="align-middle">Lecturers</span>
                        </a>
                    </li>

                    <li class="sidebar-header">Account</li>
                    
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="fa-solid fa-gear align-middle"></i> 
                            <span class="align-middle">Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <img src="<?php echo $url; ?>Assets/img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1" alt="Admin" /> 
                                <span class="text-dark">Administrator</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo $url; ?>logout.php">Log out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>