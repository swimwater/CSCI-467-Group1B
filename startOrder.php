<?php
  require("session.php");
  require("secrets.php");
  if(!isset($_POST['Quote_Id']))
  {
    header('Location:viewSanctionQuotes.php');
  }
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>START ORDERS</title>
<link rel="stylesheet" href="associateManageQuote.css">
<!--include jquery and bootstrap javascript via CDN --->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>

<body>
  <h1 class="pt-2">Quote <?php echo $_POST["Quote_Id"]?> - Apply Final Discount and Process Order</h1>
</body>

<?php
  $getQInfo = "select * from Quote where Quote_Id = ".$_POST['Quote_Id'].";";
  $result = $pdo->query($getQInfo);
  if ($result == false){echo "Failed to access Plant Repair database";}
  $QInfo = $result->fetch();

  $getQDet = "select * from Quote_Descript where Quote_Id = ".$_POST['Quote_Id'].";";
  $result2 = $pdo->query($getQDet);
  if ($result2 == false){echo "Failed to access Plant Repair database";}
  $totalPrice = 0;
  $finalPrice = 0;
?>

<div class="container-fluid">
  <table class="table table-bordered table-dark">
    <tr>
      <th style="width: 80%">Line Item Discription</th>
      <th style="width: 20%">Price</th>
    </tr>
    <?php while ($QDet = $result2->fetch()):?>
      <tr>
        <td><?php echo $QDet['Descript'];?></td>
        <td><?php echo $QDet['Price'];?></td>
      </tr>
      <?php $totalPrice += $QDet['Price'];?>
    <?php endwhile;?>
  </table>
</div>

<div class="container-fluid">
  <h5 class="pt-2">Secret Notes for Quote!! These will not be sent to the customer!!</h5>
  <table class="table table-bordered table-dark">
    <tr>
      <td><?php echo $QInfo['SNote'];?></td>
    </tr>
  </table>
</div>

<?php
$discount = 0;
if ($QInfo['Discount'] != NULL)
{
  if ($QInfo['Percent'] == 1)
  {
    $discount = ($QInfo['Discount'] / 100) * $totalPrice;
    $totalPrice = $totalPrice - $discount;
  }
  else
  {
    $totalPrice = $totalPrice - $QInfo['Discount'];
    $discount = $QInfo['Discount'];
  }
}
$finalPrice = $totalPrice;
?>

<div class="container-fluid">
  <h5 class="pt-2">Total Price:</h5>
  <table class="table table-bordered table-dark">
    <tr>
      <th>Discount:</th>
      <td><?php echo $discount;?></td>
    </tr>
    <tr>
      <th>Total:</th>
      <td><?php echo $totalPrice;?></td>
    </tr>
  </table>
</div>

<div class="row">
  <?php if($_POST['Discount'] != ""):?>
    <div class="col-3">
    <?php if($_POST['Percent'] == 1):?>
      <div class="form-group">
        <label for="discountTypeDropdown">Discount Type:</label>
        <select class="form-control text-light bg-dark" id="discountTypeDropdown" name="discountTypeDropdown" onchange="calculateTotal(<?php echo $finalPrice;?>)" value="Dollar Amount">
          <option value="Percent">Percentage</option>
          <option value="Dollar Amount">Dollar Amount</option>
        </select>
      </div>
      <?php $finalPrice = $finalPrice - ($finalPrice * ($_POST['Discount'] / 100));?>
    <?php else:?>
      <div class="form-group">
        <label for="discountTypeDropdown">Discount Type:</label>
        <select class="form-control text-light bg-dark" id="discountTypeDropdown" name="discountTypeDropdown" onchange="calculateTotal(<?php echo $finalPrice;?>)" value="Dollar Amount">
          <option value="Percent">Percentage</option>
          <option selected value="Dollar Amount">Dollar Amount</option>
        </select>
      </div>
      <?php $finalPrice = $finalPrice - $_POST['Discount']; ?>
    <?php endif;?>
    </div>
  <?php else:?>
    <div class="col-3">
      <div class="form-group">
        <label for="discountTypeDropdown">Discount Type:</label>
        <select class="form-control text-light bg-dark" id="discountTypeDropdown" name="discountTypeDropdown" onchange="calculateTotal(<?php echo $finalPrice;?>)" value="Dollar Amount">
          <option value="Percent">Percentage</option>
          <option selected value="Dollar Amount">Dollar Amount</option>
        </select>
      </div>
    </div>
  <?php endif;?>
<div class="col-3">
  <label for="discountAmount" class="text-light">Final Discount Amount:</label>
  <input type="number" min="0" step="0.01" class="form-control text-light bg-dark" id="discountAmount" name="discountAmount" value="'.$_POST['Discount'].'" onchange="calculateTotal(<?php echo $finalPrice;?>)"/><br>
</div>

<div class="container-fluid">
  <h2>Final Total:</h2>
  <form action="processOrder.php" method="POST">
  <?php $formattedCost = number_format($finalPrice, 2); ?>
  <input class="form-control text-light bg-dark w-25 mb-3" id="quoteTotal" name="amount" type="text" value=<?php echo "\"$".$formattedCost."\"";?> readonly>
</div>

<div class="container-fluid">
  <div class="row">
    <a class="btn btn-danger ml-2 mr-2" id=CANCEL href="viewSanctionQuotes.php" role="button">Cancel</a>
      <input type="hidden" name="orderNum" value=<?php echo "\"".$QInfo['Quote_Id']."\"";?>>
      <input type="hidden" name="Asso_Id" value=<?php echo "\"".$QInfo['User_Id']."\"";?>>
      <input type="hidden" name="Cust_Id" value=<?php echo "\"".$QInfo['Cust_Id']."\"";?>>
      <button type="submit" class="btn btn-success" id=PLACE onClick='sendEmail()'>Place Order</button>
    </form>
  </div>
</div>
</html>
<script>
function calculateTotal(totalCost) {
	//apply discount:
	if($("#discountTypeDropdown").val() == "Percent" && !isNaN(parseFloat($("#discountAmount").val()))) //percentage
	{
    var temp = parseFloat($("#discountAmount").val()) / 100;
		totalCost = totalCost - (totalCost * temp);
	}
	else if (!isNaN(parseFloat($("#discountAmount").val()))) //dollar amount
	{
		totalCost = totalCost - parseFloat($("#discountAmount").val());
	}

	if(totalCost < 0)
	{
		totalCost = 0;
	}

	//format for US currency. SOURCE: https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Intl/NumberFormat
	var formattedCost = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(totalCost);

	//display new total:
	$("#quoteTotal").val(formattedCost);
}

function sendEmail(){
  alert("An email has been sent to the customer containing the details for this order.");
  return;
}
</script>
