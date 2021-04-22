<?php
    require_once("session.php");
    require_once("secrets.php");
?>

<!DOCTYPE html>
<html>
<head>
<!--include jquery via CDN --->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>TRANSFER QUOTE</title>

<link rel="stylesheet" href="manage.css">

</head>
<body>
  <!--nav bar-->
  <?php require "navbar.php"?>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <div class="display">
      <h1>TRANSFER QUOTE RECORDS TO OTHER ASSOCIATES</h1>
    

      <br>

      <p class="MYP" id="FROM">FROM:</p>
      <p class="MYP" id="TO">TO:</p>
    </div>
</body>

<?php

  $getAssocInfo = "select User_Id, Name from Associate;";
  $result2 = $pdo->query($getAssocInfo);
  if ($result2 == false){echo "Failed to access Plant Repair database";}
  $getAssocInfo2 = "select User_Id, Name from Associate;";
  $result3 = $pdo->query($getAssocInfo2);
  if ($result3 == false){echo "Failed to access Plant Repair database";}

  if (isset($_POST['Asso1']))
  {
    $getQuoteRecord = "select Associate.User_Id, Name, Pos, Quote_Id, Status from Associate, Quote
    where Associate.User_Id = ".$_POST['Asso1']." and Quote.User_Id = ".$_POST['Asso1'].";";
    $User_Id = $_POST['Asso1'];
    $User_Id2 = $_POST['Asso2'];
  }
  else if (isset($_SESSION['User_Id']))
  {
    $getQuoteRecord = "select Associate.User_Id, Name, Pos, Quote_Id, Status from Associate, Quote
    where Associate.User_Id = ".$_SESSION['User_Id']." and Quote.User_Id = ".$_SESSION['User_Id'].";";
    $User_Id = $_SESSION['User_Id'];

    if(isset($_SESSION['User_Id2']))
    {
      $User_Id2 = $_SESSION['User_Id2'];
    }
    else
    {
      $get1Assoc = "select User_Id from Associate;";
      $get1 = $pdo->query($get1Assoc);
      if ($get1 == false){echo "Failed to access Plant Repair database";}
      $getFirst = $get1->fetch();
      $first = $getFirst['User_Id'];
    }
  }
  else
  {
    $get1Assoc = "select User_Id from Associate;";
    $get1 = $pdo->query($get1Assoc);
    if ($get1 == false){echo "Failed to access Plant Repair database";}
    $getFirst = $get1->fetch();
    $first = $getFirst['User_Id'];

    $getQuoteRecord = "select Associate.User_Id, Name, Pos, Quote_Id, Status from Associate, Quote
    where Associate.User_Id = ".$first." and Quote.User_Id = ".$first.";";
  }
  $result = $pdo->query($getQuoteRecord);
  if ($result == false){echo "Failed to access Plant Repair database";}
?>
  <div class="display">
    <form action="" method="POST" id="AssoForm">
      <select id="Asso1" class="CUSTOMSELECT" name="Asso1" onchange="submit()">
        <?php while ($AssocInfo = $result2->fetch()):?>
          <option <?php if (isset($User_Id)){if ($User_Id == $AssocInfo['User_Id']) {echo "selected";}} else if (isset($first)){ if ($first == $AssocInfo['User_Id']) {echo "selected";}}?> value=<?php echo "\"".$AssocInfo['User_Id']."\"";?>><?php echo $AssocInfo['User_Id'].": ".$AssocInfo['Name'];?></option>
        <?php endwhile;?>
      </select>
      <select id="Asso2" class="CUSTOMSELECT" name="Asso2" onchange="submit()">
        <?php while ($AssocInfo2 = $result3->fetch()):?>
          <option <?php if (isset($User_Id2)){if ($User_Id2 == $AssocInfo2['User_Id']) {echo "selected";}} ?> value=<?php echo "\"".$AssocInfo2['User_Id']."\"";?>><?php echo $AssocInfo2['User_Id'].": ".$AssocInfo2['Name'];?></option>
        <?php endwhile;?>
      </select>
    </form>
  </div>

  <?php
    if (isset($User_Id2)) {$Id2 = $User_Id2;} else {$Id2 = $first;}
    $getA2Name = "select Name, Pos from Associate where User_Id = ".$Id2.";";
    $result4 = $pdo->query($getA2Name);
    if ($result4 == false){echo "Failed to access Plant Repair database";}
    $A2Name = $result4->fetch();
    $Name2 = $A2Name['Name'];
    $Pos2 = $A2Name['Pos'];
  ?>
<div class="display">
  <form action = "processTransfer.php" method = "POST">
    <table>
      <tr align: left;>
        <th>Name</th>
        <th>Position</th>
        <th>Quote Id</th>
        <th>Name to Transfer To</th>
        <th>Position</th>
        <th>Select to Transfer</th>
      </tr>
      <?php while ($QuoteInfo = $result->fetch()):?>
        <tr>
          <td><?php echo $QuoteInfo['Name'];?></td>
          <td><?php if ($QuoteInfo['Pos'] == 2) {echo "Administrator";} else if ($QuoteInfo['Pos'] == 1) {echo "Employee";} else {echo "Associate";}?></td>
          <td><?php echo $QuoteInfo['Quote_Id'];?></td>
          <td><?php echo $Name2;?></td>
          <td><?php if ($Pos2 == 2) {echo "Administrator";} else if ($Pos2 == 1) {echo "Employee";} else {echo "Associate";}?></td>
          <td>
            <input type="checkbox" name='QId[]' value=<?php echo "\"".$QuoteInfo['Quote_Id']."\"";?>>
          </td>
        </tr>
      <?php endwhile;?>

          <input type="hidden" name="From" value = <?php if (isset($User_Id)){echo "\"".$User_Id."\"";} else if (isset($first)){echo "\"".$first."\"";} ?>/>
          <input type="hidden" name="To" value = <?php echo "\"".$Id2."\"";?>/>
          <input type="submit" class="SUBMIT" name="Transfer Quotes" value="Transfer"/>

    </table>
  </form>
</div>


</html>

<script>
  function submit()
  {
    $("#AssoForm").submit();
  }
</script>
