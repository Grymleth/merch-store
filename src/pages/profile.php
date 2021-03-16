<?php
    $accountInfo = NULL;
    $accountUID = $_SESSION['userId']; // get from session for now hardcode
    $isAdmin = false; // get from session currently hardcoded
    $reg_result = "_";
    try {
        $account = new Account();
        if(isset($_GET["request"])){
            $accountUID = $_GET["request"];
            $accountInfo = $account->getAccountInfo($accountUID);
    
            if(!is_array($accountInfo)){
                include(__ROOT_DIR__."page/404.php");
                die();
            }
        } else {
            $accountInfo = $account->getAccountInfo($accountUID);
        }
        
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST["info_confirmName"]) && isset($_POST["info_strName"])) 
                $reg_result = $account->changeName($accountUID, $_POST["info_strName"]);
            else if (isset($_POST["info_confirmAddress"]) && isset($_POST["info_strAddress"])) 
                $reg_result = $account->changeAddress($accountUID, $_POST["info_strAddress"]);
            else if (isset($_POST["info_confirmBday"]) && isset($_POST["info_dateOfBirth"])) 
                $reg_result = $account->changeBirth($accountUID, $_POST["info_dateOfBirth"]);
            else if (isset($_POST["info_confirmMail"]) && isset($_POST["info_strEmail"]) && isset($_POST["info_strEmailPass"]))
                $reg_result = $account->changeEmail($accountUID, $_POST["info_strEmail"], $_POST["info_strEmailPass"]);
            else if (isset($_POST["info_confirmPass"]) && isset($_POST["info_strNewPassword"]) && isset($_POST["info_strNewCPassword"]))
            #public function changePassword($accountID, $strPass, $strCPass, $isAdmin = false, $strCurrPass = "")
                if($isAdmin)
                    $reg_result = $account->changePassword($accountUID, $_POST["info_strNewPassword"], $_POST["info_strNewCPassword"], $isAdmin);
                else{
                    if(isset($_POST["info_strCurrPassword"]))
                        $reg_result = $account->changePassword($accountUID, $_POST["info_strNewPassword"], $_POST["info_strNewCPassword"], $isAdmin, $_POST["info_strCurrPassword"]);
                }
            $accountInfo = $account->getAccountInfo($accountUID);
        }
        
        
        # prevent leaking uwu
        unset($account);
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

    <title>Register</title>

    <!-- Header -->
    <?php require "src/common/header.php"; ?>

</head>

