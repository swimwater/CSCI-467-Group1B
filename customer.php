<?php
    require_once("legacyDatabase.php");
    require_once("session.php");
    require_once("secrets.php");
    require_once("functions.php");
?>

<!doctype html>

<html lang="en">
<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!--- Custom CSS Style -->
  <link rel="stylesheet" href="customer.css">

  <title>Customer Form</title>
</head>
<body>
  <!--nav bar-->
  <?php require "navbar.php"?>
    <div class="display">
      <h1>Customer Information</h1>
    </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

<!--New area-->
<?php
  //people
  if(isset($_POST['sCust']))
  {$cust = "where name LIKE '%".$_POST['sCust']."%'"; $sCValue = $_POST['sCust'];} else {$cust = ""; $sCValue = "";}
 ?>
  <div class="display">
    <form action="customer.php" method="POST">
      <input type="text" id="CUST" name="sCust" placeholder="Search by Customer" value = <?php echo "\"".$sCValue."\""?>/><br>
      <input type="submit" class="CUSTOMSUBMIT " name="search" value="Search"/><br>
    </form>
  </div>

<?php
 $getCustId = "select id, name, city, street, contact from customers ".$cust.";";
 $result = $pdo2->query($getCustId);
 if ($result == false){echo "Failed to access Legacy database";}
 ?>
    <div class="display">
      <table>
        <tr align: left;>
          <th>Customer Id</th>
          <th>Customer</th>
          <th>Customer Contact</th>
          <th>City</th>
          <th>Street</th>
        </tr>
        <?php while ($custInfo = $result->fetch()):?>
          <tr>
              <td><?php echo $custInfo['id'];?></td>
              <td><?php echo $custInfo['name'];?></td>
              <td><?php echo $custInfo['contact'];?></td>
              <td><?php echo $custInfo['city'];?></td>
              <td><?php echo $custInfo['street'];?></td>
          </tr>
        <?php endwhile;?>
      </table>
    </div>
</html>
