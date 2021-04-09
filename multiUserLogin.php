<?php
    require_once("secrets.php");
    session_start();


    if(isset($_POST["Login"])) {
        if(empty($_POST["user_id"]) || empty($_POST["password"]) || empty($_POST["user_type"])) {
            $msg = '<div style="text-align: center">ALL FIELDS REQUIRED.</div>';
            echo "<font color='yellow'>" . $msg . "</font>";
        }
        else {
            try {
                $id = $_POST['user_id'];
                $pswd = $_POST['password'];
                $user = $_POST['user_type'];

                $getLogin = "select User_Id, Password, Pos from Associate where Associate.User_Id = '$id' and Associate.Password = '$pswd' and Associate.Pos = '$user';";

                $login_query = $pdo->query($getLogin);

                $rows = $login_query->fetch(PDO::FETCH_ASSOC);

                if($rows['User_Id'] == $id && $rows['Password'] == $pswd && $rows['Pos'] == 0) {
                    $_SESSION["user_id"] = $_POST["user_id"];
                    header("Location: record.php");
                }
                else if ($rows['User_Id'] == $id && $rows['Password'] == $pswd && $rows['Pos'] == 1) {
                    $_SESSION["user_id"] = $_POST["user_id"];
                    header("Location: manageFinalQuotesHeader.php");
                }
                else if ($rows['User_Id'] == $id && $rows['Password'] == $pswd && $rows['Pos'] == 2) {
                    $_SESSION["user_id"] = $_POST["user_id"];
                    header("Location: views.php");
                }
                else {
                    $msg2 = '<div style="text-align: center">USERNAME OR PASSWORD INCORRECT.</div>';
                    echo "<font color='red'>" . $msg2 . "</font>";
                }
            }
            catch(PDOException $e) {
                $msg3 = '<div style="text-align: center">INVALID ARGUMENTS. FAILED TO CONNECT TO DATABASE!.</div>';
                echo"<font color='tomato'>" . $msg3. "</font>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Multi User Login Form</title>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+$
        <link rel="stylesheet" href="multiUserLogin.css">
    </head>
    <body>
        <!--nav bar-->
        <?php require "navbar.php"

        ?>
        <!--page body-->
        <div class="center">
            <h1>Login Portal</h1>
            <form method="post">
                <div class="txt_field">
                    <input type="text" name="user_id" placeholder="User ID">
                </div>
                <div class="txt_field">
                    <input type="password" name="password" placeholder="Password">
                </div>
                <div class="drop_menu">
                    <select name="user_type">
                        <option value="-1">Select User Type</option>
                        <option value="user_type">Associate</option>
                        <option value="1">HQ</option>
                        <option value="2">Administrator</option>
                    </select>
                </div>
                <input type="submit" name="Login" value="Login">
                <div class="pass_link">
                    <a href="reset.php">Forgot Password?</a>
                </div>
            </form>
        </div>
    </body>
</html>
