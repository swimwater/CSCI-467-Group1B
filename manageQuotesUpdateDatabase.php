<html>

<head>
    
</head>

<body>
    <h1>Confirmation</h1>

    <?php

        include("credentials.php");
        // connect to the database
        $dsn = "mysql:host=courses;dbname=z1866716";

        $pdo = new PDO($dsn,$username,$password);

        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        
        print_r($_POST);

        for($i = 1; $i <= $_POST["numLineItems"]; $i++)
        {
            echo '<p>LINE ITEM #'.$i.' ID = '.$_POST["lineItemID".$i].'</p>';
            
            $quoteID = $_POST["quoteID"];
            $description = $_POST["description".$i];
            $price = $_POST["price".$i];

            if($_POST["lineItemID".$i] == "#")
            {
                echo '<p>ELEMENT WAS ADDED IN MANAGE VIEW. WE WILL ADD THIS TO THE DATABASE.</p>';
                echo '<p>Its description is'.$description.'<p>';
                echo '<p>Its price is'.$price.'<p>';

                // the item is not in the database. add it as a new item:
				$query = $pdo->prepare("INSERT INTO Quote_Descript (Quote_Id, Price, Descript) VALUES (:quoteId, :price, :descr)"); 

				$query->execute(array(":quoteId" => $quoteID, ":price" => $price, ":descr" => $description));
            }
            else
            {
                $descrID = $_POST["lineItemID".$i]; // pull the descriptor id for use in query

                echo '<p>ELEMENT WAS PREEXISTING, WE WILL UPDATE THIS IN THE DATABASE.</p>';
                echo '<p>Its description is'.$description.'<p>';
                echo '<p>Its price is'.$price.'<p>';

                // the item already exists in the database. update it based on its descriptor id:
				$query = $pdo->prepare("UPDATE Quote_Descript SET Price = :price, Descript = :descr WHERE Descrip_Id = :descrID"); 

				$query->execute(array(":price" => $price, ":descr" => $description, ":descrID" => $descrID));
            }
        }

        $deletedRows = explode(',', $_POST["deletedRows"]);
        print_r($deletedRows);

        for ($j = 0; $j < count($deletedRows) - 1; $j++)
        {
            echo 'DELETING ROW '.$deletedRows[$j].'<br>';

            // delete the row
            $query = $pdo->prepare("DELETE FROM Quote_Descript WHERE Descrip_Id = :descrID"); 

            $query->execute(array(":descrID" => $deletedRows[$j]));
        }
        
        $sNote = $_POST["snotes"];

        // update quote notes after line item changes:
        $query = $pdo->prepare("UPDATE Quote SET SNote = :sNote WHERE Quote_Id = :quoteID"); 

        $query->execute(array(":sNote" => $sNote, ":quoteID" => $quoteID));

    ?>

</body>

</html>