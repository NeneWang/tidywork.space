<?php

include '../includes/db.php';
header("Content-Type:application/json");


if (isset($_GET['userId']) && $_GET['userId'] != "") {
    $userId = $_GET['userId'];
    $result = mysqli_query(
        $connection,
        "SELECT * FROM `boards` WHERE userId=$userId"
    );
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        extract($row);
        individualResponse($userId, $userData);
    } else {
        individualResponse(NULL, NULL, NULL, NULL, NULL, "No Record Found");
    }
} else {
    returnAllBoards();
}
$response = "";
$responseArray = array();
$item = array();



function returnAllBoards()
{
    global $response;
    $response = "";

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

        extract($row);
        // individualResponse($userId, $userData);
        $ind_item["userId"] = $userId;
        array_push($ind_item, json_decode($userData));

        array_push($item, $ind_item);
    }

    $responseArray["users"] = $item;


    //board
    $query = "SELECT * FROM `boards`";
    $result = mysqli_query(
        $connection,
        $query

    );
    $item = array();
    $ind_item = array();

    while ($row = mysqli_fetch_assoc($result)) {
        extract($row);
        // individualResponse($boardId, $boardData);
        $ind_item["boardId"] = $boardId;
        array_push($ind_item, json_decode($boardData));

        array_push($item, $ind_item);
    }

    $responseArray["boards"] = $item;


    //column
    $query = "SELECT * FROM `columns`";
    $result = mysqli_query(
        $connection,
        $query

    );
    $item = array();
    $ind_item = array();

    while ($row = mysqli_fetch_assoc($result)) {
        extract($row);
        // individualResponse($columnId, $columnData);
        $ind_item["columnId"] = $columnId;

        array_push($ind_item, json_decode($columnData));

        array_push($item, $ind_item);
    }

    $responseArray["columns"] = $item;


    //card
    $query = "SELECT * FROM `cards`";
    $result = mysqli_query(
        $connection,
        $query

    );
    $item = array();
    $ind_item = array();

    while ($row = mysqli_fetch_assoc($result)) {
        extract($row);
        // individualResponse($cardId, $cardData);
        $ind_item["cardId"] = $cardId;
        array_push($ind_item, json_decode($cardData));

        array_push($item, $ind_item);
    }

    $responseArray["cards"] = $item;


    //tag
    $query = "SELECT * FROM `tags`";
    $result = mysqli_query(
        $connection,
        $query

    );
    $item = array();
    $ind_item = array();

    while ($row = mysqli_fetch_assoc($result)) {
        extract($row);
        // individualResponse($tagId, $tagData);
        $ind_item["tagId"] = $tagId;

        array_push($ind_item, json_decode($tagData));

        array_push($item, $ind_item);
    }

    $responseArray["tags"] = $item;


    //comment
    $query = "SELECT * FROM `comments`";
    $result = mysqli_query(
        $connection,
        $query

    );
    $item = array();
    $ind_item = array();

    while ($row = mysqli_fetch_assoc($result)) {
        extract($row);
        // individualResponse($commentId, $commentData);
        $ind_item["commentId"] = $commentId;

        array_push($ind_item, json_decode($commentData));

        array_push($item, $ind_item);
    }

    $responseArray["comments"] = $item;

    $response = json_encode($responseArray);

    echo $response;
}

function individualResponse($userId, $userData)
{
    $response = array();
    $response["userId"] = $userId;
    $response["userData"] = $userData;

    $json_response = json_encode($response);
    echo $json_response;
}
