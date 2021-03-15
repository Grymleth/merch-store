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
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Profile</h1>
                            </div>

                            <form action="" method="">
                                <!-- Feedback alert -->
                                <div class="alert alert-success">Yay!</div>
                                <div class="alert alert-danger">Oh no!</div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Name</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Full Name" name="strName" required>
                                    <button class="btn btn-primary ml-4" type="editName">Edit</button>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Address</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Metro Manila, Philippines" name="strAddress" required>
                                    <button class="btn btn-primary ml-4" type="editAddress">Edit</button>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Date of Birth</span>
                                    </div>
                                    <input type="number" class="form-control" placeholder="Year" name="iYear"
                                    required  
                                    >
                                    <input type="number" class="form-control" placeholder="Month" name="iMonth"
                                    required
                                    >
                                    <input type="number" class="form-control" placeholder="Day" name="iDay"
                                    required
                                    >
                                    <button class="btn btn-primary ml-4" type="editBday">Edit</button>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Email</span>
                                    </div>
                                    <input type="email" class="form-control" placeholder="name@example.com" name="strEmail">
                                    <button class="btn btn-primary ml-4" type="editMail">Edit</button>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Password</span>
                                    </div>
                                    <input type="password" class="form-control" placeholder="Password" name="strPassword">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Confirm Password</span>
                                    </div>
                                    <input type="password" class="form-control" placeholder="Confirm Password" name="strCPassword">
                                    <button class="btn btn-primary ml-4" type="editContactNo">Edit</button>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Contact No.</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="09123456789" name="strContactNo">
                                    <button class="btn btn-primary ml-4" type="editContactNo">Edit</button>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Sex</span>
                                    </div>
                                    <select class="form-control" name="iSex">
                                        <option value="0">Male</option>
                                        <option value="1">Female</option>
                                    </select>
                                    <button class="btn btn-primary ml-4" type="editSex">Edit</button>
                                </div>
                            </form>
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