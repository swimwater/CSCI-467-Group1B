<!DOCTYPE html>
<html>
<?php
  require_once("secrets.php");
  require("session.php");
  $poSiTion = "select Pos from Associate where User_Id = ".$_SESSION["user_id"].";";
  $rEsUlT = $pdo->query($poSiTion);
  $pOs = $rEsUlT->fetch());
  if (isset($pOs['Pos'] == 1)) {header("Location: manageFinalQuotesHeader.php");}
 ?>
        <head>
          <!--include bootstrap CSS via CDN and custom stylesheet --->
      		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
      		<!--include jquery and bootstrap javascript via CDN --->
      		<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
      		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

          <title>Quote Record Form</title>

          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <meta charset="utf-8">

          <!-- CSS only -->
          <link rel="stylesheet" href="record.css">
        </head>

        <body id="body">
          <!--nav bar-->
        <?php require "navbar.php"

        ?>
        <div id="cards" class="cards">
            <div id="card" class="card">
            <a href="customer.php" class="cardLink">
            <div id="content" class="cardContent">
              <h3>Customers</h3>
            </div>
              <img class="cardImage" id="cardImage" src="https://ciklopea.com/wp-content/uploads/2018/05/Customer-Experience-800x600.png">
              <div id="content" class="cardInfo">
              <div>
                <p>View Current Customers</p>
              </div>
              </div>
            </a>
            </div>
            <div id="card" class="card">
            <a href="quote-form.php" class="cardLink">
            <div id="content" class="cardContent">
              <h3>Quote Form 1</h3>
            </div>
              <img class="cardImage" id="cardImage" src="https://y26uq11r8xr1zyp0d3inciqv-wpengine.netdna-ssl.com/wp-content/uploads/2019/10/53-1.jpg">
              <div id="content" class="cardInfo">
              <div>
                <p>Add Quote</p>
              </div>
              </div>
            </a>
            </div>
            <div id="card" class="card">
              <a href="manageUnfinalQuotesHeader.php" class="cardLink">
              <div id="content" class="cardContent">
                <h3>Quote Form 2</h3>
              </div>
                <img class="cardImage" id="cardImage" src="https://www.salesforce.com/content/dam/blogs/ca/Blog%20Posts/customer-experience-open%20graph.jpg">
                <div id="content" class="cardInfo">
                <div>
                  <p>Edit Quote</p>
                </div>
              </div>
            </a>
            </div>
          </div>
        </body>

        <footer id="footer">
          <p>Created by Group 1B for NIU CSCI467 Group Project &copy; 4/28/2021</p>
        </footer>
</html>
