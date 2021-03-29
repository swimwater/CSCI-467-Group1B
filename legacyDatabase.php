<?php
	$username = "student";
	$password = "student";
	$host = "blitz.cs.niu.edu";
	$database = "csci467";
	try  {
      $dsn2 = "mysql:host=$host;dbname=$database";
      $pdo2 = new PDO($dsn2, $username, $password);
      $pdo2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e)
  {
      echo"connection failed:".$e->getmessage();
  }
?>
