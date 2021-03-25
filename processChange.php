<?php
    require_once("session.php");
    require_once("secrets.php");
    header('Location:manage.php');

    if (isset($_POST['Edit']))
    {
      $changeName = "update Associate set Name = '".$_POST['Name']."' where User_Id = ".$_POST['User_Id'].";";
      $changePass = "update Associate set Password = '".$_POST['Password']."' where User_Id = ".$_POST['User_Id'].";";
      $changeCom = "update Associate set Accu_Com = '".$_POST['Accu_Com']."' where User_Id = ".$_POST['User_Id'].";";
      $changeAdd = "update Associate set Address = '".$_POST['Address']."' where User_Id = ".$_POST['User_Id'].";";
      $changeAdmin = "update Associate set Admin = '".$_POST['Admin']."' where User_Id = ".$_POST['User_Id'].";";

      $pdo->query($changeName);
      $pdo->query($changePass);
      $pdo->query($changeCom);
      $pdo->query($changeAdd);
      $pdo->query($changeAdmin);
    }
?>
