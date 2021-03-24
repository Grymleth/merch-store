<?php

    $session = Session::getInstance();
    $accountInfo = NULL;
    $accountID = $session->accountID;
    $isAdmin = false;
    $reg_result = "_";
    try {
        $account = new Account();
        $accountInfo = $account->getAccountInfo($accountID);
        if(Common::getRoleName(intval($accountInfo["RoleID"])) == "ADMIN_USER")
            $isAdmin = true;

        if(isset($_GET["request"]) && $isAdmin){
            $accountID = $_GET["request"];
            $accountInfo = $account->getAccountInfo($accountID);
            if(!is_array($accountInfo)){
                include(__ROOT_DIR__."page/404.php");
                die();
            }
        } else if (isset($_GET["request"])){
            include(__ROOT_DIR__."page/404.php");
            die();
        } else {
            $accountInfo = $account->getAccountInfo($accountID);
        }
        
        if($_SERVER["REQUEST_METHOD"] == "POST" && Common::checkValue($accountID)  && intval($accountID) > 0 ){
            if(isset($_POST["info_confirmName"]) && isset($_POST["info_strName"]))
                $reg_result = $account->changeName($accountID, $_POST["info_strName"]);
            else if (isset($_POST["info_confirmAddress"]) && isset($_POST["info_strAddress"])) 
                $reg_result = $account->changeAddress($accountID, $_POST["info_strAddress"]);
            else if (isset($_POST["info_confirmBday"]) && isset($_POST["info_dateOfBirth"])) 
                $reg_result = $account->changeBirth($accountID, $_POST["info_dateOfBirth"]);
            else if (isset($_POST["info_confirmMail"]) && isset($_POST["info_strEmail"]) && isset($_POST["info_strEmailPass"]))
                $reg_result = $account->changeEmail($accountID, $_POST["info_strEmail"], $_POST["info_strEmailPass"]);
            else if (isset($_POST["info_confirmPass"]) && isset($_POST["info_strNewPassword"]) && isset($_POST["info_strNewCPassword"])){
                #public function changePassword($accountID, $strPass, $strCPass, $isAdmin = false, $strCurrPass = "")
                if($isAdmin)
                    $reg_result = $account->changePassword($accountID, $_POST["info_strNewPassword"], $_POST["info_strNewCPassword"], $isAdmin);
                else{
                if(isset($_POST["info_strCurrPassword"]))
                    $reg_result = $account->changePassword($accountID, $_POST["info_strNewPassword"], $_POST["info_strNewCPassword"], $isAdmin, $_POST["info_strCurrPassword"]);
                }
            } else if (isset($_POST["info_confirmContactNo"]) && isset($_POST["info_strContactNo"])) 
                $reg_result = $account->changeContactNo($accountID, $_POST["info_strContactNo"]);
            else if (isset($_POST["info_confirmSex"]) && isset($_POST["info_iSex"])) 
                $reg_result = $account->changeSex($accountID, $_POST["info_iSex"]);
            else if (isset($_POST["info_confirmRole"]) && isset($_POST["info_iRole"])){
                if($isAdmin){
                    if($accountID == $session->accountID)
                        $reg_result = "You can't change your role for yourself!";
                    else
                        $reg_result = $account->changeRole($accountID, $_POST["info_iRole"]);
                }
            }
            $accountInfo = $account->getAccountInfo($accountID);
        }
        
        
        # prevent leaking uwu
        unset($account);
    } catch (Exception $ex) {
        die($ex);
    }
?>
    
    
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
                <input type=\"text\" placeholder=\"+639123456789\" name=\"info_strContactNo\" class=\"form-control\" value=\"".$accountInfo["ContactNo"]."\" 
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
        <form method="post">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Role</span>
                </div>
                <?php
                    echo "
                <select class=\"form-control\" name=\"info_iRole\" 
                    ";
                    if(!isset($_POST["info_editRole"])) {
                    echo " 
                disabled >";
                echo "
                    <option selected>". Common::getRoleName(intval($accountInfo["RoleID"])) ."</option>
                </select>
                    ";
                        if($isAdmin){
                            echo "
                        <button class=\"btn btn-primary ml-4\" type=\"submit\" name=\"info_editRole\">Edit</button>
                            ";
                        }
                    }
                    else{
                    echo "
                >
                    ";
                    echo "
                    <option ". (intval($accountInfo["RoleID"]) == -1 ? "selected" : "") ." value=\"-1\">BANNED_USER</option>
                    <option ". (intval($accountInfo["RoleID"]) == 0 ? "selected" : "") ." value=\"0\">NORMAL_USER</option>
                    <option ". (intval($accountInfo["RoleID"]) == 1 ? "selected" : "") ." value=\"1\">INVENTORY_USER</option>
                    <option ". (intval($accountInfo["RoleID"]) == 2 ? "selected" : "") ." value=\"2\">FINANCIAL_USER</option>
                    <option ". (intval($accountInfo["RoleID"]) == 3 ? "selected" : "") ." value=\"3\">ADMIN_USER</option>
                </select>
                    ";
                        if($isAdmin){
                            echo "
                        <button class=\"btn btn-primary ml-4\" type=\"submit\" name=\"info_confirmRole\">Confirm</button>
                            ";
                        }   
                    }              
                ?>
            </div>
        </form>
    </div>
    <!-- /.container-fluid -->