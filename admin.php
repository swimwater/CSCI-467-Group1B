<?php
    include("secrets.php");
    session_start();
    try
    {
        
        $dsn = "mysql:host=$server;dbname=$dbName"; 		// creating dsn and pdo 
        $pdo = new PDO($dsn, $MYusername, $MYpassword);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


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

                $sql = ("SELECT * FROM ASSOCIATE WHERE ASSOCIATE.USER_ID = $id AND ASSOCIATE.PASSWORD = '$pswd' ;") ;
                $login_query = $pdo->query($sql);

                $rows = $login_query->fetch(PDO::FETCH_ASSOC);

                $count = $login_query->rowCount();

                if($count > 0)
                {
                    $_SESSION["user_id"] = $_POST["user_id"];
                    header("Location: verifyLogin.php");
                }
                else
                {
                    $message = '<label>Username OR Password is incorrect</label>';                
                }
            }
        }

    }
    catch(PDOException $e)
    {
        echo"connection failed:".$e->getmessage();
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