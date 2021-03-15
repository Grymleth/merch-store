<?php
    $reg_result = NULL;
    try {
        $account = new Account();

        #registerAccount($strEmail, $strName, $strPass, $strCPass, $strAddress, $strContactNo, $bSex, $dateOfBirth)
        $reg_result = $account->getAccountList();

        # prevent leaks uwu
        unset($account);

    } catch (Exception $ex) {
        die($ex);
    }

?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Search User</h1>

		<!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">User List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Birthdate</th>
                                <th>Email</th>
                                <th>Contact No.</th>
                                <th>Sex</th>
                                <th>Role</th>
                                <th>Reg. Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Birthdate</th>
                                <th>Email</th>
                                <th>Contact No.</th>
                                <th>Sex</th>
                                <th>Role</th>
                                <th>Reg. Date</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                                if(is_array($reg_result)){
                                    foreach($reg_result as $elem){
                                        $strSex = $elem["Sex"] == 0 ? "Male" : "Female";
                                        $strRole = Common::getRoleName(intval($elem["RoleID"]));
                                        echo
                                        "
                            <tr>
                                <td>".$elem["Name"]."</td>
                                <td>".$elem["Address"]."</td>
                                <td>".$elem["BirthDate"]."</td>
                                <td>".$elem["Email"]."</td>
                                <td>".$elem["ContactNo"]."</td>
                                <td>".$strSex."</td>
                                <td>".$strRole."</td>
                                <td>".$elem["RegDate"]."</td>
                                <td><button class=\"btn btn-primary\">Edit</button></td>
                            </tr>
                                        ";
                                    }
                                }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->