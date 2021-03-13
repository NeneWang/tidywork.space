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


if (isset($_GET['cardId']) && $_GET['cardId'] != "") {
    $cardId = $_GET['cardId'];
    $result = mysqli_query(
        $connection,
        "SELECT * FROM `cards` WHERE cardId=$cardId"
    );
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        extract($row);
        individualResponse($cardId, $cardData);
    } else {
        individualResponse(NULL, NULL, NULL, NULL, NULL, "No Record Found");
    }
} else if (!isset($_POST["update"])) {
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
