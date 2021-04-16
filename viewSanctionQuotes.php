<?php
  require("session.php");
  require("secrets.php");
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>SANCTIONED QUOTES</title>
<link rel="stylesheet" href="associateManageQuote.css">
<!--include jquery and bootstrap javascript via CDN --->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>

<body>
  <!--nav bar-->
  <?php require "navbar.php"?>
    <h1>Sanctioned Quotes</h1>
</body>
<div class="container-fluid">
<table class="table table-bordered table-dark">
  <!-- header row for finalized quotes table-->
  <tr>
    <th style="width: 15rem">Customer Name</th>
    <th style="width: 15rem">Customer Contact</th>
    <th style="width: 40rem">Notes</th>
    <th style="width: 8rem">Start Order</th>
  </tr>
<!--- connect to db and get finalized quotes, put them into a table-->
  <?php
    try{
      // get all unfinalized quotes that have this user associated with them.
      $query = $pdo->prepare("SELECT * FROM Quote WHERE Status='Sanctioned'");

      $query->execute();

      $finalizedQuotes = $query->fetchAll(PDO::FETCH_ASSOC);

      // connect to the legacy database containing customer information

      $legacyDsn = "mysql:host=blitz.cs.niu.edu;dbname=csci467";

      $legacyPdo = new PDO($legacyDsn,"student","student");

      $legacyPdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

      foreach($finalizedQuotes as $quote)
      {
        // get the customer information pertaining to this quote we're displaying
        $customerQuery = $legacyPdo->prepare("SELECT * FROM customers WHERE id=:customerId");

        $customerQuery->execute(array(":customerId" => $quote['Cust_Id']));

        $customerData = $customerQuery->fetchAll(PDO::FETCH_ASSOC)[0];

        echo '<form action="startOrder.php" method="POST">';

        // hidden field containing quote ID. This will be posted to the detail page, allowing us to find the quote's line items.
        echo '<input type="hidden" name="Quote_Id" value="'.$quote["Quote_Id"].'">';

        // hidden field containing secret quote notes. These notes will be posted to the following page where they are displayed for editing.
        echo '<input type="hidden" name="SNote" value="'.$quote["SNote"].'">';

                    // hidden field containing discount type. Will be posted to the following page.
        echo '<input type="hidden" name="Percent" value="">';

                    // hidden field containing secret quote notes. These notes will be posted to the following page where they are displayed for editing.
        echo '<input type="hidden" name="Discount" value="">';

        // the button that will submit the form to the page where the user will edit the quote in detail.
        $editButton = '<td><button type="submit" class="btn btn-success w-100">Order</button></td>';

        // print the table row with the quote button and information:
        echo '<tr><td>'.$customerData["name"].'</td><td>'.$customerData["contact"].'</td><td>'.$quote["SNote"].'</td>'.$editButton.'</tr>';

        echo "</form>";
      }
    }
    catch(PDOexception $e){
      echo "Failed to connect to database:" . $e->getMessage(); // print the error message if we fail to connect.
    }
  ?>
</table>
</div>

</html>
