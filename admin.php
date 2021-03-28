<?php
    require_once("secrets.php");
    session_start();



    if(isset($_POST["Login"]))
    {
        if(empty($_POST["user_id"]) || empty($_POST["password"]))
        {
            //$msg="All fields required to enter";
            $msg = '<div style="text-align: center">ALL FIELDS REQUIRED.</div>';
            echo "<font color='yellow'>" . $msg . "</font>";
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
                    $msg2 = '<div style="text-align: center">USERNAME OR PASSWORD INCORRECT.</div>';
                    echo "<font color='red'>" . $msg2 . "</font>";
                }
            }
            catch(PDOException $e)
            {
                $msg3 = '<div style="text-align: center">INVALID ARGUMENTS. FAILED TO CONNECT TO DATABASE!.</div>';
                echo"<font color='tomato'>" . $msg3. "</font>";
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
