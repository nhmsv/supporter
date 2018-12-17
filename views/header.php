<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title><?PHP echo SITENAME;?></title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- ================== BEGIN BASE CSS STYLE ================== -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/css/animate.min.css" rel="stylesheet" />
    <link href="assets/css/style.min.css" rel="stylesheet" />
    <link rel="icon" href="favicon.ico">
    <link href="assets/css/style-responsive.min.css" rel="stylesheet" />
    <link href="assets/css/theme/default.css" rel="stylesheet" id="theme" />
    <!-- ================== END BASE CSS STYLE ================== -->

    <!-- ================== BEGIN BASE JS ================== -->
    <script src="assets/plugins/pace/pace.min.js"></script>
    <!-- ================== END BASE JS ================== -->
</head>
<body>
<!-- begin #page-loader -->
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class="fade page-sidebar-minified page-sidebar-fixed page-header-fixed page-content-full-height page-with-<?PHP echo $pref->dir_text;?>-sidebar">
    <!-- begin #header -->
    <div id="header" class="header navbar navbar-default navbar-fixed-top">
        <!-- begin container-fluid -->
        <div class="container-fluid">
            <!-- begin mobile sidebar expand / collapse button -->
            <div class="navbar-header navbar-<?PHP echo $pref->dir_text;?>">
                <a href="index.php" class="navbar-brand"><span class="navbar-logo pull-<?PHP echo $pref->dir_text;?>"></span> <?PHP echo $lang->lang['SITE_NAME']; ?></a>

                <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <ul class="nav navbar-nav">


            <li class="dropdown navbar-user">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="assets/img/user-13.jpg" alt="" />
                    <span class="hidden-xs">User</span> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu animated fadeInLeft">
                    <li class="arrow"></li>
                    <li><a href="javascript:;">Edit Profile</a></li>
                    <li><a href="javascript:;"><span class="badge badge-danger pull-right">2</span> Inbox</a></li>
                    <li><a href="javascript:;">Calendar</a></li>
                    <li><a href="javascript:;">Setting</a></li>
                    <li class="divider"></li>
                    <li><a href="javascript:;">Log Out</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle f-s-14">
                    <i class="fa fa-bell-o"></i>
                    <span class="label">1</span>
                </a>
                <ul class="dropdown-menu media-list pull-right animated fadeInDown">
                    <li class="dropdown-header">New Replies (1)</li>

                    <li class="media">
                        <a href="javascript:;">
                            <div class="media-left"><i class="fa fa-bug media-object bg-red"></i></div>
                            <div class="media-body">
                                <h6 class="media-heading">Server Error Reports</h6>
                                <div class="text-muted f-s-11">3 minutes ago</div>
                            </div>
                        </a>
                    </li>

                    <li class="dropdown-footer text-center">
                        <a href="javascript:;">View more</a>
                    </li>
                </ul>
            </li>


                <li class="dropdown">

                    <a href="javascript:;" class="dropdown-toggle f-s-14" onclick="changeLang();"><i class="fa fa-language"></i> <?PHP echo ($pref->lang == 'Arabic')? 'English' : 'Arabic' ;?>
                        <ul class="dropdown-menu media-list pull-right animated fadeInDown">
                            <li class="dropdown-header"></a></li>
            </ul>
            </li>

                </ul>
            <!-- end mobile sidebar expand / collapse button -->

            <!-- begin header navigation right -->
            <ul class="nav navbar-nav navbar-right">

                <li>
                    <form class="navbar-form full-width" style="display: none;">


                        <div class="input-group">
                            <span class="input-group-addon" onclick="$('#input-search-general').val('');"><i class="fa fa-search"></i></span>
                            <input type="text" dir="<?PHP echo $pref->dir;?>" id="input-search-general" class="form-control" placeholder="بحث عام" onkeyup="searchGeneral(this.value);" >
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input type="text" dir="<?PHP echo $pref->dir;?>" id="searchBy-Price" class="form-control" placeholder="السعر" onkeyup="Action_All(this.value,'Price');" style="width: 80px;">
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-dot-circle-o"></i></span>
                            <input type="text" dir="<?PHP echo $pref->dir;?>" id="searchBy-rShorl" class="form-control" placeholder="العنوان" onkeyup="Action_All(this.value,'rShort');" >
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-list"></i></span>
                            <input type="text" dir="<?PHP echo $pref->dir;?>" id="searchBy-rLong" class="form-control" placeholder="التفاصيل" onkeyup="Action_All(this.value,'rLong');">
                        </div>



                    </form>
                </li>




            </ul>
            <!-- end header navigation right -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- end #header -->

    <!-- begin #sidebar -->
    <div id="sidebar" class="sidebar">
        <!-- begin sidebar scrollbar -->
        <div data-scrollbar="true" data-height="100%">
            <!-- begin sidebar user -->
            <ul class="nav">
                <li class="nav-profile">
                    <div class="image">
                        <a href="javascript:;"><img src="assets/img/user-13.jpg" alt="" /></a>
                    </div>
                    <div class="info">
                        Nasser
                        <small>Nasser Ali Al-Mutlaq</small>
                    </div>
                </li>
            </ul>
            <!-- end sidebar user -->
            <!-- begin sidebar nav -->
            <ul class="nav">
                <li class="nav-header">Navigation</li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret pull-right"></b>
                        <i class="fa fa-laptop"></i>
                        <span>Dashboard</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="index.html">Dashboard v1</a></li>
                        <li><a href="index_v2.html">Dashboard v2</a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <span class="badge pull-right">10</span>
                        <i class="fa fa-inbox"></i>
                        <span>Promotions</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="#">عرض الدبل</a></li>
                        <li><a href="#">عرض الاجهزة</a></li>
                        <li><a href="#">عرض باقات موبايلي</a></li>
                    </ul>
                </li>

                <!-- begin sidebar minify button -->
                <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
                <!-- end sidebar minify button -->
            </ul>
            <!-- end sidebar nav -->
        </div>
        <!-- end sidebar scrollbar -->
    </div>
    <div class="sidebar-bg"></div>
    <!-- end #sidebar -->
