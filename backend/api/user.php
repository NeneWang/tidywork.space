<?php

include '../includes/db.php';
header("Content-Type:application/json");


if (isset($_GET['resource_id']) && $_GET['resource_id'] != "") {

}else{
    returnAllUsers();
}

function returnAllUsers(){
    global $connection;
    $query = "SELECT * FROM `users`";
    $result = mysqli_query(
        $connection, $query
        
    );
    while ($row = mysqli_fetch_assoc($result)) {
        extract($row);
        individualResponse($userId, $userData);
    }
}

function individualResponse($userId, $userData){
    $response = array();
    $response["userId"] = $userId;
    $response["userData"] = $userData;

    $json_response = json_encode($response);
    echo $json_response;
}


?>
