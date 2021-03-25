<?php
    require_once("secrets.php");
    session_start();



    if(isset($_POST["Login"]))
    {
        if(empty($_POST["user_id"]) || empty($_POST["password"]))
        {
            $message = '<label>All fields required to enter</label>';
        }
        else
        {
            $id = $_POST['user_id'] ;
            $pswd = $_POST['password'] ;

            $sql = ("SELECT * FROM Associate WHERE Associate.User_Id = $id AND Associate.Password = '$pswd' AND Admin = 1 ;") ;
            $login_query = $pdo->query($sql);

            $rows = $login_query->fetch(PDO::FETCH_ASSOC);

            $count = $login_query->rowCount();

            if($count > 0)
            {
                $_SESSION["user_id"] = $_POST["user_id"];
                header("Location: views.php");
            }
            else
            {
                $message = '<label>Username OR Password is incorrect</label>';
            }
        }
    }



?>


<!DOCTYPE html>
<html>

<head>
    <title>ADMIN PORTAL</title>

</head>
<body>
    <div id="box">

        <form method="post">
            <div style ="font-size: 20px; margin: 10px;">Login</div>
            <p>ASSOCIATE ID: </p>
            <input id="text" type="text" name="user_id" ><br><br>
            <p>PASSWORD: </p>
            <input id="text" type="password" name="password"><br><br>

            <input id="button" type="submit" name="Login" value="Login">

        </form>



    </div>

</body>

</html>
