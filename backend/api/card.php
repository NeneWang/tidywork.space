<?php

include '../includes/db.php';
include '../includes/functions.php';

header("Content-Type:application/json");

if (isset($_POST["update"])) {
    extract($_POST);

    $dataArray = json_decode($update);

    for ($i = 0; $i < count($dataArray->cards); $i++) {
        $cardId = $dataArray->cards[$i]->cardId;
        $jsonFormattedCardData = json_encode($dataArray->cards[$i]->cardData);
        updateCardIf($cardId, addslashes($jsonFormattedCardData));
    }
}

if (isset($_GET["completedCardId"])) {
    extract($_GET);
    // Then go to the make tthe id ofCompletedCardId into +1 in the columnId
    // Get and update based on the card ID
    $query = "SELECT * FROM `cards` WHERE cardId=$completedCardId";
    $result = mysqli_query(
        $connection,
        $query
    );


    $ind_item = array();
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        extract($row);
        $ind_item["cardId"] = $cardId;
        $ind_item["cardData"] = json_decode($cardData);
        
        $newColumnId = $ind_item["cardData"]["columnId"];
        $newColumnId = $newColumnId +1;
        $ind_item["cardData"]["columnId"] = $newColumnId;

    }
    

    // Now parse it and edit it here
    echo json_encode($ind_item);
    echo ("That's the completed Card: ". $completedCardId);
    echo($query);


}


if (isset($_GET['cardId']) ) {
    $cardId = $_GET['cardId'];
    $result = mysqli_query(
        $connection,
        "SELECT * FROM `cards` WHERE cardId=$cardId"
    );


    $item = array();
    $ind_item = array();
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        extract($row);

        $ind_item["cardId"] = $cardId;
        $ind_item["cardData"] = json_decode($cardData);

        echo json_encode($ind_item);



        // individualResponse($cardId, $cardData);
    } else {
        individualResponse(NULL, NULL, NULL, NULL, NULL, "No Record Found");
    }
} else if ( !isset($_POST["update"]) or !isset($_GET["completedCardId"]) ) {
    returnAllCards();
}




function returnAllCards()
{
    global $connection;
    //card
    $query = "SELECT * FROM `cards`";
    $result = mysqli_query(
        $connection,
        $query

    );
    $item = array();
    $ind_item = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $ind_item = array();
        extract($row);
        // individualResponse($tagId, $cardData);
        $ind_item["cardId"] = $cardId;

        $ind_item["cardData"] = json_decode($cardData);
        array_push($item, $ind_item);
    }

    $responseArray["cards"] = $item;
    $response = json_encode($responseArray);

    echo $response;
}

function individualResponse($cardId, $cardData)
{
    $response = array();
    $response["cardId"] = $cardId;
    array_push($response, json_decode($cardData));

    $json_response = json_encode($response);
    echo $json_response;
}
