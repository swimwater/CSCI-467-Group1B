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
        <?php

            try {
                include("credentials.php");
                // connect to the database
                $dsn = "mysql:host=courses;dbname=z1866716";

                $pdo = new PDO($dsn,$username,$password);

                $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                
                $quoteID = $_POST["quoteID"];
                
                print_r($_POST);
                echo '<br>';

                for($i = 1; $i <= $_POST["numLineItems"]; $i++)
                {
                    $description = $_POST["description".$i];
                    $price = $_POST["price".$i];
                    
                    if($_POST["deleted".$i] == "true" && $_POST["lineItemID".$i] != "#")
                    {
                        echo 'DELETING LINE ITEM '.$i.'<br>';
                        // the item is in the database and should be deleted. delete it:
                        $query = $pdo->prepare("DELETE FROM Quote_Descript WHERE Descrip_Id = :descrID"); 

                        $query->execute(array(":descrID" => $_POST["lineItemID".$i]));
                    }
                    else if($_POST["lineItemID".$i] == "#" && $_POST["deleted".$i] == "false")
                    {
                        echo 'ADDING LINE ITEM <br>';
                        // the item is not in the database and should be added. add it as a new item:
                        $query = $pdo->prepare("INSERT INTO Quote_Descript (Quote_Id, Price, Descript) VALUES (:quoteId, :price, :descr)"); 

                        $query->execute(array(":quoteId" => $quoteID, ":price" => $price, ":descr" => $description));
                    }
                    else if($_POST["lineItemID".$i] != "#" && $_POST["deleted".$i] == "false")
                    {
                        echo 'UPDATING LINE ITEM <br>';
                        // the item already exists in the database and should be updated. update it based on its descriptor id:
                        $query = $pdo->prepare("UPDATE Quote_Descript SET Price = :price, Descript = :descr WHERE Descrip_Id = :descrID"); 

                        $query->execute(array(":price" => $price, ":descr" => $description, ":descrID" => $_POST["lineItemID".$i]));
                    }
                }
                
                $sNote = $_POST["snotes"];

                // update quote notes after line item changes:
                // if the user checked the finalize quote checkbox, we set the quote to finalized in the database.
                if(isset($_POST['finalizeCheckbox']))
                {
                    // set this quote we are modifying to finalized:
                    $query = $pdo->prepare("UPDATE Quote SET SNote = :sNote, Status = 'Finalized' WHERE Quote_Id = :quoteID"); 

                    $query->execute(array(":sNote" => $sNote, ":quoteID" => $quoteID));

                }
                else // if the quote is not to be finalized, simply update its notes.
                {
                    $query = $pdo->prepare("UPDATE Quote SET SNote = :sNote WHERE Quote_Id = :quoteID"); 

                    $query->execute(array(":sNote" => $sNote, ":quoteID" => $quoteID));
                }
                
                echo '<div class="container-fluid">';
                echo '<h1 class="pt-2">Confirmation</h1>';
                echo 'Quote Successfully Updated.<br>';
                echo '<a class="btn btn-success mt-3" href="http://students.cs.niu.edu/~z1866716/manageQuotesHeader.php" role="button">Back to Unfinalized Quotes.</a>';
                echo '</div>';
            }
            catch(PDOexception $e){
				// print the error message if we encounter an exception
				echo "Error updating quote in database: " . $e->getMessage(); 
			}
            
        ?>

        

    </body>
</html>