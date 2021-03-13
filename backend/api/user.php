<?php

include '../includes/db.php';
header("Content-Type:application/json");


if (isset($_GET['userId']) && $_GET['userId'] != "") {
    $userId = $_GET['userId'];
    $result = mysqli_query(
        $connection,
        "SELECT * FROM `users` WHERE userId=$userId"
    );
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        extract($row);
        individualResponse($userId, $userData);
    } else {
        individualResponse(NULL, NULL, NULL, NULL, NULL, "No Record Found");
    }

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