<body class="bg-light">

    <?php require "src/common/navbar.php"; ?>   

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                    <div class="col-lg-12">
                        <div class="p-5">
                            <!-- Begin Page Content -->
                            <div class="container-fluid">
                                <h1 class="h3 mb-4 text-gray-800">User Information</h1>
                                <!-- Feedback alert -->
                                <?php
                                    if($reg_result == ""){
                                        echo "<div class=\"alert alert-success\">Succesfully changed!</div>";
                                    } else if ($reg_result != "_"){
                                        echo "<div class=\"alert alert-danger\">".$reg_result."</div>";
                                    }
                                ?>
                                <form method="post">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Name</span>
                                        </div>
                                        <?php
                                            echo "
                                        <input type=\"text\" placeholder=\"Full Name\" name=\"info_strName\" class=\"form-control\" value=\"".$accountInfo["Name"]."\" 
                                            ";
                                            if(isset($_POST["info_editName"])){
                                                echo " 
                                        required > 
                                        <button class=\"btn btn-primary ml-4\" type=\"submit\" name=\"info_confirmName\">Confirm</button>
                                                ";
                                            } else {
                                                echo " 
                                        readonly > 
                                        <button class=\"btn btn-primary ml-4\" name=\"info_editName\">Edit</button>
                                                ";
                                            }
                                        ?>
                                    </div>
                                </form>
                                <form method="post">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Address</span>
                                        </div>
                                        <?php
                                            echo "
                                        <input type=\"text\" placeholder=\"Metro Manila, Philippines\" name=\"info_strAddress\" class=\"form-control\" value=\"".$accountInfo["Address"]."\" 
                                            ";
                                            if(isset($_POST["info_editAddress"])){
                                                echo " 
                                        required > 
                                        <button class=\"btn btn-primary ml-4\" type=\"submit\" name=\"info_confirmAddress\">Confirm</button>
                                                ";
                                            } else {
                                                echo " 
                                        readonly > 
                                        <button class=\"btn btn-primary ml-4\" name=\"info_editAddress\">Edit</button>
                                                ";
                                            }
                                        ?>
                                    </div>
                                </form>
                                <form method="post">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Date of Birth</span>
                                        </div>
                                        <?php
                                            echo "
                                        <input type=\"date\" name=\"info_dateOfBirth\" class=\"form-control\" value=\"".$accountInfo["BirthDate"]."\" 
                                            ";
                                            if(isset($_POST["info_editBday"])){
                                                echo " 
                                        required > 
                                        <button class=\"btn btn-primary ml-4\" type=\"submit\" name=\"info_confirmBday\">Confirm</button>
                                                ";
                                            } else {
                                                echo " 
                                        readonly > 
                                        <button class=\"btn btn-primary ml-4\" name=\"info_editBday\">Edit</button>
                                                ";
                                            }
                                        ?>
                                    </div>
                                </form>
                                <form method="post">
                                    <div class="input-group mb-3">
                                        <?php
                                            if(isset($_POST["info_editMail"])){
                                                echo " 
                                        <div class=\"input-group-prepend\">
                                            <span class=\"input-group-text\">Email</span>
                                        </div>
                                        <input type=\"email\" placeholder=\"name@example.com\" name=\"info_strEmail\" class=\"form-control\" value=\"".$accountInfo["Email"]."\" 
                                        required >
                                        <div class=\"input-group-prepend\">
                                            <span class=\"input-group-text\">Confirm Password</span>
                                        </div>
                                        <input type=\"password\" placeholder=\"Please type your current password to make the changes as verification\" name=\"info_strEmailPass\" class=\"form-control\" required>
                                        <button class=\"btn btn-primary ml-4\" type=\"submit\" name=\"info_confirmMail\">Confirm</button>
                                        ";
                                            } else {
                                                echo " 
                                        <div class=\"input-group-prepend\">
                                            <span class=\"input-group-text\">Email</span>
                                        </div>
                                        <input type=\"email\" placeholder=\"name@example.com\" name=\"info_strEmail\" class=\"form-control\" value=\"".$accountInfo["Email"]."\" 
                                        readonly > 
                                        <button class=\"btn btn-primary ml-4\" name=\"info_editMail\">Edit</button>
                                                ";
                                            }
                                        ?>
                                    </div>
                                </form>
                                <form method="post">
                                    <div class="input-group mb-3">
                                        <?php
                                            if(isset($_POST["info_editPass"])){
                                                if(!$isAdmin){
                                                    echo " 
                                        <div class=\"input-group-prepend\">
                                            <span class=\"input-group-text\">Current Password</span>
                                        </div>
                                        <input type=\"password\" placeholder=\"Please type your current password\" name=\"info_strCurrPassword\" class=\"form-control\" required> 
                                                    ";
                                                }
                                                echo "
                                        <div class=\"input-group-prepend\">
                                            <span class=\"input-group-text\">Password</span>
                                        </div>
                                        <input type=\"password\" placeholder=\"New Password\" name=\"info_strNewPassword\" class=\"form-control\" required> 
                                        <div class=\"input-group-prepend\">
                                            <span class=\"input-group-text\">Confirm Password</span>
                                        </div>
                                        <input type=\"password\" class=\"form-control\" placeholder=\"Confirm New Password\" name=\"info_strNewCPassword\" required>
                                        <button class=\"btn btn-primary ml-4\" type=\"submit\" name=\"info_confirmPass\">Confirm</button>
                                                ";
                                            } else {
                                                echo " 
                                        <div class=\"input-group-prepend\">
                                            <span class=\"input-group-text\">Password</span>
                                        </div>
                                        <input type=\"password\" placeholder=\"Password\" name=\"info_strPassword\" class=\"form-control\" value=\"loremipsumpassword\" readonly> 
                                        <button class=\"btn btn-primary ml-4\" name=\"info_editPass\">Edit</button>
                                                ";
                                            }
                                        ?>
                                    </div>
                                </form>
                                <form method="post">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Contact No.</span>
                                        </div>
                                        <?php
                                            echo "
                                        <input type=\"text\" placeholder=\"09123456789\" name=\"info_strContactNo\" class=\"form-control\" value=\"".$accountInfo["ContactNo"]."\" 
                                            ";
                                            if(isset($_POST["info_editContactNo"])){
                                                echo " 
                                        required > 
                                        <button class=\"btn btn-primary ml-4\" type=\"submit\" name=\"info_confirmContactNo\">Confirm</button>
                                                ";
                                            } else {
                                                echo " 
                                        readonly > 
                                        <button class=\"btn btn-primary ml-4\" name=\"info_editContactNo\">Edit</button>
                                                ";
                                            }
                                        ?>
                                    </div>
                                </form>
                                <form method="post">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Sex</span>
                                        </div>
                                        <?php
                                            echo "
                                        <select class=\"form-control\" name=\"info_iSex\" 
                                            ";
                                            if(!isset($_POST["info_editSex"])) 
                                            echo " 
                                        disabled >";
                                            else
                                            echo "
                                        >
                                            ";
                                            echo "
                                            <option ". ($accountInfo["Sex"] == 0 ? "selected" : "") ." value=\"0\">Male</option>
                                            <option ". ($accountInfo["Sex"] == 1 ? "selected" : "") ." value=\"1\">Female</option>
                                        </select>
                                            ";
                                            if(isset($_POST["info_editSex"])) 
                                            echo "
                                        <button class=\"btn btn-primary ml-4\" type=\"submit\" name=\"info_confirmSex\">Confirm</button>
                                            ";
                                            else
                                            echo "
                                        <button class=\"btn btn-primary ml-4\" type=\"submit\" name=\"info_editSex\">Edit</button>
                                            ";                    
                                        ?>
                                    </div>
                                </form>
                            </div>
                            <!-- /.container-fluid -->
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require "src/common/scripts.php"; ?>

</body>

</html>