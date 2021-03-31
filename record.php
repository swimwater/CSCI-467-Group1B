<?php
    require_once("session.php");
    require_once("secrets.php");

?>

<!DOCTYPE html>
<html>
        <head>
          <title>Quote Record Form</title>
          <link rel="stylesheet" href="record.css">
        </head>
        <body>
          <!--nav bar-->
        <?php require "navbar-record.php"

        ?>
        <div id="content">
            <div class="tile">
              <h3>Customers</h3>
              <a href="customer.php">
                <section>
                  <div class=banner style="background-image: url('https://ciklopea.com/wp-content/uploads/2018/05/Customer-Experience-800x600.png');"></div>
                </section>
              </a>
              <a href="customer.php"><p>View Current Customers</p></a>
            </div>
            <div class="tile">
              <h3>Quote Form</h3>
              <a href="quote-form.php">
                <section>
                  <div class=banner style="background-image: url('https://y26uq11r8xr1zyp0d3inciqv-wpengine.netdna-ssl.com/wp-content/uploads/2019/10/53-1.jpg');"></div>
                </section>
              </a>
              <a href="quote-form.php"><p>View Quote Form</p></a>
            </div>
          </div>
        </body>
</html>
