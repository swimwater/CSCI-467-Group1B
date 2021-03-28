<!--- Manage unfinalized quotes--->

<html>
	<head> 
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="associateManageQuote.css" />

		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> <!--Include Jquery--->
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	</head>
	
	<body> 
	
	<div class="container-fluid">
		
		<h1>Manage Unfinalized Quotes</h1>

		<table class="mx-auto w-50">
			<!--Header row-->
			<tr>
				<th>Quote</th>
				<th>Customer Email</th>
				<th>Notes</th>
			</tr>

			<!--- connect to db and get quotes, put them into a table-->
			<?php

				try{
					include("credentials.php");
					//Connect to the database
					$dsn = "mysql:host=courses;dbname=z1866716";

					$pdo = new PDO($dsn,$username,$password);
	
					$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

					echo "Successfully connected to database... fetching quote data<br>";

					//Get all the quotes in the database.
					$query = $pdo->prepare("SELECT * FROM Quote"); 

					$query->execute();
		
					$unfinalizedQuotes = $query->fetchAll(PDO::FETCH_ASSOC);

					foreach($unfinalizedQuotes as $quote)
					{
						echo '<form action="http://students.cs.niu.edu/~z1866716/manageQuotesDetail.php" method="POST">';

						//Hidden field containing quote ID. This will be posted to the detail page, allowing us to find the quote's line items.
						echo '<input type="hidden" name="quoteID" value="'.$quote["Quote_Id"].'">';

						//The button that will submit the form to the page where the user will edit the quote in detail.
						$editButton = '<td><input type="submit" class="w-100" value="Edit Quote #'.$quote["Quote_Id"].'"/></td>';

						//Print the table row with the quote button and information:
						echo '<tr>'.$editButton.'<td>'.$quote["Cust_Mail"].'</td><td>'.$quote["SNote"].'</td></tr>';

						echo "</form>";
					}

				}
				catch(PDOexception $e){
					echo "Failed to connect to database:" . $e->getMessage(); //Print the error message if we fail to connect.
				}	

			?>

		</table>
	</div>
		
	</body>
</html>
