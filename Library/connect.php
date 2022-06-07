<?php

try {
    $conn = new PDO('mysql:host=localhost;dbname=Library', 'root', '');
} catch (PDOException  $e) {
    echo $e->getMessage();
}


?>