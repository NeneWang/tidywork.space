<?php

include '../includes/db.php';
include '../includes/function.php';

header("Content-Type:application/json");

if (isset($_POST["update"])) {
    extract($_POST);
    //  echo ($update);


    $dataArray = json_decode($update);
     //print_r($dataArray);

    // echo($dataArray[0]->name);//Syntax to access the data Array Property
    // echo($dataArray[0]->tables[0]);

    // print_r($dataArray->users[0]);//works
    // print_r($dataArray->users[0]->userId); //gets userId
    // print_r($dataArray->users[0]->userData->name); //gets name
    
    $userId = $dataArray->users[0]->userId;
    $jsonFormattedUserData = json_encode($dataArray->users[0]->userData);
    print_r($jsonFormattedUserData); //gets json
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
