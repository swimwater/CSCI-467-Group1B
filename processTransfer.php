<?php
    require_once("session.php");
    require_once("secrets.php");
    header('Location:transferQuote.php');

    if(isset($_POST['From']))
    {
      $_SESSION['User_Id'] = $_POST['From'];
      $_SESSION['User_Id2'] = $_POST['To'];

      $Quote_Id = $_POST['QId'];

      foreach ($Quote_Id as $x=>$id)
      {
        $change = "update Quote set User_Id = ".$_POST['To']." where User_Id = ".$_POST['From']." and Quote_Id = ".$id.";";
        $pdo->query($change);
      }
    }
?>
