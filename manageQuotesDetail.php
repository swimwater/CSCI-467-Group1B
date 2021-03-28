<html>
	<head>
	
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="associateManageQuote.css" />

		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> <!--Include Jquery--->
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	</head>

	<body>
	<div class="container-fluid">

		<h1>Quote #<?php echo $_POST["quoteID"]?> - Details </h1>
		<table class="mx-auto w-50">
			<!--Header row-->
			<tr>
				<th>Line Item Description</th>
				<th>Price</th>
			</tr>

			<?php
			try{
				include("credentials.php");
				//Connect to the database
				$dsn = "mysql:host=courses;dbname=z1866716";

				$pdo = new PDO($dsn,$username,$password);
	
				$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

				echo "Successfully connected to database... fetching quote line items<br>";

				//Get all the quotes in the database.
				$query = $pdo->prepare("SELECT * FROM Quote_Descript WHERE Quote_Id=:selectedQuoteID"); 

				$query->execute(array(":selectedQuoteID" => $_POST["quoteID"]));
		
				$quoteLineItems = $query->fetchAll(PDO::FETCH_ASSOC);

				echo '<form action="http://students.cs.niu.edu/~z1866716/manageQuotesDetail.php" method="POST">';
				echo '<input type="text" name="snotes#'.$_POST["quoteID"].'#" value="Pre-populate this with secret quote notes."/>';

				foreach($quoteLineItems as $lineItem)
				{
					$descriptionTextField = '<input type="text" class="w-100" name="description#'.$lineItem["Descrip_Id"].'#" value="'.$lineItem["Descript"].'"/>';
					$priceTextField = '<input type="number" class="w-100" step="0.01"name="price#'.$lineItem["Descrip_Id"].'#" value="'.$lineItem["Price"].'"/>';

					//Print the table row with the line item description and price.
					echo '<tr><td>'.$descriptionTextField.'</td><td>'.$priceTextField.'</td></tr>';
				}

			}
			catch(PDOexception $e){
				echo "Failed to connect to database:" . $e->getMessage(); //Print the error message if we fail to connect.
			}
			?>
		</table>

		<!--The button that will submit the form to save the current line edits to the database.-->
		<input type="submit" value="Save Changes to Quote"/>

		</form>
	</div>
	</body>

	

</html>