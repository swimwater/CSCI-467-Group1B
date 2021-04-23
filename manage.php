<?php
    require_once("session.php");
    require_once("secrets.php");

?>
<?php
  $poSiTion = "select Pos from Associate where User_Id = ".$_SESSION["user_id"].";";
  $rEsUlT = $pdo->query($poSiTion);
  $pOs = $rEsUlT->fetch());
  if (isset($pOs['Pos'] == 0)) {header("Location: record.php");}
  if (isset($pOs['Pos'] == 1)) {header("Location: manageFinalQuotesHeader.php");}
 ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>MANAGE</title>

<link rel="stylesheet" href="manage.css">

</head>
<body>
  <!--nav bar-->
  <?php require "navbar.php"?>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <div class="display">
      <h1>MANAGE ASSOCIATE RECORDS</h1>
    </div>

    <br>
</body>

<?php
  $getAssociateInfo = "select * from Associate;";
  $result = $pdo->query($getAssociateInfo);
  if ($result == false){echo "Failed to access Associate database";}
?>

<<div class="display">
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
        <td><?php if ($info['Pos'] == 2) {echo "Administrator";} else if ($info['Pos'] == 1) {echo "Employee";} else {echo "Associate";}?></td>
        <td>
          <form id="edit" action=edit.php method="POST">
              <input type="hidden" name="Associate" value = <?php echo "\"".$info['User_Id']."\"";?>/>
              <input type="hidden" name="Edit" value = "Edit"/>
              <input type="submit" class="mybutton" value="Edit"/>
          </form>
          <form id="delete" action=processChange.php method="POST">
              <input type="hidden" name="User_Id" value = <?php echo "\"".$info['User_Id']."\"";?>/>
              <input type="hidden" name="Delete" value = "Delete"/>
              <input type="submit" class="mybutton" id="DELETE" value="Delete" onClick='return confirmSubmit()'/>
          </form>
        </td>
      </tr>
    <?php endwhile;?>

        <form id="add" action=edit.php method="POST">
            <input type="hidden" name="Add" value = "Add"/>
            <input type="submit" class="mybutton" value="Add" id = "ADD-BUTTON"/>
        </form>
    </table>
  </div>
</div>

</html>

<script LANGUAGE="JavaScript">
function confirmSubmit()
{
var agree=confirm("Are you sure you want to continue? This action is irreverable     WARNING: The Associate Cannot be Deleted if they have quotes tied to their account. You must transfer all quotes to another Associate before they can be removed from the system");
if (agree)
 return true ;
else
 return false ;
}
</script>
