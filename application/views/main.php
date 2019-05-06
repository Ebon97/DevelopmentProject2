<?php
defined('BASEPATH') OR exit('');
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title><?= $pageTitle ?></title>

        <!-- LOAD FILES -->
        <?php if((stristr($_SERVER['HTTP_HOST'], "localhost") !== FALSE) || (stristr($_SERVER['HTTP_HOST'], "192.168.") !== FALSE)|| (stristr($_SERVER['HTTP_HOST'], "127.0.0.") !== FALSE)): ?>
        <link rel="stylesheet" href="<?=base_url()?>public/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?=base_url()?>public/bootstrap/css/bootstrap-theme.min.css" media="screen">
        <link rel="stylesheet" href="<?=base_url()?>public/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?=base_url()?>public/font-awesome/css/font-awesome-animation.min.css">
        <link rel="stylesheet" href="<?=base_url()?>public/ext/select2/select2.min.css">

        <script src="<?=base_url()?>public/js/jquery.min.js"></script>
        <script src="<?=base_url()?>public/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?=base_url()?>public/ext/select2/select2.min.js"></script>

        <?php else: ?>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.0.8/font-awesome-animation.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

        <?php endif; ?>

        <!-- custom CSS -->
        <link rel="stylesheet" href="<?= base_url() ?>public/css/main.css">

        <!-- custom JS -->
        <script src="<?= base_url() ?>public/js/main.js"></script>
    </head>

    <body>
        <nav class="navbar navbar-default hidden-print">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarCollapse" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- <a class="navbar-brand" href="<?=base_url()?>" style="margin-top:-15px">
                        <img src="<?=base_url()?>public/images/logo_black.png" alt="logo" class="img-responsive" width="73px">
                    </a> -->
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="nav navbar-nav navbar-left visible-xs">
                        <li class="<?= $pageTitle == 'Dashboard' ? 'active' : '' ?>">
                            <a href="<?= site_url('dashboard') ?>">
                                <i class="fa fa-home"></i>
                                Dashboard
                            </a>
                        </li>

                        <li class="<?= $pageTitle == 'Appointments' ? 'active' : '' ?>">
                            <a href="<?= site_url('appointments') ?>">
                                <i class="fa fa-exchange"></i>
                                Appointments
                            </a>
                        </li>

                        <!-- <li class="<?= $pageTitle == 'Items' ? 'active' : '' ?>">
                            <a href="<?= site_url('items') ?>">
                                <i class="fa fa-cart-plus"></i>
                                Inventory Items
                            </a>
                        </li>
 -->
                        <li class="<?= $pageTitle == 'Staffs' ? 'active' : '' ?>">
                            <a href="<?= site_url('staffs') ?>">
                                <i class="fa fa-users"></i>
                                Staffs
                            </a>
                        </li>

                        <li class="<?= $pageTitle == 'Customers' ? 'active' : '' ?>">
                            <a href="<?= site_url('customers') ?>">
                                <i class="fa fa-users"></i>
                                Customers
                            </a>
                        </li>

                        <!-- <li class="<?= $pageTitle == 'Reports' ? 'active' : '' ?>">
                            <a href="<?= site_url('reports') ?>">
                                <i class="fa fa-newspaper-o"></i>
                                Reports
                            </a>
                        </li>

                        <li class="<?= $pageTitle == 'Eventlog' ? 'active' : '' ?>">
                            <a href="<?= site_url('Eventlog') ?>">
                                <i class="fa fa-tasks"></i>
                                Event Log
                            </a>
                        </li>- -->

                        <!-- <li class="<?= $pageTitle == 'Database' ? 'active' : '' ?>">
                            <a href="<?= site_url('dbmanagement') ?>">
                                <i class="fa fa-database"></i>
                                Database Management
                            </a>
                        </li>

                        <li class="<?= $pageTitle == 'Administrators' ? 'active' : '' ?>">
                            <a href="<?= site_url('administrators') ?>">
                                <i class="fa fa-user"></i>
                                Admin Management
                            </a>
                        </li> -->
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user navbarIcons"></i>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-menu-header text-center">
                                    <strong>Account</strong>
                                </li>
                                <li class="divider"></li>
                                <!---<li>
                                    <a href="#">
                                        <i class="fa fa-gear fa-fw"></i>
                                        Settings
                                    </a>
                                </li>
                                <li class="divider"></li>--->
                                <li><a href="<?= site_url('logout') ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div class="container-fluid hidden-print">
            <div class="row content">
                <!-- Left sidebar -->
                <div class="col-sm-2 sidenav hidden-xs mySideNav">
                    <br>
                    <ul class="nav nav-pills nav-stacked pointer">
                        <li class="<?= $pageTitle == 'Dashboard' ? 'active' : '' ?>">
                            <a href="<?= site_url('dashboard') ?>">
                                <i class="fa fa-home"></i>
                                Dashboard
                            </a>
                        </li>

                        <li class="<?= $pageTitle == 'Appointments' ? 'active' : '' ?>">
                            <a href="<?= site_url('appointments') ?>">
                                <i class="fa fa-exchange"></i>
                                Appointments
                            </a>
                        </li>

                        <!-- <li class="<?= $pageTitle == 'Items' ? 'active' : '' ?>">
                            <a href="<?= site_url('items') ?>">
                                <i class="fa fa-shopping-cart"></i>
                                Inventory Items
                            </a>
                        </li> -->

                        <li class="<?= $pageTitle == 'Staffs' ? 'active' : '' ?>">
                            <a href="<?= site_url('staffs') ?>">
                                <i class="fa fa-users"></i>
                                Staffs
                            </a>
                        </li>

                        <li class="<?= $pageTitle == 'Customers' ? 'active' : '' ?>">
                            <a href="<?= site_url('customers') ?>">
                                <i class="fa fa-users"></i>
                                Customers
                            </a>
                        </li>
                        <!--
                        <li class="<?= $pageTitle == 'Reports' ? 'active' : '' ?>">
                            <a href="<?= site_url('reports') ?>">
                                <i class="fa fa-newspaper-o"></i>
                                Reports
                            </a>
                        </li>
                        <li class="<?= $pageTitle == 'Eventlog' ? 'active' : '' ?>">
                            <a href="<?= site_url('Eventlog') ?>">
                                <i class="fa fa-tasks"></i>
                                Event Log
                            </a>
                        </li>--->

                        <!-- <li class="<?= $pageTitle == 'Database' ? 'active' : '' ?>">
                            <a href="<?= site_url('dbmanagement') ?>">
                                <i class="fa fa-database"></i>
                                Database Management
                            </a>
                        </li> -->

                        <!-- <li class="<?= $pageTitle == 'Administrators' ? 'active' : '' ?>">
                            <a href="<?= site_url('administrators') ?>">
                                <i class="fa fa-user"></i>
                                Admin Management
                            </a>
                        </li> -->
                    </ul>
                    <br>
                </div>
                <!-- Left sidebar ends -->
                <br>

                <!-- Main content -->
                <div class="col-sm-10">
                    <?= isset($pageContent) ? $pageContent : "" ?>
                </div>
                <!-- Main content ends -->
            </div>
        </div>

        <footer class="container-fluid text-center hidden-print">
            <!-- Put footer here -->
        </footer>

    </body>
</html>
