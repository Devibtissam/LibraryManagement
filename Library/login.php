<?php 

require_once './connect.php';
session_start();
$errors = [];
if($_SERVER['REQUEST_METHOD'] == 'POST'){
$email = filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL);
$password = filter_var($_REQUEST['password'], FILTER_SANITIZE_SPECIAL_CHARS);


if (!$password || !$email ){
    $errors[] = "All fields are required";
}

// verify data into DB 
if(count($errors)==0){
  $sql = "SELECT *  FROM Etudiant where email = '$email'";
  $stm = $conn->query($sql);
  $data = $stm->fetch(PDO::FETCH_ASSOC);
  
  if(!$data || $data["password"] != $password){
    $errors[] = "Email or Password not Correct !";
    // exit;
  } else{
    //  redirect to the login page 
  $_SESSION['user'] = $data['fname'];
  $_SESSION['userId'] = $data['loginId'];
  header("location:home.php");

  }
  }

  
 

}














?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link  rel="stylesheet" href="./style.css">
    <title>Library Management</title>
</head>
<body>
    <h1>The Reader's Planet</h1>
    <main>
    <?php foreach($errors as $err ) { ?>
            <p class="alert alert-danger"><?php echo $err; ?></p>    
        <?php } ?>

        <div class="form-section">
        <form method="POST" action="./login.php">
        <div class="mb-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" name="email">
    <div  class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <button type="submit" class="btn btn-primary" name="submit">Submit</button><br>
  <div  class="form-text">Create Account ?<a href="./register.php">Register Here</a></div>
  </div>
</form>
        </div>
 
  

    </main>
  
</body>
</html>