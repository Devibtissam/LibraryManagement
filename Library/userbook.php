<?php

require_once './connect.php';
session_start();

$loginId = $_SESSION['userId'];


$sql = "SELECT * FROM livre";
$stm = $conn->query($sql);
$data = $stm->fetchAll(PDO::FETCH_ASSOC);


// delete a book 
$bookId = $_GET['id'] ?? null;
echo $bookId;
$sql = "DELETE FROM emprunt where codel = :codel";
$stm = $conn->prepare($sql);
$stm->execute(
  [":codel" => $bookId ]
);


    //display all the loant books from the start
    $sql = "SELECT e.dateEmpr, e.dateRetour, l.titre, l.Auteur, l.livreId FROM emprunt AS e
    INNER JOIN livre AS l ON e.codel=l.livreId WHERE e.loginId = $loginId";
    $stm = $conn->query($sql);
    $selectedBooks = $stm->fetchAll(PDO::FETCH_ASSOC);
if(isset($_POST["submitbtn"])){
    $codeLivre = $_POST["getbook"];
    $dateRetour = $_POST["datedeRetour"];
   

    $sql = "INSERT INTO emprunt (loginId, codel, dateRetour) VALUES ( :loginId, :codel, :dateRetour)";
    $stm = $conn->prepare($sql);
    $stm->execute([
        ":loginId" => $loginId,
        ":codel" => $codeLivre,
        ":dateRetour" => $dateRetour
    ]);




// display each time we add a new book to the liste
$sql = "SELECT e.dateEmpr, e.dateRetour, l.titre, l.Auteur, l.livreId FROM emprunt AS e
INNER JOIN livre AS l ON e.codel=l.livreId  WHERE e.loginId = $loginId";
$stm = $conn->query($sql);
$selectedBooks = $stm->fetchAll(PDO::FETCH_ASSOC);

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
    <h1>My Book Lists</h1>
<form action="./userbook.php" method="POST">
<select name="getbook" id="getbook">
    <?php foreach($data as $d) { ?>
    <option value='<?php echo $d["livreId"]?>'><?php echo $d["titre"]?></option>
    <?php };?>
</select><br><br>
<label for="dateRetour">Choisir un Date de Retour </label><br><br>
<input type="date" name="datedeRetour"><br><br>
<input type="submit" class="btn btn-primary btn" value="Get a new Book" name="submitbtn"> <br><br>
</form>
   

    <table class="table">
  <thead>
  <tr>
      <th scope="col">Num ° </th>
      <th scope="col">Title</th>
      <th scope="col">Auteur</th>
      <th scope="col">Date d'emprunte</th>
      <th scope="col">Date Retour</th>
      <th scope="col"></th>

    </tr>
  </thead>
  <tbody>
    <?php foreach($selectedBooks as $i => $d) { ?>
      <tr>
        <td><?php echo $i + 1 ?></td>
        <td><?php echo $d["titre"]?></td>
        <td><?php echo $d["Auteur"]?></td>
        <td><?php echo $d["dateEmpr"]?></td>
        <td><?php echo $d["dateRetour"]?></td>
        <td><a href="userbook.php?id=<?php echo $d["livreId"]?>" type="button" class="btn btn-outline-primary">Delete</a>
        </td>
        
      </tr>
      
       <?php } ?>
       
    
  </tbody>
</table>
</body>
</html>