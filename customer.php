<?php
    require_once("legacyDatabase.php");
    require_once("session.php");
    require_once("secrets.php");
    require_once("functions.php");
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

  <title>Customer Form</title>
</head>
<body>
  <!--nav bar-->
  <?php require "navbar.php"?>
  <h1>Customer Information</h1>
    
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

<!--New area-->
<?php
  //date range
  if (isset($_POST['day1'])) {$day1 = $_POST['day1'];} else {$day1 = date("Y/m/d");}
  if (isset($_POST['day2'])) {$day2 = $_POST['day2'];} else {$day2 = date("Y/m/d");}
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
  if(isset($_POST['sCust']))
  {$cust = "where name LIKE '%".$_POST['sCust']."%'";} else {$cust = "";}
  
  //id
  if(isset($_POST['sQuoteID']))
        {$quote_ID = "and Quote.Quote_Id LIKE '%".$_POST['sQuoteID']."%'";} else {$quote_ID = "";}
 ?>

 <form action="customer.php" method="POST">

   <label for="start">Start date:</label>
   <input type="date" id="start" name="day1" min="1995-01-01" value = <?php echo "\"".date("Y/m/d")."\"";?> required>

   <label for="end">End date:</label>
   <input type="date" id="end" name="day2" min="1995-01-01" value = <?php echo "\"".date("Y/m/d")."\"";?> required><br>

   <input type="text" name="sCust" placeholder="Search by Customer"/><br>
   <input type="text" name="sQuoteID" placeholder="Search by ID number"/><br>
   <input type="submit" name="search" value="Search"/><br>
 </form>

<?php
 $getCustId = "select id, name, city, street, contact from customers ".$cust.";";
 $result = $pdo2->query($getCustId);
 if ($result == false){echo "Failed to access Legacy database";}
 $cnt = 1;

 while ($custInfo = $result->fetch())
 {
   $custName[$custInfo['id']] = $custInfo['name'];
   $custCity[$custInfo['id']] = $custInfo['city'];
   $custStreet[$custInfo['id']] = $custInfo['street'];
   $custCont[$custInfo['id']] = $custInfo['contact'];
 }
 ?>

 <?php
  $getQuoteInfo = "select Quote_Id, Cust_Id, SNote, cast(Date as date) as DateMade, Quote.User_Id  from Quote where Quote.User_Id and Quote.Status = 'Unfinalized' ".$date." ".$quote_ID.";";
  $result2 = $pdo->query($getQuoteInfo);
  if ($result2 == false){echo "Failed to access Plant Repair database";}
 ?>

 <table>
   <tr align: left;>
     <th>Customer</th>
     <th>Customer Contact</th>
     <th>City</th>
     <th>Street</th>
     <th>Date Created</th>
     <th>Customer Id</th>
     <th>Quote Id</th>
     <th>Secret Notes</th>
     <th>View Quote Info</th>
   </tr>
   <?php while ($quoteInfo = $result2->fetch()):?>
     <tr>
      <?php if ($quoteInfo['User_Id'] && array_key_exists($quoteInfo['Cust_Id'], $custName)):?>
        <td><?php echo $custName[$quoteInfo['Cust_Id']];?></td>
        <td><?php echo $custCont[$quoteInfo['Cust_Id']];?></td>
        <td><?php echo $custCity[$quoteInfo['Cust_Id']];?></td>
        <td><?php echo $custStreet[$quoteInfo['Cust_Id']];?></td>
        <td><?php echo $quoteInfo['DateMade'];?></td>
        <td><?php echo $quoteInfo['Cust_Id'];?></td>
        <td><?php echo $quoteInfo['Quote_Id'];?></td>
        <td><?php echo $quoteInfo['SNote'];?></td>
        <td>
          <form action="custDescript.php" method="POST">
            <input type="hidden" name="custId" value=<?php echo "\"".$quoteInfo['Cust_Id']."\"";?>/>
            <input type="hidden" name="quoteId" value=<?php echo "\"".$quoteInfo['Quote_Id']."\"";?>/>
            <input type="hidden" name="custName" value=<?php echo "\"".$custName[$quoteInfo['Cust_Id']]."\"";?>/>
            <input type="hidden" name="custCity" value=<?php echo "\"".$custCity[$quoteInfo['Cust_Id']]."\"";?>/>
            <input type="hidden" name="custStreet" value=<?php echo "\"".$custStreet[$quoteInfo['Cust_Id']]."\"";?>/>
            <input type="hidden" name="custCont" value=<?php echo "\"".$custCont[$quoteInfo['Cust_Id']]."\"";?>/>
            <input type="submit" value="Quote Details"/>
          </form>
        </td>
      <?php endif;?>
     </tr>
   <?php endwhile;?>
 </table>
</html>
