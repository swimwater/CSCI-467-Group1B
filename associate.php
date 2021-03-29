<?php
    require_once("secrets.php");
    session_start();


    if(isset($_POST["Login"]))
    {
        if(empty($_POST["user_id"]) || empty($_POST["password"]))
        {
            echo '<label>All fields required to enter</label>';
        }
        else
        {
            try
            {
                $id = $_POST['user_id'] ;
                $pswd = $_POST['password'] ;

                $sql = ("SELECT * FROM Associate WHERE Associate.User_Id = $id AND Associate.Password = '$pswd' AND Associate.Admin = 1 ;") ;
                $login_query = $pdo->query($sql);

                $rows = $login_query->fetch(PDO::FETCH_ASSOC);

                $count = $login_query->rowCount();

                if($count >= 1)
                {
                    $_SESSION["user_id"] = $_POST["user_id"];
                    header("Location: record.php");
                }
                else
                {
                    echo'<label>Username OR Password is incorrect</label>';
                }
            }
            catch(PDOException $e)
            {
                echo"connection failed:".$e->getmessage();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Login Form</title>
        <link rel="stylesheet" href="associate.css">
    </head>
    <body>
        <!--nav bar-->
        <?php require "navbar.php"

        ?>
        <!--page body-->
        <div class="center">
            <h1>Associate Login Portal</h1>
            <form method="post">
                <div class="txt_field">
                    <input type="text" name="user_id" placeholder="User ID">
                </div>
                <div class="txt_field">
                    <input type="password" name="password" placeholder="Password">
                </div>
                <input type="submit" name="Login" value="Login">
                <div class="pass_link">
                    <a href="reset.php">Forgot Password?</a>
                </div>
            </form>
        </div>
    </body>
</html>
