<?php

	$MYusername = "z1821488";
	$MYpassword = "1999Jan03";
	$server = "courses";
	$dbName = "z1821488";


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