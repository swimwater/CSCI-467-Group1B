<?php
    require_once("session.php");
    require_once("secrets.php");
    if (!isset($_POST['Delete']))
    {
      header('Location:manageUnfinalQuotesHeader.php');
    }

    if (isset($_POST['Add']))
    {
      $insertNew = "insert into Quote (Cust_Id, Quote_Id, SNote) values (\"".$_POST['Cust_Id']."\", \"".$_POST['Quote_Id']."\", \"".$_POST['SNote'].");";

      $pdo->query($insertNew);
    }
?>
