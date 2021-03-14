<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(Common::checkValue($_POST["reg_submit"])){
            
        }

    }

    

    try {
        $account = new Account();

        #$account->registerAccount();

    } catch (Exception $ex) {
        //throw $th;
    }
    


?>
    
    
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Register User</h1>
		<form method="post">
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
                <input type="date" class="form-control" placeholder="Year" name="reg_date" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Email</span>
                </div>
                <input type="email" class="form-control" placeholder="name@example.com" name="strEmail" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Password</span>
                </div>
                <input type="password" class="form-control" placeholder="Password" name="strPassword" required>
                <div class="input-group-prepend">
                    <span class="input-group-text">Confirm Password</span>
                </div>
                <input type="password" class="form-control" placeholder="Confirm Password" name="strCPassword" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Contact No.</span>
                </div>
                <input type="text" class="form-control" placeholder="09123456789" name="strContactNo" required>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Sex</span>
                </div>
                <select class="form-control" name="iSex" required>
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                </select>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Role</span>
                </div>
                <select class="form-control" name="iRole" required>
                    <option value="-1">BANNED</option>
                    <option value="0">NORMAL</option>
                    <option value="1">INVENTORY</option>
                    <option value="2">FINANCIAL</option>
                    <option value="3">ADMIN</option>
                </select>
            </div>
            <div class="container text-center">
                <button type="submit" name="reg_submit" value="submit" class="btn btn-primary btn-md">Register</button>
            </div>
        </form>
    </div>
    <!-- /.container-fluid -->