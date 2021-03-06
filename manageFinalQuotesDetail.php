<!--- edit a specific finalized quote --->

<?php
    require("session.php");
    require("secrets.php");
	if(!isset($_POST["quoteID"]))
	{
	  header('Location:manageUnfinalQuotesHeader.php');
	}
?>
<?php
  $poSiTion = "select Pos from Associate where User_Id = ".$_SESSION["user_id"].";";
  $rEsUlT = $pdo->query($poSiTion);
  $pOs = $rEsUlT->fetch();
  if ($pOs['Pos'] == 0) {header("Location: record.php");}
 ?>
<html>
	<head>
		<!--include bootstrap CSS via CDN and custom stylesheet --->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="associateManageQuote.css" />

		<!--include jquery and bootstrap javascript via CDN --->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	</head>

	<body>

	<?php require "navbar.php" ?>

	<div class="container-fluid">

		<h1 class="pt-2">Quote <?php echo $_POST["quoteID"]?> - Edit Details and Sanction</h1>

		<!-- button for adding line items -->
		<button class="btn btn-success mt-3 mb-3" onclick="addLineItem()">Add Line Item</button>

		<form action="manageFinalQuotesUpdateDB.php" method="POST">

		<!-- line item table-->
		<table class="table table-bordered table-dark" id="lineItemTable">

			<tr>
				<th style="width: 70%">Line Item Description</th>
				<th style="width: 20%">Price</th>
				<th style="width: 10%">Remove</th>
			</tr>

			<?php
            echo '<br>';
			try{

				// get all line items pertaining to the selected quote
				$query = $pdo->prepare("SELECT * FROM Quote_Descript WHERE Quote_Id=:selectedQuoteID");
				$query->execute(array(":selectedQuoteID" => $_POST["quoteID"]));
				$quoteLineItems = $query->fetchAll(PDO::FETCH_ASSOC);

				//track the total cost of all the line items.
				$totalCost = 0;

				// create a hidden field to pass along quote id
				echo '<input type="hidden" id="quoteID" name="quoteID" value="'.$_POST["quoteID"].'">';

				// for each line item that exists for this quote in the database, create a table row in the line item table:
				$n = 0;
				foreach($quoteLineItems as $lineItem)
				{
					$n++; // increment the count of total line items present in the grid

					// create the form controls for each column in the grid row
					$descriptionTextField = '<input type="text" class="form-control text-light bg-dark w-100" id="description'.$n.'" name="description'.$n.'" value="'.$lineItem["Descript"].'"/>';
					$priceField = '<input type="number" class="form-control  text-light bg-dark w-100" min="0" step="0.01" id="price'.$n.'" name="price'.$n.'" value="'.$lineItem["Price"].'" onchange="calculateTotal()"/>';
					$removeButton = '<button type="button" class="btn btn-danger w-100" onclick="removeLineItem('.$n.')">Remove</button>';

					// add a hidden field containing the database line item id. This will later be used to determine if the row is currently in the database when we go to save changes
					echo '<input type="hidden" id="lineItemID'.$n.'" name="lineItemID'.$n.'" value="'.$lineItem['Descrip_Id'].'">';

					// add a hidden field containing whether the row is deleted.
					echo '<input type="hidden" id="deleted'.$n.'" name="deleted'.$n.'" value="false">';

					// add the table row to the page
					echo '<tr id='.$n.'><td>'.$descriptionTextField.'</td><td>'.$priceField.'</td><td>'.$removeButton.'</td></tr>';

					//add the cost of this line item to calculation:
					$totalCost = $totalCost + $lineItem["Price"];

				}
				echo '</table>';

				// hidden field containing the number of line items in the grid
				echo '<input type="hidden" id="numLineItems" name="numLineItems" value="'.$n.'">';

				// allow the user to edit the note attached to this quote
				echo '<div class="row">';
				echo '<div class="col-3">';
				echo '<label for="snotes" class="text-light">Edit notes for quote:</label>';
				echo '<input type="text" class="form-control text-light bg-dark" id="snotes" name="snotes" value="'.$_POST["sNote"].'"/><br>';
				echo '</div>';
				echo '<div class="col-3"></div>';
				echo '<div class="col-3"></div>';
				echo '<div class="col-3"></div>';
				echo '</div>';

				echo '<div class="row">';

                if($_POST['discount'] != "")
                {
					echo '<div class="col-3">';
					//discount is nonzero, so check what type of discount it is:
					if($_POST['percentage'] == 1) //discount is a percent
					{
						//create type drop down with percentage selected:
						echo '<div class="form-group">
						<label for="discountTypeDropdown">Discount Type:</label>
						<select class="form-control text-light bg-dark" id="discountTypeDropdown" name="discountTypeDropdown" onchange="calculateTotal()" value="Dollar Amount">
						<option value="Percentage">Percentage</option>
						<option value="Dollar Amount">Dollar Amount</option>
						</select>
						</div>';

						$totalCost = $totalCost - ($totalCost * ($_POST['discount'] / 100.0)); //take the percentage discount off the total cost.
					}
					else //if it is a dollar amount or unset,
					{
						//create type drop down with dollar amount selected:
						echo '<div class="form-group">
						<label for="discountTypeDropdown">Discount Type:</label>
						<select class="form-control text-light bg-dark" id="discountTypeDropdown" name="discountTypeDropdown" onchange="calculateTotal()" value="Dollar Amount">
						<option value="Percentage">Percentage</option>
						<option selected value="Dollar Amount">Dollar Amount</option>
						</select>
						</div>';

						$totalCost = $totalCost - $_POST['discount']; //subtract the discount from the total cost
					}
					echo '</div>';
                }
                else
                {
					echo '<div class="col-3">';
					//create type drop down with dollar amount selected:
					echo '<div class="form-group">
					<label for="discountTypeDropdown">Discount Type:</label>
					<select class="form-control text-light bg-dark" id="discountTypeDropdown" name="discountTypeDropdown" onchange="calculateTotal()" value="Dollar Amount">
					<option value="Percentage">Percentage</option>
					<option selected value="Dollar Amount">Dollar Amount</option>
					</select>
					</div>';
					echo '</div>';
                }
				echo '<div class="col-3">';
				echo '<label for="discountAmount" class="text-light">Discount Amount:</label>';
				echo '<input type="number" min="0" step="0.01" class="form-control text-light bg-dark" id="discountAmount" name="discountAmount" value="'.$_POST['discount'].'" onchange="calculateTotal()"/><br>';
				echo '</div>';

				echo '<div class="col-3"></div>';
				echo '<div class="col-3"></div>';
				echo '</div>';

				echo '<h2>Quote Total:</h2>';
				$formattedCost = number_format($totalCost, 2);
				echo '<input class="form-control text-light bg-dark w-25 mb-3" id="quoteTotal" type="text" value="$'.$formattedCost.'" readonly>';
			}
			catch(PDOexception $e){
				// print the error message if we encounter an exception
				echo "Error obtaining or processing quote details: " . $e->getMessage();
			}
		?>

		<div class="form-check pb-3">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="sanctionCheckbox" value="">Sanction Quote
            </label>
		</div>

		<div class="row">

		<!-- a back button to take the user back to the header view -->
		<a class="btn btn-danger ml-2 mr-2" href="manageFinalQuotesHeader.php" role="button">Cancel</a>

		<!--the button that will submit the form and save the current line edits to the database.-->
		<button type="submit" class="btn btn-success">Save Changes</button>

		</div>



		</form>
	</div>

	</body>

