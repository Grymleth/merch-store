<?php
// message vars
$msg = '';
$msgClass = '';
// check for submit
if (filter_has_var(INPUT_POST, 'submit')) {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // check for required fields
    if (!empty($name) && !empty($email) && !empty($message)) {
        // passed

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // failed
            $msg = 'Please enter a valid email';
            $msgClass = 'alert-danger';
        } else {

            $msg = 'Under Construction';
            $msgClass = 'alert-primary';
            // // passed
            // // Recipient Email
            // $toEmail = 'aevan.candelaria@gmail.com';
            // $subject = 'Contact Request From ' . $name;
            // $body = '<h2> Contact Request</h2>
            //         <h4>Name</h4><p>' . $name . '</p>
            //         <h4>Email</h4><p>' . $email . '</p>
            //         <h4>Message</h4><p>' . $message . '</p>
            //     ';

            // // Email headers
            // $headers = "MIME-Version: 1.0" . "\r\n";
            // $headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";

            // // Additional headers
            // $headers .= "From: " . $name . "<" . $email . ">" . "\r\n";

            // if (mail($toEmail, $subject, $body, $headers)) {
            //     $msg = 'Your email has been sent';
            //     $msgClass = 'alert-success';
            // } else {
            //     $msg = 'Your email was not sent';
            //     $msgClass = 'alert-danger';
            // }
        }
    } else {
        // failed
        $msg = 'Please fill in all fields';
        $msgClass = 'alert-danger';
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>

    <!-- Header -->
    <?php require "src/common/header.php"; ?>
</head>

<body>
    <!-- Navigation -->
    <?php require "src/common/navbar.php"; ?>

    <!-- Content -->
    <div class="container my-4">
        <?php if ($msg != '') : ?>
            <div class="alert <?= $msgClass ?>"><?= $msg ?></div>
        <?php endif; ?>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?= isset($_POST['name']) ? $name : '' ?>">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control" value="<?= isset($_POST['email']) ? $email : '' ?>">
            </div>

            <div class="form-group">
                <label for="message">Message</label>
                <textarea name="message" id="message" cols="30" rows="10" class="form-control" value="<?= isset($_POST['message']) ? $message : '' ?>"></textarea>
            </div>

            <br>

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Footer -->
    <?php require "src/common/footer.php"; ?>
    <?php require "src/common/scripts.php"; ?>
</body>

</html>