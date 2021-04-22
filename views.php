<?php
    include("functions.php");
    require("session.php");
    include("secrets.php");
    include("legacyDatabase.php");
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
    <div class="display">
      <h1>VIEWS QUOTES</h1>
    </div>

    <br>
    </body>
<?php
  //status
  if (isset($_POST['final']) && isset($_POST['sanc']) && isset($_POST['order']))
  {$status = "and (Quote.Status = 'Finalized' or Quote.Status = 'Sanctioned' or Quote.Status = 'Ordered')";}
  else if (isset($_POST['final']) && isset($_POST['sanc']))  {$status = "and (Quote.Status = 'Finalized' or Quote.Status = 'Sanctioned')";}
  else if (isset($_POST['final']) && isset($_POST['order'])) {$status = "and (Quote.Status = 'Finalized' or Quote.Status = 'Ordered')";}
  else if (isset($_POST['sanc'])  && isset($_POST['order'])) {$status = "and (Quote.Status = 'Sanctioned' or Quote.Status = 'Ordered')";}
  else if (isset($_POST['final'])) {$status = "and Quote.Status = 'Finalized'";}
  else if (isset($_POST['sanc']))  {$status = "and Quote.Status = 'Sanctioned'";}
  else if (isset($_POST['order'])) {$status = "and Quote.Status = 'Ordered'";}
  else {$status = "and (Quote.Status = 'Finalized' or Quote.Status = 'Sanctioned' or Quote.Status = 'Ordered')";}
  //date range
  if (isset($_POST['day1'])) {$day1 = $_POST['day1'];} else {$day1 = date("Y-m-d");}
  if (isset($_POST['day2'])) {$day2 = $_POST['day2'];} else {$day2 = date("Y-m-d");}
  if ($day1 < $day2)
  {
    $date = " and cast(Quote.Date as date) >= '".$day1."' and cast(Quote.Date as date) <= '".$day2."'";
  }
  else if ($day1 > $day2)
  {
    $date = " and cast(Quote.Date as date) <= '".$day1."' and cast(Quote.Date as date) >= '".$day2."'";
  }
  else
  {
    $date = " and cast(Quote.Date as date) = '".$day1."'";
  }
  //people
  if(isset($_POST['sAsso']))
  {$asso = "and Associate.Name LIKE '%".$_POST['sAsso']."%'";} else {$asso = "";}
  if(isset($_POST['sCust']))
  {$cust = "where name LIKE '%".$_POST['sCust']."%'";} else {$cust = "";}
 ?>

<div class="display">
  <form action="views.php" method="POST">
      <input type="checkbox" class="MYCHECKBOX" id="final" name="final" value="Finalized" <?php if (isset($_POST['final'])) {echo "checked";}?>>
      <label class="CHECKLABEL" id="FINAL" for="final">Finalized</label><br>
      <input type="checkbox" class="MYCHECKBOX" id="sanc" name="sanc" value="Sanctioned" <?php if (isset($_POST['sanc'])) {echo "checked";}?>>
      <label class="CHECKLABEL" id="SANC" for="sanc">Sanctioned</label><br>
      <input type="checkbox" class="MYCHECKBOX" id="order" name="order" value="Ordered" <?php if (isset($_POST['order'])) {echo "checked";}?>>
      <label class="CHECKLABEL" id="ORDER" for="order">Ordered</label><br>
      <label class="DATELABEL" id="STARTLABEL" for="start">Start date:</label>
      <input class="DATE"type="date" id="start" name="day1" min="1995-01-01" value = <?php echo "\"".$day1."\"";?> required></br>

      <label class="DATELABEL" id="ENDLABEL" for="end">End date:</label>
      <input class="DATE" type="date" id="end" name="day2" min="1995-01-01" value = <?php echo "\"".$day2."\"";?> required><br>
      <input type="text" class="CUSTOMINPUT" id="ASSOC" name="sAsso" value = <?php if(isset($_POST['sAsso'])) {echo "\"".$_POST['sAsso']."\"";} else {echo "\"\"";}?> placeholder="Search by Sales Associate"/><br>
      <input type="text" class="CUSTOMINPUT" id="CUST" name="sCust" value = <?php if(isset($_POST['sAsso'])) {echo "\"".$_POST['sCust']."\"";} else {echo "\"\"";}?> placeholder="Search by Customer"/><br>
      <input type="submit" class="CUSTOMSUBMIT" name="search" value="Search"/><br>
  </form>
</div>

 <?php
 $getCustId = "select id, name, contact from customers ".$cust.";";
 $result = $pdo2->query($getCustId);
 if ($result == false){echo "Failed to access Legacy database";}
 $cnt = 1;

 while ($custInfo = $result->fetch())
 {
   $custName[$custInfo['id']] = $custInfo['name'];
   $custCont[$custInfo['id']] = $custInfo['contact'];
 }
 ?>

 <?php
  $getQuoteInfo = "select Quote_Id, Name, Cust_Id, SNote, Status, cast(Date as date) as DateMade, Associate.User_Id as AsId, Quote.User_Id
  from Associate, Quote where Associate.User_Id = Quote.User_Id and
  Quote.Status != 'Unfinalized' ".$status." ".$date." ".$asso.";";
  $result2 = $pdo->query($getQuoteInfo);
  if ($result2 == false){echo "Failed to access Plant Repair database";}
 ?>

<div class="display">
  <table>
    <tr align: left;>
      <th>Customer</th>
      <th>Customer Contact</th>
      <th>Associate</th>
      <th>Quote Id</th>
      <th>Date Created</th>
      <th>Status</th>
      <th>Secret Notes</th>
      <th>View Quote Info</th>
    </tr>
    <?php while ($quoteInfo = $result2->fetch()):?>
      <tr>
        <?php if ($quoteInfo['User_Id'] == $quoteInfo['AsId'] && array_key_exists($quoteInfo['Cust_Id'], $custName)):?>
          <td><?php echo $custName[$quoteInfo['Cust_Id']];?></td>
          <td><?php echo $custCont[$quoteInfo['Cust_Id']];?></td>
          <td><?php echo $quoteInfo['Name'];?></td>
          <td><?php echo $quoteInfo['Quote_Id'];?></td>
          <td><?php echo $quoteInfo['DateMade'];?></td>
          <td><?php echo $quoteInfo['Status'];?></td>
          <td><?php echo $quoteInfo['SNote'];?></td>
          <td>
            <form action="viewDescript.php" method="POST">
              <input type="hidden" name="custName" value=<?php echo "\"".$custName[$quoteInfo['Cust_Id']]."\"";?>/>
              <input type="hidden" name="custCont" value=<?php echo "\"".$custCont[$quoteInfo['Cust_Id']]."\"";?>/>
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
              <input type="hidden" name="QId" value=<?php echo "\"".$quoteInfo['Quote_Id']."\"";?>/>
              <input type="submit" value="Quote Details"/>
            </form>
          </td>
        <?php endif;?>
      </tr>
    <?php endwhile;?>
  </table>
</div>

</html>