</html>

<script>

var newestLineItemID;
var rowID = 1;

// dynamically add a line item to the line item table, adjusting the running total of line items
function addLineItem() {
	if(newestLineItemID != undefined)
	{
		if($("#description" + newestLineItemID)[0].value == "" || $("#price" + newestLineItemID)[0].value == "")
		{
			alert("Please fill out the description and price fields in the new line item before adding a new one.");
			return;
		}
	}

	// retrieve and increment the number of line items in the grid
	var numLineItems = $("#numLineItems").val();
	numLineItems++;

	// create line item fields, and removal button:
	var descriptionTextField = '<input type="text" class="form-control text-light bg-dark w-100" id="description' + numLineItems + '" name="description' + numLineItems + '" placeholder="Enter line item description"/>';
	var priceField = '<input type="number" class="form-control text-light bg-dark w-100" min="0" step="0.01" id="price' + numLineItems + '" name="price' + numLineItems + '" placeholder="0.00" onchange="calculateTotal()"/>';
	var removeButtonHTML = '<button type="button" class="btn btn-danger w-100" onclick="removeLineItem(' + numLineItems + ')">Remove</button>';

	// combine fields into new line item table row.
	var newLineItemHTML = "<tr id=" + numLineItems + "><td>" + descriptionTextField + "</td><td>" + priceField + "</td><td>" + removeButtonHTML + "</td></tr>";

	//create an id field for the new line item containing #, so the confirmation page knows this is a new line item and does not already exist in the database.
	var idFieldHTML = '<input type="hidden" id="lineItemID' + numLineItems + '" name="lineItemID' + numLineItems + '" value="#">';

	// add a hidden field containing whether the row is deleted.
	var deletedFieldHTML = '<input type="hidden" id="deleted' + numLineItems + '" name="deleted' + numLineItems + '" value="false">';

	// append the row to the line item table.
	$("#lineItemTable").append(newLineItemHTML);

	// append the id and deleted fields to the new row.
	$("#" + numLineItems).append(idFieldHTML);
	$("#" + numLineItems).append(deletedFieldHTML);

	newestLineItemID = numLineItems;

	// set the number of line items equal to the new total.
	$("#numLineItems").val(numLineItems);
}

// removes a line item from the table, causing it to not be added or be removed from the existing quote.
function removeLineItem(itemID) {
	$("#deleted" + itemID).val("true"); // set deleted status to true

	$("#" + itemID).css("display", "none"); // hide the line item to the user

	$("#price" + itemID).remove(); //delete its price field

	//As we have removed the newest line item, clear the reference to the newest line item.
	newestLineItemID = undefined;

	calculateTotal(); //recalculate the total with the remaining line items.
}

function calculateTotal() {
	//total line items:
	var totalCost = 0;

	var numLineItems = $("#numLineItems").val();
	var i;
	for(i = 1; i <= numLineItems; i++)
	{
		//if the row has not been deleted, factor it in the calculation
		if($("#deleted" + i).val() == "false" && !isNaN(parseFloat($("#price" + i).val())))
		{
			totalCost = totalCost + parseFloat($("#price" + i).val())
		}
	}

	//apply discount:
	if($("#discountTypeDropdown").val() == "Percentage" && !isNaN(parseFloat($("#discountAmount").val()))) //percentage
	{
		totalCost = totalCost - (totalCost * (parseFloat($("#discountAmount").val() / 100.0)));
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
	var formattedTotal = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(totalCost);

	//display new total:
	$("#quoteTotal").val(formattedTotal);
}

</script>
