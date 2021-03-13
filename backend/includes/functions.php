<?php

function consoleLogFromPHP($text)
{

    echo '<script>console.log("' . $text . '")</script>';
}



function updateUserIf($userId, $userData)
{
    global $connection;
    $query = "INSERT INTO users (userId, userData) VALUES ($userId, '$userData') ON DUPLICATE KEY UPDATE userData='$userData' ";

    // echo($query);

    $update_query = mysqli_query($connection, $query);
}

?>