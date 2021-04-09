<?php

  require("session.php");
 

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>HOME PAGE</title>
<link rel="stylesheet" href="home.css">

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">E-Commerce Website</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
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
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
        </li>
        </ul>
    </div>
    </nav>

      
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <h1>Welcome</h1>
    <h2>Our Founder</h2>

    <br>

    <img src="data:image/jpeg;base64,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" alt="Our Founder"> 
    
    <p>Here at Ege Incorporated we pride ourselves on premier customer service.</p></br>
    <p>We believe the customer comes first and that they are the foundation for our success.</p></br>
    <p>Customers have been, and will continue to be, our number one priority.</p></br>
</body>


</html>