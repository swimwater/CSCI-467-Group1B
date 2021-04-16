<?php
    require_once("session.php");
    require_once("secrets.php");
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>MANAGE</title>

<link rel="stylesheet" href="edit.css">
</head>
<body>
  <!--nav bar-->
<?php require "navbar.php"?>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <h1>UPDATE ASSOCAITE RECORDS</h1>
  <br>
    <?php
      if (isset($_POST['Edit']))
      {
        $getAssociateInfo = "select Name, Password, Accu_Com, Address, Pos from Associate where User_Id = ".$_POST['Associate'].";";
        $result = $pdo->query($getAssociateInfo);
        if ($result == false){echo "Failed to access Associate database";}
        $info = $result->fetch();

        $name = $info['Name'];
        $pass = $info['Password'];
        $com = $info['Accu_Com'];
        $add = $info['Address'];
        $pos =$info['Pos'];
      }
      else
      {
        $name = "";
        $pass = "";
        $com = "";
        $add = "";
        $pos = "";
      }
    ?>
    <div class = 'editAssociate'>
      <form action="processChange.php" method = "POST">
        <table>
          <tr align:left;>
            <th>Name:</th>
            <td>
                <input type="text" name="Name" placeholder="Maximum of 50 characters" size="100" maxlength="50" value=<?php echo "\"".$name."\"";?> required/>
            </td>
          </tr>
          <tr>
            <th>Password:</th>
            <td>
              <input type="text" name="Password" placeholder="Maximum of 50 characters" size="100" maxlength="50" value=<?php echo "\"".$pass."\"";?> required/>
            </td>
          </tr>
          <tr>
            <th>Accumulated Commission:</th>
            <td>
              <input type="number" name="Accu_Com" placeholder="0.00" min="0" max="9999999999999.99" value=<?php echo "\"".$com."\"";?> required step="0.01" title="Currency" pattern="^\d+(?:\.\d{1,2})?$"/>
            </td>
          </tr>
          <tr>
            <th>Address:</th>
            <td>
              <input type="text" name="Address" placeholder="Maximum of 100 characters" size="100" maxlength="100" value=<?php echo "\"".$add."\"";?> required/>
            </td>
          </tr>
          <tr>
            <th>Position:</th>
            <td>
              <input type="radio" id="Ad" name="Pos" value='1' <?php if ($pos == 2) {echo "checked";}?>/>
              <label for="Ad">Administrator</label><br>
              <input type="radio" id="Em" name="Pos" value='1' <?php if ($pos == 1) {echo "checked";}?>/>
              <label for="Em">Employee</label><br>
              <input type="radio" id="As" name="Pos" value='0' <?php if ($pos == 0) {echo "checked";} else if ($pos == "") {echo "checked";}?>/>
              <label for="As">Associate</label><br>
            </td>
          </tr>
          <tr>
            <th>Save Changes:</th>
            <td>
              <?php if(isset($_POST['Edit'])){echo "<input type=\"hidden\" name=\"Edit\" value=\"Edit\"/>";}?>
              <?php if(isset($_POST['Edit'])){echo "<input type=\"hidden\" name=\"User_Id\" value=\"".$_POST['Associate']."\"/>";}?>
              <?php if(isset($_POST['Add'])){echo "<input type=\"hidden\" name=\"Add\" value=\"Add\"/>";}?>
              <input type="submit" class="mybutton" value="Update Database"/>
            </td>
          </tr>
        </table>
      </form>
    </div>
</body>
</html>
