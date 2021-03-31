<!--- edit a specific unfinalized quote --->

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
	<div class="container-fluid">

		<h1>Edit Details - Quote #<?php echo $_POST["quoteID"]?></h1>		

		<h2> Edit quote line items:</h2>
		<button onclick="addLineItem()">Add line item</button>

		<form action="http://students.cs.niu.edu/~z1866716/manageQuotesUpdateDatabase.php" method="POST">
		
		<table id="lineItemTable">
			<!-- header row for line item table-->
			<tr>
				<th style="width: 40rem">Line Item Description</th>
				<th style="width: 8rem">Price</th>
				<th style="width: 4rem">Remove</th>
			</tr>

			<?php
			try{
				include("credentials.php");
				// connect to the database
				$dsn = "mysql:host=courses;dbname=z1866716";

				$pdo = new PDO($dsn,$username,$password);
	
				$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

				// get all the quotes in the database.
				$query = $pdo->prepare("SELECT * FROM Quote_Descript WHERE Quote_Id=:selectedQuoteID"); 

				$query->execute(array(":selectedQuoteID" => $_POST["quoteID"]));
		
				$quoteLineItems = $query->fetchAll(PDO::FETCH_ASSOC);

				echo '<input type="hidden" id="quoteID" name="quoteID" value="'.$_POST["quoteID"].'">';

				echo '<input type="hidden" id="deletedRows" name="deletedRows" value="">';
				
				$n = 0; // number of line items
				foreach($quoteLineItems as $lineItem)
				{
					$n++;
					$descriptionTextField = '<input type="text" class="w-100" name="description'.$n.'" value="'.$lineItem["Descript"].'"/>';
					$priceTextField = '<input type="number" class="w-100" step="0.01"name="price'.$n.'" value="'.$lineItem["Price"].'"/>';

					$removeButton = '<button style="w-100" onclick="removeLineItem('.$n.')">Remove</button>';
					
					echo '<input type="hidden" id="lineItemID'.$n.'" name="lineItemID'.$n.'" value="'.$lineItem['Descrip_Id'].'">';

					// print the table row with the line item description and price.
					echo '<tr id='.$n.'><td>'.$descriptionTextField.'</td><td>'.$priceTextField.'</td><td>'.$removeButton.'</td></tr>';

				}
				
				echo '</table>';
				// hidden field containing the number of line items.
				echo '<input type="hidden" id="numLineItems" name="numLineItems" value="'.$n.'">';

			}
			catch(PDOexception $e){
				// print the error message if we fail to connect.
				echo "Failed to connect to database:" . $e->getMessage(); 
			}

			?>
		<!--</table>-->

		<?php
			// allow the user to edit the note attached to this quote.
			echo '<h2> Edit quote notes:</h2>';
			echo '<input type="text" name="snotes" value="'.$_POST["sNote"].'"/><br>';
		?>

		<!--the button that will submit the form to save the current line edits to the database.-->
		<input type="submit" value="Save Changes to Quote"/>

		</form>
	</div>
	</body>

	

</html>

<script>

var rowID = 1;

function addLineItem() {

	var numLineItems = $("#numLineItems").val();
	numLineItems++;

	// create line item fields, and removal button:
	var descriptionTextField = '<input type="text" class="w-100" name="description' + numLineItems + '" placeholder="Enter line item description"/>';
	var priceTextField = '<input type="number" class="w-100" step="0.01"name="price' + numLineItems + '" placeholder="0.00"/>';
	var removeButtonHTML = '<button style="w-100" onclick="removeLineItem(' + numLineItems + ')">Remove</button>';

	// combine fields into new line item table row.
	var newLineItemHTML = "<tr id=" + numLineItems + "><td>" + descriptionTextField + "</td><td>" + priceTextField + "</td><td>" + removeButtonHTML + "</td></tr>";

	//create an id field for the new line item containing #, so the confirmation page knows this is a new line item and does not already exist in the database.
	var idFieldHTML = '<input type="hidden" id="lineItemID' + numLineItems + '" name="lineItemID' + numLineItems + '" value="#">';

	// append the row to the line item table.
	$("#lineItemTable").append(newLineItemHTML);

	// append the id field to the new row.
	$("#" + numLineItems).append(idFieldHTML);

	$("#numLineItems").val(numLineItems);
}

// removes a line item from the table, causing it to not be added or be removed from the existing quote.
function removeLineItem(itemID) {
	event.preventDefault(); // suppress form submission

	//update the deleted rows with this line item if it already exists in the database:
	if($("#lineItemID" + itemID).val() != "#")
	{
		var deletedRows = $("#deletedRows").val();
		$("#deletedRows").val(deletedRows + $("#lineItemID" + itemID).val() + ",");
	}

	$("#" + itemID).remove(); // delete the line item
	

	var numLineItems = $("#numLineItems").val();
	numLineItems--;
	$("#numLineItems").val(numLineItems);
}

</script>