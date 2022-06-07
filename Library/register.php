<?php 

require_once './connect.php';
$errors = [];
if($_SERVER['REQUEST_METHOD'] == 'POST'){

$firstName = filter_var($_REQUEST['fname'], FILTER_SANITIZE_SPECIAL_CHARS);
$lastName = filter_var( $_REQUEST['lname'], FILTER_SANITIZE_SPECIAL_CHARS);
$city = filter_var( $_REQUEST['ville'], FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL);
$password = filter_var($_REQUEST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
$birth = $_REQUEST['birth'];

if (!$firstName || !$lastName || !$city || !$email || !$password || !$birth ){
    $errors[] = "All fields are required";
}

if (!$email){
    $errors[] ="Email is not Valid";
}

if(strlen($password) < 8 ){
    $errors[] = "Password should contains at least 8 caracters";
}



// insert data into DB 
if(count($errors)==0){
$sql = "INSERT INTO ETUDIANT (fname,lname,ville,dateNaiss,password, email) VALUES (:fname,:lname,:ville,:dateNaiss,:password,:email)";
$stm = $conn->prepare($sql);
$stm->execute([
    ':fname' => $firstName, 
    'lname' => $lastName,
    ':ville' => $city,
     ':dateNaiss' => $birth,
     ':password' => $password,
     ':email' => $email
    ]);
// redirect to the login page 
header("location:login.php");
  
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
    <title>Library Management - Register</title>
</head>
<body>
    <h1>The Reader's Planet</h1>

       
    <main> 
    <?php foreach($errors as $err ) { ?>
            <p class="alert alert-danger"><?php echo $err; ?></p>    
        <?php } ?>

        <div class="form-section">
        <form method="POST" action="./register.php">
        <div class="mb-3">
    <label for="fname" class="form-label">First Name</label>
    <input type="fname" class="form-control" id="fname" name="fname">
    
  </div> 
  <div class="mb-3">
    <label for="lname" class="form-label">Last Name</label>
    <input type="lname" class="form-control" id="lname" name="lname">
  
  </div> 

 <div class="mb-3">
     <label for="ville">Choose your City </label><br><br>
     <select name="ville" id="ville">
         <option value="El-Jadida" name="ville">El-Jadida</option>
         <option value="Casablanca" name="ville">Casablanca</option>
         <option value="Asfi" name="ville">Asfi</option>
         <option value="Marrakech" name="ville">Marrakech</option>
     </select>
 </div>

 <div class="mb-3">
     <label for="birth">Birth Date  </label><br><br>
     <input type="date" name="birth" id="birth">
 </div>
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
  <div  class="form-text"><a href="./login.php">Log in </a></div>
  </div>
</form>
        </div>
 
  

    </main>
  
</body>
</html>