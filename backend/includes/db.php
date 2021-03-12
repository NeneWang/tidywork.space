<?php

$servername = "localhost";
$username = "root";
$password = "root";

// Create connection
$connection;
try {
    $connection = new PDO("mysql:host=$servername;dbname=tidywork", $username, $password);
    // set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }




$query = "SELECT * FROM `users`";
  $select_all_collections = mysqli_query($connection,$query);

echo("whats wrong?");
while($row = mysqli_fetch_assoc($select_all_collections)) {
    extract($row);
    echo($userData);
    echo("another proof?");
}



?>