<?php
    require_once("session.php");
    require_once("secrets.php");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Dropdown Navigation Bar</title>
    <!--Dropdown Menu Styles-->
    <style>

        .dropdown-menu a:hover {
            background: linear-gradient(to right, #abbaab, #ffffff);
        }

        .nav-item:hover .dropdown-menu {
            display: block;
        }
    </style>
  </head>

  <body>
    <?php if($_SESSION['pos'] == 0):?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Welcome Associate <?php echo $_SESSION["user_id"];?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="record.php">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="customer.php">Customer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="quote-form.php">Add Quote</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manageUnfinalQuotesHeader.php">View Unfinalized Quotes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php endif;?>
    <?php if($_SESSION['pos'] == 1):?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Welcome <?php echo $_SESSION["user_id"];?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="manageFinalQuotesHeader.php">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="manageFinalQuotesHeader.php">View Finalized Quotes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="viewSanctionQuotes.php">View Sanctioned Quotes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php endif;?>
    <?php if($_SESSION['pos'] == 2):?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Welcome Admin <?php echo $_SESSION["user_id"];?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="views.php">View Quotes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manage.php">Manage Associate Records</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="transferQuote.php">Transfer Quotes</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">Associate Portal</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="record.php">Home</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="customer.php">Customer</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="quote-form.php">Add Quote</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="manageUnfinalQuotesHeader.php">View Unfinalized Quotes</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">HQ Portal</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="viewSanctionQuotes.php">Home</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="manageFinalQuotesHeader.php">View Finalized Quotes</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="viewSanctionQuotes.php">View Sanctioned Quotes</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
        </nav>
    <?php endif;?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
