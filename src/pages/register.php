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
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form action="<?= __BASE_URL__ ?>accounts/register" method="POST" class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="firstName"
                                            name="firstName" placeholder="First Name">
                                        <?= isset($data) ? "<label>" . $data['firstNameError'] ."</label>" : '' ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="lastName"
                                            name="lastName" placeholder="Last Name">
                                        <?= isset($data) ? "<label>" . $data['lastNameError'] ."</label>" : '' ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email"
                                        name="email" placeholder="Email Address">
                                    <?= isset($data) ? "<label>" . $data['emailError'] ."</label>" : '' ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            id="password" name="password" placeholder="Password">
                                        <?= isset($data) ? "<label>" . $data['passwordError'] ."</label>" : '' ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            id="repeatPassword" name="repeatPassword" placeholder="Repeat Password">
                                        <?= isset($data) ? "<label>" . $data['repeatPasswordError'] ."</label>" : '' ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user"
                                            id="address" name="address" placeholder="Address">
                                        <?= isset($data) ? "<label>" . $data['addressError'] ."</label>" : '' ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user"
                                            id="contactno" name="contactno" placeholder="Contact Number">
                                        <?= isset($data) ? "<label>" . $data['contactError'] ."</label>" : '' ?>
                                    </div>
                                </div>
                                <button type="submit" value="submit" name="submit" class= "btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="/merch-store/accounts/login">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php require "src/common/scripts.php"; ?>

</body>

</html>