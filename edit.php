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
            <a class="nav-link" href="views.php">View Associate Records</a>
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
    <h1>UPDATE ASSOCAITE RECORDS</h1>

    <br>
    <?php
      if (isset($_POST['Edit']))
      {
        $getAssociateInfo = "select Name, Password, Accu_Com, Address, Admin from Associate where User_Id = ".$_POST['Associate'].";";
        $result = $pdo->query($getAssociateInfo);
        if ($result == false){echo "Failed to access Associate database";}
        $info = $result->fetch();

        $name = $info['Name'];
        $pass = $info['Password'];
        $com = $info['Accu_Com'];
        $add = $info['Address'];
        $adm =$info['Admin'];
      }
      else
      {
        $name = "";
        $pass = "";
        $com = "";
        $add = "";
        $adm = "";
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
              <input type="radio" id="Ad" name="Admin" value='1' <?php if ($adm == 1) {echo "checked";}?>/>
              <label for="Ad">Administrator</label><br>
              <input type="radio" id="As" name="Admin" value='0' <?php if ($adm == 0) {echo "checked";} else if ($adm == "") {echo "checked";}?>/>
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
