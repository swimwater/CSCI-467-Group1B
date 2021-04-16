<?php
    require_once("session.php");
    require_once("secrets.php");
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>VIEWS</title>

<link rel="stylesheet" href="views.css">

</head>
<body>
  <!--nav bar-->
  <?php require "navbar.php"?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <h1>VIEWS QUOTES</h1>

    <br>
    </body>
    <?php $getCustId = "select Name, SNote, Status, cast(Date as date) as DateMade from Quote, Associate
    where Quote.Quote_Id = ".$_POST['QId']." and Associate.User_Id = Quote.User_Id;";
    $result = $pdo->query($getCustId);
    if ($result == false){echo "Failed to access Plant Repair database";}
    $quoteInfo = $result->fetch();?>
  <table>
    <tr align: left;>
      <th>Customer</th>
      <th>Customer Contact</th>
      <th>Associate</th>
      <th>Quote Id</th>
      <th>Date Created</th>
      <th>Status</th>
      <th>Secret Notes</th>
    </tr>
    <tr>
      <td><?php echo $_POST['custName'];?></td>
      <td><?php echo $_POST['custCont'];?></td>
      <td><?php echo $quoteInfo['Name'];?></td>
      <td><?php echo $_POST['QId'];?></td>
      <td><?php echo $quoteInfo['DateMade'];?></td>
      <td><?php echo $quoteInfo['Status'];?></td>
      <td><?php echo $quoteInfo['SNote'];?></td>
    </tr>
    <tr>
      <th>Line Number</th>
      <th colspan="2">Price</th>
      <th colspan="4">Description</th>
    </tr>
    <?php $getQuoteDes = "select Descrip_Id, Price, Descript from Quote_Descript where Quote_Id = ".$_POST['QId'].";";
    $result = $pdo->query($getQuoteDes);
    if ($result == false){echo "Failed to access Plant Repair database";}
    $totalPrice = 0;?>
    <?php while($quoteDes = $result->fetch()):?>
      <tr>
        <td><?php echo $quoteDes['Descrip_Id'];?></td>
        <td colspan="2"><?php echo $quoteDes['Price'];?></td>
        <td colspan="4"><?php echo $quoteDes['Descript'];?></td>
      </tr>
      <?php $totalPrice += $quoteDes['Price'];?>
    <?php endwhile;?>

    <?php if($quoteInfo['Status'] == 'Sanctioned' or $quoteInfo['Status'] == 'Ordered'):?>
      <?php $getQuoteDis = "select Discount, Percent from Quote where Quote_Id = ".$_POST['QId'].";";
      $result3 = $pdo->query($getQuoteDis);
      if ($result3 == false){echo "Failed to access Plant Repair database";}
      $quoteDis = $result3->fetch();

      $discount = 0;
      $dis = "-$ 0";
      if ($quoteDis['Discount'] != NULL)
      {
        if ($quoteDis['Percent'] == 1)
        {
          $dis = "% ".$quoteDis['Discount'] * 100;
          $discount = $quoteDis['Discount'] * $totalPrice;
          $totalPrice = $totalPrice - $discount;
        }
        else
        {
          $dis = "-$ ".$quoteDis['Discount'];
          $totalPrice = $totalPrice - $quoteDis['Discount'];
          $discount = $quoteDis['Discount'];
        }
      }
      ?>
      <tr>
        <th colspan="1">Discount:</th>
        <td colspan="2"><?php echo $dis;?></td>
        <th colspan="2">Total Price:</th>
        <td colspan="2"><?php echo "$ ".$totalPrice;?></td>
      </tr>
    <?php endif;?>

  <?php if($quoteInfo['Status'] == 'Ordered'):?>
    <tr>
      <th>Order Id</th>
      <th colspan="2">Process Day</th>
      <th colspan="2">Final Price</th>
      <th colspan="2">Commission</th>
    </tr>
    <?php $getQuoteOrd = "select * from Ordered_Quote where Quote_Id = ".$_POST['QId'].";";
    $result2 = $pdo->query($getQuoteOrd);
    if ($result2 == false){echo "Failed to access Plant Repair database";}
    $quoteOrd = $result2->fetch();?>
    <tr>
      <td><?php echo $quoteOrd['Quote_Id'];?></td>
      <td colspan="2"><?php echo $quoteOrd['processDay'];?></td>
      <td colspan="2"><?php echo "$ ".$quoteOrd['finalPrice'];?></td>
      <td colspan="2"><?php echo "$ ".$quoteOrd['commiss'];?></td>
    </tr>
  <?php endif;?>
</table>

<form action="views.php" method = "POST">
  <?php if (isset($_POST['final'])):?>
    <input type="hidden" name="final" value=<?php echo "\"".$_POST['final']."\"";?>/> <?php endif;?>
  <?php if (isset($_POST['sanc'])):?>
    <input type="hidden" name="sanc" value=<?php echo "\"".$_POST['sanc']."\"";?>/> <?php endif;?>
  <?php if (isset($_POST['order'])):?>
    <input type="hidden" name="order" value=<?php echo "\"".$_POST['order']."\"";?>/> <?php endif;?>
  <?php if (isset($_POST['day1'])):?>
    <input type="hidden" name="day1" value=<?php echo "\"".$_POST['day1']."\"";?>/> <?php endif;?>
  <?php if (isset($_POST['day2'])):?>
    <input type="hidden" name="day2" value=<?php echo "\"".$_POST['day2']."\"";?>/> <?php endif;?>
  <?php if (isset($_POST['sAsso'])):?>
    <input type="hidden" name="sAsso" value=<?php echo "\"".$_POST['sAsso']."\"";?>/> <?php endif;?>
  <?php if (isset($_POST['sCust'])):?>
    <input type="hidden" name="sCust" value=<?php echo "\"".$_POST['sCust']."\"";?>/> <?php endif;?>
  <input type="submit" value="Back"/>
</form>
