<?php

include '../includes/db.php';
include '../includes/functions.php';


$userId = 0;
header("Content-Type:application/json");

if (isset($_POST["update"])) {
    extract($_POST);
    //  echo ($update);


    $dataArray = json_decode($update);

    for ($i = 0; $i < count($dataArray->users); $i++) {
        $userId = $dataArray->users[$i]->userId;
        $jsonFormattedUserData = json_encode($dataArray->users[$i]->userData);
        updateUserIf($userId, addslashes($jsonFormattedUserData));
    }
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
}

if (isset($_GET["newCard"])) {
    // Get the newCards data and add +1;
    $metaArray = array();
    extract($_GET); //extracts userId
    $query = "SELECT * FROM `meta` WHERE metaUserId=$userId";
    $result = mysqli_query(
        $connection,
        $query
    );

    
    $item = array();
    $ind_item = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $ind_item = array();


        extract($row);
        // individualResponse($userId, $userData);
        $ind_item["metaId"] = $metaId;
        $ind_item["metaData"] = json_decode($metaData);

        array_push($item, $ind_item);
    }

    // print_r($item);

    $item[3]["metaData"]->cards = $item[3]["metaData"]->cards+1;

    print_r($item[3]["metaData"]->cards);
    
    $jsonFormattedUserData = json_encode($item[3]["metaData"]);
    updatemetaIf($metaId, addslashes($jsonFormattedUserData), 0);

}


if (isset($_GET["updateTime"])) {
    // Get the newCards data and add +1;
    extract($_GET); //extracts userId
    $metaArray = array();
    extract($_GET); //extracts userId
    $query = "SELECT * FROM `meta` WHERE metaUserId=$userId";
    $result = mysqli_query(
        $connection,
        $query
    );

    
    $item = array();
    $ind_item = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $ind_item = array();


        extract($row);
        // individualResponse($userId, $userData);
        $ind_item["metaId"] = $metaId;
        $ind_item["metaData"] = json_decode($metaData);

        array_push($item, $ind_item);
    }

    // print_r($item);


    print_r($item[3]["metaData"]);
    $item[3]["metaData"]->isTracking = !$item[3]["metaData"]->isTracking;
 !   $jsonFormattedUserData = json_encode($item[3]["metaData"]);
    updatemetaIf($metaId, addslashes($jsonFormattedUserData), 0);

}



if (isset($_GET["meta"])) {
    extract($_GET); //extracts userId
    $metaArray = array();
    $query = "SELECT * FROM `meta` WHERE metaUserId=$userId";
    $result = mysqli_query(
        $connection,
        $query
    );

    
    $item = array();
    $ind_item = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $ind_item = array();


        extract($row);
        // individualResponse($userId, $userData);
        $ind_item["metaId"] = $metaId;
        $ind_item["metaData"] = json_decode($metaData);

        array_push($item, $ind_item);
    }

    $responseArray["meta"] = $item;
    // print_r($item);


    echo(json_encode($responseArray));

}





function returnAllUsers()
{
    global $connection;
    //user
    $query = "SELECT * FROM `users`";
    $result = mysqli_query(
        $connection,
        $query

    );

    $item = array();
    $ind_item = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $ind_item = array();

        $ind_item = array();

        extract($row);
        // individualResponse($userId, $userData);
        $ind_item["userId"] = $userId;
        $ind_item["userData"] = json_decode($userData);

        array_push($item, $ind_item);
    }

    $responseArray["users"] = $item;
    $response = json_encode($responseArray);

    echo $response;
}

function individualResponse($userId, $userData)
{
    $response = array();
    $response["userId"] = $userId;
    array_push($response, json_decode($userData));

    $json_response = json_encode($response);
    echo $json_response;
}
