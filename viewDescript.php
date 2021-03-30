<?php
    require_once("session.php");
    require_once("secrets.php");
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>VIEWS</title>

<link rel="stylesheet" href="views.css">

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">E-Commerce Website</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item ">
            <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="views.php">View Quotes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="manage.php">Manage Associate Records</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
        </li>
        </ul>
    </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <h1>VIEWS QUOTES</h1>

    <br>
    </body>
    <?php $getCustId = "select Name, SNote, Status, cast(Date as date) as DateMade from Quote, Associate
    where Quote.Quote_Id = ".$_POST['QId']." and Associate.User_Id = Quote.User_Id;";
    $result = $pdo->query($getCustId);
    if ($result == false){echo "Failed to access Plant Repair database";}
    $quoteInfo = $result->fetch();?>
  <table>
    <tr align: left;>
      <th>Customer</th>
      <th>Customer Contact</th>
      <th>Associate</th>
      <th>Quote Id</th>
      <th>Date Created</th>
      <th>Status</th>
      <th>Secret Notes</th>
    </tr>
    <tr>
      <td><?php echo $_POST['custName'];?></td>
      <td><?php echo $_POST['custCont'];?></td>
      <td><?php echo $quoteInfo['Name'];?></td>
      <td><?php echo $_POST['QId'];?></td>
      <td><?php echo $quoteInfo['DateMade'];?></td>
      <td><?php echo $quoteInfo['Status'];?></td>
      <td><?php echo $quoteInfo['SNote'];?></td>
    </tr>
    <tr>
      <th>Line Number</th>
      <th colspan="2">Price</th>
      <th colspan="4">Description</th>
    </tr>
    <?php $getQuoteDes = "select Descrip_Id, Price, Descript from Quote_Descript where Quote_Id = ".$_POST['QId'].";";
    $result = $pdo->query($getQuoteDes);
    if ($result == false){echo "Failed to access Plant Repair database";}?>
    <?php while($quoteDes = $result->fetch()):?>
      <tr>
        <td><?php echo $quoteDes['Descrip_Id'];?></td>
        <td colspan="2"><?php echo $quoteDes['Price'];?></td>
        <td colspan="4"><?php echo $quoteDes['Descript'];?></td>
      </tr>
    <?php endwhile;?>
  </table>
<form action="views.php">
  <input type="submit" value="Back"/>
</form>
