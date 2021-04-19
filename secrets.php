<?php
	$MYusername = "z1860966";
	$MYpassword = "2001Jun27";
	$server = "courses";
	$dbName = "z1860966";
	try
    {
        $dsn = "mysql:host=$server;dbname=$dbName"; 		// creating dsn and pdo
        $pdo = new PDO($dsn, $MYusername, $MYpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo"connection failed:".$e->getmessage();
    }
?>
