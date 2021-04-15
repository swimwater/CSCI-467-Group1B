<?php
    require_once("legacyDatabase.php");
    require_once("session.php");
    require_once("secrets.php");
?>

<!doctype html>

<html lang="en">
<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!--- Custom CSS Style -->
  <link rel="stylesheet" href="customer.css">

  <title>Customer Description Form</title>
</head>
<body>
  <!--nav bar-->
  <?php require "navbar.php"?>

  <h1>Customer Description</h1>
    
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

<!--New area-->
 <?php
    $getCustId = "select Quote_Id, Cust_Id, SNote, cast(Date as date) as DateMade, Quote.User_Id  from Quote where Quote.Quote_Id = ".$_POST['quoteId'].";";
    $result = $pdo->query($getCustId);
    if ($result == false){echo "Failed to access Plant Repair database";}
    $quoteInfo = $result->fetch();?>
  <table>
    <tr align: left;>
      <th>Customer Id</th>
      <th>Quote Id</th>
      <th>Customer</th>
      <th>Customer Contact</th>
      <th>City</th>
      <th>Street</th>
      <th>Date Created</th>
      <th>Secret Notes</th>
    </tr>
    <tr>
      <td><?php echo $_POST['custId']; ?></td>
      <td><?php echo $_POST['quoteId'];?></td>
      <td><?php echo $_POST['custName'];?></td>
      <td><?php echo $_POST['custCont'];?></td>
      <td><?php echo $_POST['custCity'];?></td>
      <td><?php echo $_POST['custStreet'];?></td>
      <td><?php echo $quoteInfo['DateMade'];?></td>
      <td><?php echo $quoteInfo['SNote'];?></td>
    </tr>
    <tr>
    <tr>
    <tr>
      <th>Line Number</th>
      <th colspan="2">Price</th>
      <th colspan="4">Description</th>
    </tr>
    <?php 
      $getQuoteDes = "select Descrip_Id, Price, Descript from Quote_Descript where Quote_Id = ".$_POST['quoteId'].";";
    $result = $pdo->query($getQuoteDes);
    if ($result == false){echo "Failed to access Plant Repair database";}?>
    <?php 
      while($quoteDes = $result->fetch()):?>
      <tr>
        <td><?php echo $quoteDes['Descrip_Id'];?></td>
        <td colspan="2"><?php echo $quoteDes['Price'];?></td>
        <td colspan="4"><?php echo $quoteDes['Descript'];?></td>
      </tr>
    <?php endwhile;?>
  </table>
  <form action="customer.php">
    <input type="submit" value="Back"/>
  </form>
</html>
