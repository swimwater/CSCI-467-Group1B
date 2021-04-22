<?php
    require_once("session.php");
    require_once("secrets.php");
?>

<!doctype html>

<html lang="en">
<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!--- Custom CSS Style -->
  <link rel="stylesheet" href="quote-form.css">

  <title>Quote Form</title>
</head>
<body>
  <!--nav bar-->
  <?php require "navbar.php"
  
  ?>
  
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <div class="display">
      <h1>ADD QUOTE</h1>
    </div>
</body>
    <?php
        $custId = "";
        $sNote = "";
    ?>
    <div class="display">
      <div class = 'addQuote'>
        <form action="addQuote.php" method = "POST">
          <table>
            <tr align:left;>
              <th>Customer Id:</th>
              <td>
                  <input type="number" class="w-100" min="0" max="161" name="Cust Id" placeholder="Enter Id Number" size="100" value=<?php echo "\"".$custId."\"";?> required/>
              </td>
            </tr>
            <tr>
              <th>Secret Notes:</th>
              <td>
                <input type="text" name="Notes" placeholder="Enter Notes" size="100" maxlength="1000" value=<?php echo "\"".$sNote."\"";?>/>
              </td>
            </tr>
            <tr>
              <th>Save Changes:</th>
              <td>
                <input type="submit" class="mybutton" value="Update Database"/>
              </td>
            </tr>
          </table>
        </form>
      </div>
    </div>
 </html>
