<?php

include 'includes/db.php';

global $connection;
$query = "SELECT * FROM `users`";
$result = mysqli_query(
    $connection, $query
    
);
while ($row = mysqli_fetch_assoc($result)) {
    extract($row);
    echo($userData);
}

echo("Echo should be working");

?>

Hey 