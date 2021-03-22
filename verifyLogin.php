<?php

    include("login.html");
    include("home.php");


    $id = $_POST['user_id'] ;
    $pswd = $_POST['password'] ;

    $sql = ("SELECT * FROM ASSOCIATE WHERE ASSOCIATE.USER_ID = $id AND ASSOCIATE.PASSWORD = '$pswd' ;") ;
    $login_query = $pdo->query($sql);

    $rows = $login_query->fetch(PDO::FETCH_ASSOC);

    $count = $login_query->rowCount();

    if($count >= 1)
    {
        header("Location: home.php");
    }
    else
    {
        header("Location: login.html");
    }





?>