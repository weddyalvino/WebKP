<?php
define('SITE_ROOT', realpath(dirname(__FILE__)));
session_start();
include_once 'util/PDOUtil.php';
include_once 'dao/DataPribadiDaoImpl.php';
include_once 'dao/DataKelDAO.php';
include_once 'dao/GerejaDaoImpl.php';
include_once 'dao/KerjaDAO.php';
include_once 'dao/PendidikanDAO.php';
include_once 'dao/UserDaoImpl.php';
include_once 'dao/AlamatDAO.php';
include_once 'dao/KontakDAO.php';

include_once 'entity/User.php';
include_once 'entity/Role.php';
include_once 'entity/Gereja.php';


include_once 'controller/UserController.php';
include_once 'controller/DataPribadiController.php';
include_once 'controller/GerejaController.php';
include_once 'controller/KerjaCotroller.php';
include_once 'controller/DataKeluargaController.php';
include_once 'controller/DataPribadiController.php';
include_once 'controller/PendidikanController.php';
include_once 'controller/AlamatController.php';
include_once 'controller/KontakController.php';
//include_once 'provinsi.php';
if (!isset($_SESSION['my_session'])) {
    $_SESSION['my_session'] = false;
}
?>
<html>
<head>
    <title>Sistem Informasi Gereja</title>
</head>
<body>
<?php
$menu = FILTER_INPUT(INPUT_GET, 'menu');
switch ($menu) {
    case 'login' :
        {
            $userControl = new UserController();
            $userControl->userLogin();
        }
        break;

    case 'logout' :
        {
            $userControl = new UserController();
            $userControl->userLogout();
        }
        break;
    case 'data_keluarga' :
        {
            $dk = new DataKeluargaController();
            $dk->index();
        }
        break;
    case 'data_pribadi' :
        {
            $dp = new DataPribadiController();
            $dp->dataPribadiPage();
        }
        break;
    case 'lihatdata' :
        {
            $dp = new DataPribadiController();
            $dp->cekdata();
        }
        break;
    case 'pekerjaan' :
        {
            $kerja = new KerjaCotroller();
            $kerja->index();
        }
        break;
    case 'pendidikan' :
        {
            $didik = new PendidikanController();
            $didik->index();
        }
        break;
    case 'alamat' :
        {
            $alamat = new AlamatController();
            $alamat->index();
        }
        break;
    case 'kontak' :
        {
            $kontak = new KontakController();
            $kontak->index();
        }
        break;
    default:
    {
        if ($_SESSION['my_session']) {
            include 'home-2.php';
        } else {
            include 'beranda.php';
        }
    }
}
?>
</body>
</html>