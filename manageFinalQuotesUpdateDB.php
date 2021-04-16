
<?php
    require("session.php");
    require("secrets.php");
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
        <?php
        
            try {
                
                require "navbar.php";

                $quoteID = $_POST["quoteID"];

                for($i = 1; $i <= $_POST["numLineItems"]; $i++)
                {
                    $description = $_POST["description".$i];
                    $price = $_POST["price".$i];
                    
                    if($_POST["deleted".$i] == "true" && $_POST["lineItemID".$i] != "#")
                    {
                        // the item is in the database and should be deleted. delete it:
                        $query = $pdo->prepare("DELETE FROM Quote_Descript WHERE Descrip_Id = :descrID"); 

                        $query->execute(array(":descrID" => $_POST["lineItemID".$i]));
                    }
                    else if($_POST["lineItemID".$i] == "#" && $_POST["deleted".$i] == "false")
                    {
                        // the item is not in the database and should be added. add it as a new item:
                        $query = $pdo->prepare("INSERT INTO Quote_Descript (Quote_Id, Price, Descript) VALUES (:quoteId, :price, :descr)"); 

                        $query->execute(array(":quoteId" => $quoteID, ":price" => $price, ":descr" => $description));
                    }
                    else if($_POST["lineItemID".$i] != "#" && $_POST["deleted".$i] == "false")
                    {
                        // the item already exists in the database and should be updated. update it based on its descriptor id:
                        $query = $pdo->prepare("UPDATE Quote_Descript SET Price = :price, Descript = :descr WHERE Descrip_Id = :descrID"); 

                        $query->execute(array(":price" => $price, ":descr" => $description, ":descrID" => $_POST["lineItemID".$i]));
                    }
                }
                
                $discountAmt = $_POST["discountAmount"];

                $percent = 0;
                if($_POST["discountTypeDropdown"] == "Percentage")
                {
                    $percent = 1;
                }

                $sNote = $_POST["snotes"];

                // update quote notes after line item changes:
                // if the user checked the sanction quote checkbox, we set the quote to sanctioned in the database.
                if(isset($_POST['sanctionCheckbox']))
                {
                    
                    // set this quote we are modifying to sanctioned:
                    $query = $pdo->prepare("UPDATE Quote SET SNote = :sNote, Discount = :discount, Percent = :percent, Status = 'Sanctioned' WHERE Quote_Id = :quoteID");

                    $query->execute(array(":sNote" => $sNote, ":discount" => $discountAmt, ":percent" => $percent, ":quoteID" => $quoteID));

                }
                else // if the quote is not to be sanctioned, simply update its notes and discount information
                {
                    $query = $pdo->prepare("UPDATE Quote SET SNote = :sNote, Discount = :discount, Percent = :percent WHERE Quote_Id = :quoteID"); 

                    $query->execute(array(":sNote" => $sNote, ":discount" => $discountAmt, ":percent" => $percent,  ":quoteID" => $quoteID));
                }
                
                echo '<div class="container-fluid">';
                echo '<h1 class="pt-2">Confirmation</h1>';
                echo 'Quote Successfully Updated.<br>';
                echo '<a class="btn btn-success mt-3" href="http://students.cs.niu.edu/~z1866716/manageFinalQuotesHeader.php" role="button">Back to Finalized Quotes.</a>';
                echo '</div>';
            }
            catch(PDOexception $e){
				// print the error message if we encounter an exception
				echo "Error updating quote in database: " . $e->getMessage(); 
			}
            
        ?>

        

    </body>
</html>

<?php
if(isset($_POST['sanctionCheckbox']))
{
    echo '<script type="text/javascript">';
    echo 'alert("The quote has been sanctioned: an email has been sent to the customer containing the quote information.")';
    echo '</script>';
}
?>