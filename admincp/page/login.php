<?php
$reg_result = "_";

try {
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login_button_submit"])){
        if(isset($_POST["login_strEmail"]) && isset($_POST["login_strPass"])) {
            $account = new Account();
            $reg_result = $account->loginAccount($_POST["login_strEmail"], $_POST["login_strPass"]);

            # prevent leaking uwu
            unset($account);
        }
    }
} catch (Exception $ex) {
    die($ex);
}

?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Eban Merch - AdminCP Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo __BASE_URL__ ?>css/sb-admin-2.min.css" rel="stylesheet">

</head>



    <?php
        if(isset($_GET["page"])){
            echo
            "
<body>
    <div class=\"page-wrap d-flex flex-row align-items-center\">
        <div class=\"container mt-5\">
            <!-- 404 Error Text -->
            <div class=\"text-center\">
                <div class=\"error mx-auto\" data-text=\"404\">404</div>
                <p class=\"lead text-gray-800 mb-5\">Page Not Found</p>
                <p class=\"text-gray-500 mb-0\">It looks like you found a glitch in the matrix...</p>
                <a href=\"".__BASE_URL__."\">&larr; Back to Login</a>
            </div>
        </div>
    </div>
            ";
        } else {
            echo
            "
<body class=\"bg-gradient-primary\">
    <div class=\"container\">
        
        <!-- Outer Row -->
        <div class=\"row justify-content-center\">

            <div class=\"col-xl-10 col-lg-12 col-md-9\">

                <div class=\"card o-hidden border-0 shadow-lg my-5\">
                    <div class=\"card-body p-0\">
                        <!-- Nested Row within Card Body -->
                        <div class=\"row\">
                            <div class=\"col-lg-6 d-none d-lg-block bg-login-image\"></div>
                            <div class=\"col-lg-6\">
                                <div class=\"p-5\">
                                    <div class=\"text-center\">
                                        <h1 class=\"h4 text-gray-900 mb-4\">Staff Login</h1>
                                    </div>
                                    <form method=\"post\" class=\"user\">
                                        <div class=\"form-group\">
                                            <input type=\"email\" name=\"login_strEmail\"class=\"form-control form-control-user\" placeholder=\"Enter Email Address...\" required>
                                        </div>
                                        <div class=\"form-group\">
                                            <input type=\"password\" name=\"login_strPass\" class=\"form-control form-control-user\" placeholder=\"Password\" required>
                                        </div>";
            if ($reg_result != "_"){
                echo "
                                        <div class=\"alert alert-danger\">".$reg_result."</div>
                ";
            }
            echo
            "
                                        <button type=\"submit\" name=\"login_button_submit\" class=\"btn btn-primary btn-user btn-block\">Login</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
";
            
        }

    ?>

    
</body>
    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo __BASE_URL__ ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo __BASE_URL__ ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo __BASE_URL__ ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo __BASE_URL__ ?>js/sb-admin-2.min.js"></script>



</html>