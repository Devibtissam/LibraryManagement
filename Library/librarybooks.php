<?php
require_once './connect.php';
$errors = [];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $search = $_REQUEST['search'];

    $sql = "SELECT * FROM livre WHERE titre Like '$search' OR Auteur Like '$search'";
    $stm = $conn->query($sql);
    $data = $stm->fetchAll(PDO::FETCH_ASSOC);
    if(!$data){
        $errors[]= "Item Not Found";
    } 
    // var_dump($data);
} else{
    $sql = "SELECT * FROM livre";
    $stm = $conn->query($sql);
    $data = $stm->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($data);

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

   
<h1>Our Books</h1>
    <a class="form-text" href="./home.php">Back Home</a><br><br>

    <nav class="navbar bg-light">
  <div class="container-fluid">
    <form class="d-flex" method="POST" action="./librarybooks.php">
      <input class="form-control me-2" type="search" placeholder="Search" name="search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  </div>
</nav>

   <?php foreach($errors as $er) { ?>
    <p class="alert alert-primary"><?php echo $er."<br>"; ?></p>
    <?php } ?>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">Num ° </th>
      <th scope="col">Title</th>
      <th scope="col">Auteur</th>
      <th scope="col">N Exemplaire</th>
    </tr>
  </thead>
  <tbody>
           <?php foreach($data as  $d ){ ?>
            <tr>
            <th><?php echo $d["livreId"] ?></th>
            <td><?php echo $d["titre"];?></td>
            <td><?php echo $d["Auteur"];?></td>
            <td><?php echo $d["nbrExemplaire"];?></td>
        </tr>
        <?php }?>
      
  
  </tbody> 
</table>
</body>
</html>