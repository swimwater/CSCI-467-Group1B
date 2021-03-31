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

		<button onclick="addLineItem()">Add line item</button>

		<table id="lineItemTable" class="mx-auto">
			<!--Header row-->
			<tr>
				<th style="width: 40rem">Line Item Description</th>
				<th style="width: 8rem">Price</th>
				<th style="width: 4rem">Remove</th>
			</tr>

			<?php
			try{
				include("credentials.php");
				//Connect to the database
				$dsn = "mysql:host=courses;dbname=z1866716";

				$pdo = new PDO($dsn,$username,$password);
	
				$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

				//Get all the quotes in the database.
				$query = $pdo->prepare("SELECT * FROM Quote_Descript WHERE Quote_Id=:selectedQuoteID"); 

				$query->execute(array(":selectedQuoteID" => $_POST["quoteID"]));
		
				$quoteLineItems = $query->fetchAll(PDO::FETCH_ASSOC);

				echo '<form action="http://students.cs.niu.edu/~z1866716/manageQuotesDetail.php" method="POST">';
				
				echo '<h2> Edit quote line items:</h2>';

				foreach($quoteLineItems as $lineItem)
				{
					$descriptionTextField = '<input type="text" class="w-100" name="description#'.$lineItem["Descrip_Id"].'#" value="'.$lineItem["Descript"].'"/>';
					$priceTextField = '<input type="number" class="w-100" step="0.01"name="price#'.$lineItem["Descrip_Id"].'#" value="'.$lineItem["Price"].'"/>';

					$removeButton = '<button style="w-100" onclick="removeLineItem('.$lineItem["Descrip_Id"].')">Remove</button>';

					//Print the table row with the line item description and price.
					echo '<tr id='.$lineItem["Descrip_Id"].'><td>'.$descriptionTextField.'</td><td>'.$priceTextField.'</td><td>'.$removeButton.'</td></tr>';
				}

			}
			catch(PDOexception $e){
				echo "Failed to connect to database:" . $e->getMessage(); //Print the error message if we fail to connect.
			}

			?>
		</table>

		<?php
			// allow the user to edit the note attached to this quote.
			echo '<h2> Edit quote notes:</h2>';
			echo '<input type="text" name="snotes#'.$_POST["quoteID"].'#" value="'.$_POST["sNote"].'"/><br>';
		?>

		<!--The button that will submit the form to save the current line edits to the database.-->
		<input type="submit" value="Save Changes to Quote"/>

		</form>
	</div>
	</body>

	

</html>

<script>

var rowID = 1;

function addLineItem() {

	// create line item fields, and removal button:
	var descriptionTextField = '<input type="text" class="w-100" name="description#' + rowID + '#" placeholder="Enter line item description"/>';
	var priceTextField = '<input type="number" class="w-100" step="0.01"name="price#' + rowID + '#" placeholder="0.00"/>';
	var removeButtonHTML = '<button style="w-100" onclick="removeLineItem(' + rowID + ')">Remove</button>';

	// combine fields into new line item table row.
	var newLineItemHTML = "<tr id=" + rowID + "><td>" + descriptionTextField + "</td><td>" + priceTextField + "</td><td>" + removeButtonHTML + "</td></tr>";

	// append the row to the line item table.
	$("#lineItemTable").append(newLineItemHTML);

	rowID++; // increment the row id tracker
}

// removes a line item from the table, causing it to not be added or be removed from the quote.
function removeLineItem(itemID) {

	event.preventDefault(); // suppress form submission

	$("#" + itemID).remove(); // delete the line item

	rowID--; // decrement the row id tracker
}

</script>