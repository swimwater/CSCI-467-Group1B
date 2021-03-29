<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Navbar</title>

  <style type="text/css">
    *{
      color: white;
      padding: 0;
      margin: 0;
      font-family: sans-serif;
    }
    .navbar-record {
      width: 100%;
      background: #2b3c4e;
    }

    .navbar-record ul{
      list-style-type: none;
      text-align: right;
    }

    .navbar-record li {
      display: inline-block;
      font-size: 20px;
      transition: .5s;
      padding: 30px;
    }
  </style>
</head>
<body>
  <div class="navbar-record">
    <ul>
      <li><a href="customers.php">Customers</a></li>
      <li><a href="quote.php">Quote Form</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>
</body>
</html>