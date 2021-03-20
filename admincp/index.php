<?php

// USER ROLE - TEST
define("BANNED_USER", -1);
define("NORMAL_USER", 0);
define("INVENTORY_USER", 1);
define("FINANCIAL_USER", 2);
define("ADMIN_USER", 3);

// GLOBAL PATHS
define('HTTP_HOST', isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'CLI');
define('SERVER_PROTOCOL', (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on' ) ? 'https://' : 'http://');
define('__ROOT_DIR__', str_replace('\\','/',dirname(__FILE__)).'/');
define('__RELATIVE_ROOT__', (!empty($_SERVER['SCRIPT_NAME'])) ? str_ireplace(rtrim(str_replace('\\','/', realpath(str_replace($_SERVER['SCRIPT_NAME'], '', $_SERVER['SCRIPT_FILENAME']))), '/'), '', __ROOT_DIR__) : '/');// /
define('__BASE_URL__', SERVER_PROTOCOL.HTTP_HOST.__RELATIVE_ROOT__);
define('__HOMEPAGE__', __BASE_URL__."dashboard/home");
define('__PATH_CLASSES__', __ROOT_DIR__.'classes/');

try {
	# Load Classes and Functions
	if(!@include_once('classes/stdafx.php')) throw new Exception("Couldn't load Website");
	
} catch (Exception $ex) {
	die($ex);
}

if(!isset($_SESSION)){
    $session = Session::getInstance();
    if(!isset($session->accountID)){
        include(__ROOT_DIR__."page/login.php");
        die();
    }
}

$account = new Account();

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["modal_logout"])){
    $account->logoutAccount();
}


/*
    -1 = BANNED
    0 = NORMAL
    1 = INVENTORY
    2 = FINANCIAL
    3 = ADMIN 
*/

$session = Session::getInstance();
$roleID = intval($account->getUserRole($session->accountID)["RoleID"]);
if($session->roleID != $roleID){
    $account->logoutAccount();
}
$arrAdminSideBar = array(
    array( array(INVENTORY_USER, FINANCIAL_USER, ADMIN_USER), "Dashboard", "fa-tachometer-alt", "dashboard",
        array(
            array( array(INVENTORY_USER, FINANCIAL_USER, ADMIN_USER), "home", "Home"),
        ),
    ),
    array( array(INVENTORY_USER, FINANCIAL_USER, ADMIN_USER), "Profile", "fa-users", "account",
        array(
            array( array(INVENTORY_USER, FINANCIAL_USER, ADMIN_USER), "info", "Account Info"),
            array( array(ADMIN_USER), "register", "Register Account"),
            array( array(ADMIN_USER), "search", "Search Account"),
        ),
    ),
    array( array(FINANCIAL_USER, ADMIN_USER), "Finance", "fa-university", "finance",
        array(
            array( array(FINANCIAL_USER, ADMIN_USER), "overview", "Overview"),
            array( array(FINANCIAL_USER, ADMIN_USER), "transaction", "Transaction Logs"),
            array( array(FINANCIAL_USER, ADMIN_USER), "trinfo", "Transaction Info"),
        ),
    ),
    array( array(INVENTORY_USER, ADMIN_USER), "Inventory", "fa-shopping-bag", "inventory",
        array(
            array( array(INVENTORY_USER, ADMIN_USER), "products", "Search Product"),
            array( array(INVENTORY_USER, ADMIN_USER), "insert", "Add Product"),
            array( array(INVENTORY_USER, ADMIN_USER), "product", "Product Info"),
        ),
    ),
);



?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Eban Merch - Panel</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo __BASE_URL__ ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo __BASE_URL__ ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?php echo __BASE_URL__ ?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo __HOMEPAGE__?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Eban <sup>Merch</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Divider -->
            <hr class="sidebar-divider">
            <?php
                $includepage = "";
                $subpage = "";
                foreach($arrAdminSideBar as $adminSidebar){
                    if(!in_array($roleID, $adminSidebar[0])){
                        continue;
                    }
                    $isShow = "";
                    if(isset($_GET["page"])){
                        if($_GET["page"] == $adminSidebar[3]){
                            $isShow = "show";
                            $includepage = $adminSidebar[3];
                        }
                    }
                    echo 
                    "
                <li class=\"nav-item\">
                    <a class=\"nav-link collapsed\" href=\"#\" data-toggle=\"collapse\" data-target=\"#collapse". $adminSidebar[1] ."\"
                        aria-expanded=\"true\" aria-controls=\"collapse". $adminSidebar[1] ."\">
                        <i class=\"fas fa-fw ". $adminSidebar[2] ."\"></i>
                        <span>". $adminSidebar[1] ."</span>
                    </a>
                    <div id=\"collapse". $adminSidebar[1] ."\" class=\"collapse ". $isShow ."\" aria-labelledby=\"heading". $adminSidebar[1] ."\" data-parent=\"#accordionSidebar\">
                    <div class=\"bg-white py-2 collapse-inner rounded\">";
                            foreach($adminSidebar[4] as $sideBarItem){
                                if(!in_array($roleID, $sideBarItem[0])){
                                    continue;
                                }
                                $isActive = "";
                                if(isset($_GET["subpage"])){
                                    if($_GET["subpage"] == $sideBarItem[1]){
                                        $isActive = "active";
                                        $subpage = $sideBarItem[1];
                                    }
                                }
                                echo
                                "
                        <a class=\"collapse-item ". $isActive ."\" href=\"".  __BASE_URL__ . $adminSidebar[3] ."/".$sideBarItem[1] ."\">". $sideBarItem[2] ."</a>
                                ";
                            }                        
                    echo   
                        "</div>
                    </div>
                </li>
                    ";
                }

            ?>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

                    
        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $account->getUserName($session->accountID)["Name"] ?></span>
                            <img class="img-profile rounded-circle"
                                src="<?= __BASE_URL__."img/undraw_profile.svg" ?>">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="<?= __BASE_URL__."account/info" ?>">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <?php
                if(file_exists(__ROOT_DIR__."page/".$includepage.".php") && file_exists(__ROOT_DIR__."page/".$includepage."/".$subpage.".php"))
                    include(__ROOT_DIR__."page/".$includepage.".php");
                else{
                    include(__ROOT_DIR__."page/404.php");
                    die();
                }
            ?>
            
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Eban Merch 2021</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->
        

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form method="post">
                        <button class="btn btn-primary" name="modal_logout">Logout</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo __BASE_URL__ ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo __BASE_URL__ ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo __BASE_URL__ ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo __BASE_URL__ ?>js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?php echo __BASE_URL__ ?>vendor/chart.js/Chart.min.js"></script>
    <script src="<?php echo __BASE_URL__ ?>vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo __BASE_URL__ ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo __BASE_URL__ ?>js/demo/chart-area-demo.js"></script>
    <script src="<?php echo __BASE_URL__ ?>js/demo/chart-pie-demo.js"></script>
    <script src="<?php echo __BASE_URL__ ?>js/demo/datatables-demo.js"></script>

</body>

</html>