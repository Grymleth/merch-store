<?php
    $reg_result = "_";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["reg_button_submit"])){
            try {
                $account = new Account();

                #registerAccount($strEmail, $strName, $strPass, $strCPass, $strAddress, $strContactNo, $bSex, $dateOfBirth)
                $reg_result = $account->registerAccount(
                    $_POST["reg_strEmail"],
                    $_POST["reg_strName"],
                    $_POST["reg_strPassword"],
                    $_POST["reg_strCPassword"],
                    $_POST["reg_strAddress"],
                    $_POST["reg_strContactNo"],
                    $_POST["reg_bSex"],
                    $_POST["reg_dateOfBirth"]);


                # prevent leaks uwu
                unset($account);

            } catch (Exception $ex) {
                die($ex);
            }
        }

    }

    

   
    


?>
    
    
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Register User</h1>
		<form method="post">
            <!-- Feedback alert -->
            <?php
                if($reg_result == ""){
                    echo "<div class=\"alert alert-success\">Successfully Registered!</div>";
                } else if ($reg_result != "_"){
                    echo "<div class=\"alert alert-danger\">".$reg_result."</div>";
                }
            ?>
            
            

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Name</span>
                </div>
                <input type="text" class="form-control" placeholder="Full Name" name="reg_strName" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Address</span>
                </div>
                <input type="text" class="form-control" placeholder="Metro Manila, Philippines" name="reg_strAddress" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Date of Birth</span>
                </div>
                <input type="date" class="form-control" name="reg_dateOfBirth" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Email</span>
                </div>
                <input type="email" class="form-control" placeholder="name@example.com" name="reg_strEmail" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Password</span>
                </div>
                <input type="password" class="form-control" placeholder="Password" name="reg_strPassword" required>
                <div class="input-group-prepend">
                    <span class="input-group-text">Confirm Password</span>
                </div>
                <input type="password" class="form-control" placeholder="Confirm Password" name="reg_strCPassword" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Contact No.</span>
                </div>
                <input type="text" class="form-control" placeholder="09123456789" name="reg_strContactNo" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Sex</span>
                </div>
                <select class="form-control" name="reg_bSex" required>
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                </select>
            </div>
            <div class="container text-center">
                <button type="submit" name="reg_button_submit" class="btn btn-primary btn-md">Register</button>
            </div>
        </form>
    </div>
    <!-- /.container-fluid -->