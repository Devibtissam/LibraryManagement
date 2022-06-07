<?php 

require_once './connect.php';
session_start();


$data = $_SESSION['data'];

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
    <table class="table">
    <tr>
            <th scope="col">City</th>
            <th scope="col">Number</th>
        </tr>
    <?php foreach($data as $d){ ?>
       <tr>
           <td><?php echo $d["ville"]?></td>
           <td><?php echo $d["number"]?></td>
       </tr>
        <?php } ?>
    </table>
</body>
</html>