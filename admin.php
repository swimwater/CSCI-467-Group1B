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
                    header("Location: views.php");
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
<html>

<head>
    <meta charset = "utf-8">
    <title>ADMIN PORTAL</title>
    <link rel="stylesheet" href="admin.css">

</head>
<body>
    
        <form class="box" method="post">
            <h1>ADMIN PORTAL<h1>
            <input id="text" type="text" name="user_id" placeholder="USER ID" ><br>
            <input id="text" type="password" name="password" placeholder="PASSWORD"><br>

            <input id="button" type="submit" name="Login" value="Login">  
        
        </form>

        

    
    
    

</body>

</html>
