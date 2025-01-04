<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=$this->lang->line('app_title');?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=$this->config->item('base_url')?>resources/admin/bootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?=$this->config->item('base_url')?>resources/admin/bootstrap/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="<?=$this->config->item('base_url')?>resources/admin/bootstrap/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?=$this->config->item('base_url')?>resources/admin/bootstrap/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=$this->config->item('base_url')?>resources/admin/bootstrap/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?=$this->config->item('base_url')?>resources/admin/bootstrap/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- jGrowl -->
    <link href="<?=$this->config->item('base_url')?>resources/admin/bootstrap/jgrowl/jquery.jgrowl.min.css" rel="stylesheet">

    <!-- General Admin -->
    <link href="<?=$this->config->item('base_url')?>resources/admin/css/admin.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
	<script src="<?=$this->config->item('base_url')?>resources/admin/bootstrap/bower_components/jquery/dist/jquery.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="<?=$this->config->item('base_url')?>resources/admin/bootstrap/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

	<!-- Metis Menu Plugin JavaScript -->
	<script src="<?=$this->config->item('base_url')?>resources/admin/bootstrap/bower_components/metisMenu/dist/metisMenu.min.js"></script>

	<!-- DataTables JavaScript -->
	<script src="<?=$this->config->item('base_url')?>resources/admin/bootstrap/bower_components/DataTables/media/js/jquery.dataTables.min.js"></script>
	<script src="<?=$this->config->item('base_url')?>resources/admin/bootstrap/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

	<!-- jGrowl -->
	<script src="<?=$this->config->item('base_url')?>resources/admin/bootstrap/jgrowl/jquery.jgrowl.min.js"></script>

	<!-- Custom Theme JavaScript -->
	<script src="<?=$this->config->item('base_url')?>resources/admin/bootstrap/dist/js/sb-admin-2.js"></script>

	<!-- Administration Global JavaScript -->
	<script src="<?=$this->config->item('base_url')?>resources/admin/js/functions.js"></script>


	<link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/d004434a5ff76e7b97c8b07c01f34ca69e635d97/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
	<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/d004434a5ff76e7b97c8b07c01f34ca69e635d97/src/js/bootstrap-datetimepicker.js"></script>


</head>

<body>

	<!--<div style="padding: 5px; text-align: center; background-color: yellow; border-bottom: solid 1px black;">Se lucrează live.... Scuzaţi eventualele erori de funcţionalitate</div>-->
	<div id="wrapper">

		<!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=$this->config->item('base_url')?>admin.php"><?=$this->lang->line('app_title');?></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="javascript:;"><i class="fa fa-user fa-fw"></i> <?=htmlspecialchars($this->user->first_name)?> <?=htmlspecialchars($this->user->last_name)?></a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?=base_url(array("admin.php", "auth", "logout"))?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?=base_url(array("admin.php", "newscategories"));?>"><span class="fa fa-th-list fa-fw"></span> <?=$this->lang->line('categories');?></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-file-text-o fa-fw"></i> <?=$this->lang->line('news');?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?=base_url(array("admin.php", "news"));?>"><span class="fa fa-table fa-fw"></span> <?=$this->lang->line('news_list');?></a>
                                </li>
                                <li>
                                    <a href="<?=base_url(array("admin.php", "news", "add"));?>"><span class="fa fa-plus fa-fw"></span> <?=$this->lang->line('news_add');?></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> <?=$this->lang->line('pages');?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?=base_url(array("admin.php", "pages"));?>"><span class="fa fa-table fa-fw"></span> <?=$this->lang->line('pages_list');?></a>
                                </li>
                                <li>
                                    <a href="<?=base_url(array("admin.php", "pages", "add"));?>"><span class="fa fa-plus fa-fw"></span> <?=$this->lang->line('pages_add');?></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> <?=$this->lang->line('users');?><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?=base_url(array("admin.php", "users"));?>"><span class="fa fa-table fa-fw"></span> <?=$this->lang->line('users_list');?></a>
                                </li>
                                <li>
                                    <a href="<?=base_url(array("admin.php", "users", "add"));?>"><span class="fa fa-plus fa-fw"></span> <?=$this->lang->line('users_add');?></a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?=base_url(array("admin.php", "languages"));?>"><i class="fa fa-book fa-fw"></i> <?=$this->lang->line('languages');?></a>
                        </li>
                        <li>
                            <a href="<?=base_url(array("admin.php", "newsletter"));?>"><i class="fa fa-envelope-o fa-fw"></i> <?=$this->lang->line('newsletter');?></a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>