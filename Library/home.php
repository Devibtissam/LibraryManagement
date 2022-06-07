<?php
 session_start();




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">

    <title>Home </title>
    <style>
        main{
            padding: 150px;
            max-width: 50%;
            margin: 0 auto;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">The Reader's Planet</a>
    <button class="navbar-toggler" type="button" >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./userbook.php">My Books</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./librarybooks.php">Search Book</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./clientbooks.php">Loan Details</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./deconnect.php">Deconnexion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<main>
<h1>Welcome <?php echo ucwords($_SESSION['user']); ?></h1>

</main>
  
</body>
</html>