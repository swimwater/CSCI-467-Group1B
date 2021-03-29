//Still working on reset link but almost done.
<?php
    require_once("secrets.php");
    session_start();

    //if user clicks on the forget password button.
    if (isset($POST['Reset-Password'])) {
        $email = $_POST['cust_mail'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['cust_mail'] = "Email address is invalid";
        }
        if (empty($email)) {
            $errors['cust_mail'] = "Email required";
        }
        if (count($errors) == 0) {
            $sql = "SELECT * FROM Quote WHERE Quote.Cust_Mail LIMIT 1";
            $result = mysql_query($conn, $sql);
            $user = mysqli_fetch($result);
            $token = $user['token']
            sendPasswordResetLink($user, $token]);
            header('location: reset-message.php');
            exit(0);
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Reset Password Form</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="associate.css">
    </head>
    <body>
        <!--page body-->
        <div class="center">
            <h1>Recover your password</h1>
            <p>Please enter the email address you used to sign up on this site and we will assist you in recovering your password. </p>

            <?php if (count($errors) > 0): { ?>
                <div class="alert alert-danger">
                <?php  foreach ($errors as $error): ?>   <li><<?php echo $error; ?></li>
                <?php endforeach ?>
                </div>
            <?php endif ?>
            <form method="post">
                <div class="txt_field">
                    <input type="email" name="email" placeholder="Email">
                </div>
                <input type="submit" name="submit" value="Recover your password">
                <div class="associate_link">
                    <a href="associate.php">Go Back</a>
                </div>
            </form>
        </div>
    </body>
</html>                