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

        $ind_item = array();

        extract($row);
        // individualResponse($userId, $userData);
        $ind_item["userId"] = $userId;
        $ind_item["userData"] = json_decode($userData);

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
              $ind_item = array();
        extract($row);
        // individualResponse($boardId, $boardData);
        $ind_item["boardId"] = $boardId;
        $ind_item["boardData"] = json_decode($userData);

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
              $ind_item = array();
        extract($row);
        // individualResponse($columnId, $columnData);
        $ind_item["columnId"] = $columnId;

        $ind_item["columnData"] = json_decode($userData);

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
        $ind_item = array();
        extract($row);
        // individualResponse($tagId, $cardData);
        $ind_item["cardId"] = $cardId;

        $ind_item["cardData"] = json_decode($userData);
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
              $ind_item = array();
        extract($row);
        // individualResponse($tagId, $tagData);
        $ind_item["tagId"] = $tagId;

        $ind_item["tagData"] = json_decode($userData);

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
              $ind_item = array();
        extract($row);
        // individualResponse($commentId, $commentData);
        $ind_item["commentId"] = $commentId;

        $ind_item["commentData"] = json_decode($userData);

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
