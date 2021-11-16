<!-- Bootstrap CSS-->
<script language="JavaScript" type="text/javascript" src="./assets/js/jquery-3.2.1.min.js"></script>

<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<!-- Font Awesome CSS-->
<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
<!-- Fontastic Custom icon font-->
<link rel="stylesheet" href="assets/css/fontastic.css">
<!-- Google fonts - Roboto -->
<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700"> -->
<!-- jQuery Circle-->
<link rel="stylesheet" href="assets/css/grasp_mobile_progress_circle-1.0.0.min.css">
<!-- Custom Scrollbar-->
<link rel="stylesheet" href="assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
<!-- theme stylesheet-->
<link rel="stylesheet" href="assets/css/style.default.css" id="theme-stylesheet">
<!-- Custom stylesheet - for your changes-->
<link rel="stylesheet" href="assets/css/custom.css">

<!--table-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"/>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<!-- Favicon-->
<!-- Tweaks for older IEs--><!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
<!-- Side Navbar -->
<nav class="side-navbar">
    <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <div class="sidenav-header align-items-center justify-content-center">

            <!-- User Info-->
            <div class="sidenav-header-inner text-center">
                <p class="h5">Sistem Informasi Gereja</p>
            </div>
        </div>
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
            <ul id="side-main-menu" class="side-menu list-unstyled">
                <li><a href="index.php"> <i class="fa fa-home"></i>HOME</a></li>
                <?php if ($_SESSION['role'] == 'jemaat') { ?>
                    <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i
                                    class="fa fa-book"></i>Data Jemaat</a>
                        <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                            <li><a href="index.php?menu=data_pribadi">Data Pribadi</a></li>
                            <li><a href="index.php?menu=data_keluarga">Data Keluarga</a></li>
                            <li><a href="index.php?menu=alamat">Alamat</a></li>
                            <li><a href="index.php?menu=kontak">Kontak</a></li>
                            <li><a href="index.php?menu=pendidikan">Pendidikan</a></li>
                            <li><a href="index.php?menu=pekerjaan">Pekerjaan</a></li>
                        </ul>
                    </li>
                <?php }
                if ($_SESSION['role'] == 'admin') {
                    ?>
                    <li><a href="index.php?menu=lihatdata"> <i class="fa fa-book""></i>Cek Data Jemaat</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
<div class="page">
    <!-- navbar-->
    <header class="header">
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-holder d-flex align-items-center justify-content-between">
                    <div class="navbar-header">
                        <a id="toggle-btn" href="#" class="menu-btn"><i class="fa fa-bars"> </i></a>
                        <a class="navbar-brand">
                            <div class="brand-text d-none d-md-inline-block"></div>
                        </a>
                    </div>

                    <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                        <!-- Messages dropdown-->
                        <li class="nav-item dropdown"><a rel="nofollow" href="#" data-toggle="dropdown"
                                                         aria-haspopup="true" aria-expanded="false"
                                                         class="nav-link language dropdown-toggle"><i
                                        class="fa fa-user"></i></a>
                            <ul aria-labelledby="languages" class="dropdown-menu">
                                <li><a rel="nofollow" href="#" class="dropdown-item"><i class="fa fa-user"></i><span>Profil</span></a>
                                </li>
                                <li><a rel="nofollow" href="index.php?menu=logout" class="dropdown-item"><i
                                                class="fa fa-sign-out"></i><span>Keluar</span></a></li>
                            </ul>
                        </li>
                        <!-- Log out--></ul>
                </div>
            </div>
        </nav>
    </header>