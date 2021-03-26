<?php
    require_once("session.php");
    require_once("secrets.php");

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<title>MANAGE</title>

<link rel="stylesheet" href="manage.css">

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
        <li class="nav-item">
            <a class="nav-link" href="views.php">View Quotes</a>
        </li>
        <li class="nav-item active">
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
    <h1>MANAGE ASSOCIATE RECORDS</h1>

    <br>
</body>

<?php
  $getAssociateInfo = "select * from Associate;";
  $result = $pdo->query($getAssociateInfo);
  if ($result == false){echo "Failed to access Associate database";}
?>


<div class = "associateList">
  <table>
    <tr align: left;>
      <th>Username</th>
      <th>Name</th>
      <th>Password</th>
      <th>Accumulated Commission</th>
      <th>Address</th>
      <th>Position</th>
      <th>Manage Associate Info</th>
    </tr>
  <?php while ($info = $result->fetch()):?>
    <tr>
      <td><?php echo $info['User_Id'];?></td>
      <td><?php echo $info['Name'];?></td>
      <td><?php echo $info['Password'];?></td>
      <td><?php echo $info['Accu_Com'];?></td>
      <td><?php echo $info['Address'];?></td>
      <td><?php if ($info['Admin'] == 1) {echo "Administrator";} else {echo "Associate";}?></td>
      <td>
        <form id="edit" action=edit.php method="POST">
            <input type="hidden" name="Associate" value = <?php echo "\"".$info['User_Id']."\"";?>/>
            <input type="hidden" name="Edit" value = "Edit"/>
            <input type="submit" value="Edit"/>
        </form>
        <form id="delete" action=processChange.php method="POST">
            <input type="hidden" name="User_Id" value = <?php echo "\"".$info['User_Id']."\"";?>/>
            <input type="hidden" name="Delete" value = "Delete"/>
            <input type="submit" value="Delete" onClick='return confirmSubmit()'/>
        </form>
      </td>
    </tr>
  <?php endwhile;?>
  <tr>
    <th>Add New Associate:</th>
    <td colspan = "6" align = "right">
      <form id="add" action=edit.php method="POST">
          <input type="hidden" name="Add" value = "Add"/>
          <input type="submit" value="Add" id = "button"/>
      </form>
    </td>
  </tr>
  </table>
</div>

</html>

<script LANGUAGE="JavaScript">
function confirmSubmit()
{
var agree=confirm("Are you sure you want to continue? This action is irreverable");
if (agree)
 return true ;
else
 return false ;
}
</script>
