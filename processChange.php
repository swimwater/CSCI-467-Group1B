<?php
    require_once("session.php");
    require_once("secrets.php");
    if (!isset($_POST['Delete']))
    {
      header('Location:manage.php');
    }

    if (isset($_POST['Edit']))
    {
      $changeName = "update Associate set Name = '".$_POST['Name']."' where User_Id = ".$_POST['User_Id'].";";
      $changePass = "update Associate set Password = '".$_POST['Password']."' where User_Id = ".$_POST['User_Id'].";";
      $changeCom = "update Associate set Accu_Com = ".$_POST['Accu_Com']." where User_Id = ".$_POST['User_Id'].";";
      $changeAdd = "update Associate set Address = '".$_POST['Address']."' where User_Id = ".$_POST['User_Id'].";";
      $changePos = "update Associate set Pos = ".$_POST['Pos']." where User_Id = ".$_POST['User_Id'].";";

      $pdo->query($changeName);
      $pdo->query($changePass);
      $pdo->query($changeCom);
      $pdo->query($changeAdd);
      $pdo->query($changePos);
    }

    if (isset($_POST['Add']))
    {
      $insertNew = "insert into Associate (Name, Password, Accu_Com, Address, Pos) values (\"".$_POST['Name']."\", \"".$_POST['Password']."\", ".$_POST['Accu_Com'].", \"".$_POST['Address']."\", ".$_POST['Pos'].");";

      $pdo->query($insertNew);
    }

    if (isset($_POST['Delete']))
    {
      $checkQuote = "select COUNT(*) from Quote where Quote.User_Id = ".$_POST['User_Id'].";";
      $result = $pdo->query($checkQuote);
      $rows = $result->fetchColumn();
      if ($rows != 0)
      {
        header('Location:transferQuote.php');
        $_SESSION['User_Id'] = $_POST['User_Id'];
      }
      else
      {
        header('Location:manage.php');
        $remove =  "delete from Associate where User_Id = ".$_POST['User_Id'].";";
        $pdo->query($remove);
      }
    }
?>
