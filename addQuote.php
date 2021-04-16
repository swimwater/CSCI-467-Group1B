<?php
    require_once("session.php");
    require_once("secrets.php");

    $insertNew = "insert into Quote (Cust_Id, User_Id, SNote) values (\"".$_POST['Cust_Id']."\", \"".$_SESSION['user_id']."\", \"".$_POST['Notes']."\");";

    $pdo->query($insertNew);
    header('Location:manageUnfinalQuotesHeader.php');
?>
