
<?php 
require_once './connect.php';
session_start();

if(isset($_POST["users"])){
    $sql = "SELECT e.fname, l.titre, e.ville FROM etudiant AS e
    INNER JOIN emprunt AS em ON em.loginId = e.loginId
    INNER JOIN livre AS l ON em.codel = l.livreId";

    $stm= $conn->query($sql);
    $displayedData = $stm->fetchAll(PDO::FETCH_ASSOC);
    var_dump($displayedData);
    $_SESSION['data'] = $displayedData;
    header('location:showByUsers.php');
}

if(isset($_POST["cities"])){
  $sql = "SELECT ville, count(*) AS number from etudiant as e 
  join emprunt as em on em.loginId = e.loginId
  group by ville";

  $stm= $conn->query($sql);
  $displayedData = $stm->fetchAll(PDO::FETCH_ASSOC);
  var_dump($displayedData);
  $_SESSION['data'] = $displayedData;
  header('location:showHowManyCities.php');
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <title>Document</title>
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
<br><br>
    <form action="./clientbooks.php" method="POST" >
    <p><button class="btn btn-outline-primary" name="cities">Display by Cities</button></p>
    <p><button class="btn btn-outline-primary" name="users">Display by each User</button></p>
    </form>

    
  
</body>
</html>