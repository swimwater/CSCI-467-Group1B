<?php
    require("session.php");
    require("secrets.php");

    // delete the target quote line items from the database
    $query = $pdo->prepare("DELETE FROM Quote_Descript WHERE Quote_Id=:selectedQuoteID");
    $query->execute(array(":selectedQuoteID" => $_POST["quoteId"]));

    // delete the target quote from the database
    $query = $pdo->prepare("DELETE FROM Quote WHERE Quote_Id=:selectedQuoteID");
    $query->execute(array(":selectedQuoteID" => $_POST["quoteId"]));
    
    //redirect back to page
    header("Location: manageUnfinalQuotesHeader.php");
?>
