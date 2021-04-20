<!--- manage unfinalized quotes --->

<?php
    require("session.php");
    require("secrets.php");
    require("legacyDatabase.php");
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
		

		<h1 class="pt-2">Unfinalized Quotes</h1>

		<!-- greet user -->
		<p>Hello, please choose an unfinalized quote to edit below.</p>


		<table class="table table-bordered table-dark">
			<!-- header row for unfinalized quotes table-->
			<tr>
				<th style="width: 15rem">Customer Name</th>
				<th style="width: 15rem">Customer Contact</th>
				<th style="width: 40rem">Notes</th>
				<th style="width: 8rem">Edit</th>
				<th style="width: 8rem">Delete</th>
			</tr>

			<!--- connect to db and get unfinalized quotes pertaining to this associate, put them into a table-->
			<?php

				try{
					$userId = $_SESSION['user_id'];

					// get all unfinalized quotes that have this user associated with them.
					$query = $pdo->prepare("SELECT * FROM Quote WHERE Status='Unfinalized' AND User_Id=:userID");

					$query->execute(array(":userID" => $userId));

					$unfinalizedQuotes = $query->fetchAll(PDO::FETCH_ASSOC);

					foreach($unfinalizedQuotes as $quote)
					{
						// get the customer information pertaining to this quote we're displaying
						$customerQuery = $pdo2->prepare("SELECT * FROM customers WHERE id=:customerId");

						$customerQuery->execute(array(":customerId" => $quote['Cust_Id']));

						$customerData = $customerQuery->fetchAll(PDO::FETCH_ASSOC)[0];

						echo '<form action="manageUnfinalQuotesDetail.php" method="POST">';

						// hidden field containing quote ID. This will be posted to the detail page, allowing us to find the quote's line items.
						echo '<input type="hidden" name="quoteID" value="'.$quote["Quote_Id"].'">';

						// hidden field containing secret quote notes. These notes will be posted to the following page where they are displayed for editing.
						echo '<input type="hidden" name="sNote" value="'.$quote["SNote"].'">';

						// the button that will submit the form to the page where the user will edit the quote in detail.
						$editButton = '<td><button type="submit" class="btn btn-success w-100">Edit</button></td>';

						$deleteButton = '<td><form id="delete" action=deleteQuoteUpdateDB.php method="POST">
											<input type="hidden" name="quoteId" value = "'.$quote["Quote_Id"].'"/>
											<input type="submit" class="btn btn-danger w-100" value="Delete"/>
										</form></td>';
						

						// print the table row with the quote button and information:
						echo '<tr><td>'.$customerData["name"].'</td><td>'.$customerData["contact"].'</td><td>'.$quote["SNote"].'</td>'.$editButton.'</form>'.$deleteButton.'</tr>';
					}

				}
				catch(PDOexception $e){
					echo "Error displaying quote header information: " . $e->getMessage();
				}

			?>

		</table>
	</div>

	</body>
</html>
