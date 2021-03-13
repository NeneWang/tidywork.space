<?php

include '../includes/db.php';
include '../includes/functions.php';

header("Content-Type:application/json");

if (isset($_POST["update"])) {
    extract($_POST);
    //  echo ($update);


    $dataArray = json_decode($update);
    $userId = $dataArray->users[0]->userId;
    $jsonFormattedUserData = json_encode($dataArray->users[0]->userData);
    updateUserIf($userId, $jsonFormattedUserData);
}





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
} else if (!isset($_POST["update"])) {
    returnAllUsers();
}




function returnAllUsers()
{
    global $connection;
    $query = "SELECT * FROM `users`";
    $result = mysqli_query(
        $connection,
        $query

    );
    while ($row = mysqli_fetch_assoc($result)) {
        extract($row);
        individualResponse($userId, $userData);
    }
}

function individualResponse($userId, $userData)
{
    $response = array();
    $response["userId"] = $userId;
    array_push($response, json_decode($userData));

    $json_response = json_encode($response);
    echo $json_response;
}
