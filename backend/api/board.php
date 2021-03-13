<?php

include '../includes/db.php';
include '../includes/functions.php';


header("Content-Type:application/json");

if (isset($_POST["update"])) {
    extract($_POST);
    //  echo ($update);



    $dataArray = json_decode($update);

    // echo (count($dataArray->users));
    for ($i = 0; $i < count($dataArray->users); $i++) {
        $userId = $dataArray->users[$i]->userId;
        $jsonFormattedUserData = json_encode($dataArray->users[$i]->userData);
        updateUserIf($userId, addslashes($jsonFormattedUserData));
    }

    for ($i = 0; $i < count($dataArray->boards); $i++) {
        $boardId = $dataArray->boards[$i]->boardId;
        $jsonFormattedBoardData = json_encode($dataArray->boards[$i]->boardData);
        updateBoardIf($boardId, addslashes($jsonFormattedBoardData));
    }


    for ($i = 0; $i < count($dataArray->columns); $i++) {
        $columnId = $dataArray->columns[$i]->columnId;
        $jsonFormattedColumnData = json_encode($dataArray->columns[$i]->columnData);
        updatecolumnIf($ColumnId, addslashes($jsonFormattedColumnData));
    }


    for ($i = 0; $i < count($dataArray->cards); $i++) {
        $cardId = $dataArray->cards[$i]->cardId;
        $jsonFormattedCardData = json_encode($dataArray->cards[$i]->cardData);
        updateCardIf($cardId, addslashes($jsonFormattedCardData));
    }

    for ($i = 0; $i < count($dataArray->tags); $i++) {
        $tagId = $dataArray->tags[$i]->tagId;
        $jsonFormattedTagData = json_encode($dataArray->tags[$i]->tagData);
        updateTagIf($tagId, addslashes($jsonFormattedTagData));
    }

    for ($i = 0; $i < count($dataArray->comments); $i++) {
        $commentId = $dataArray->comments[$i]->commentId;
        $jsonFormattedCommentData = json_encode($dataArray->comments[$i]->commentData);
        updateCommentIf($commentId, addslashes($jsonFormattedCommentData));
    }



    // $boardId = $dataArray->boards[0]->boardId;
    // $jsonFormattedBoardData = json_encode($dataArray->boards[0]->boardData);
    // print_r($jsonFormattedBoardData);
    // updateboardIf($boardId, $jsonFormattedBoardData);

    // $columnId = $dataArray->columns[0]->columnId;
    // $jsonFormattedColumnData = json_encode($dataArray->columns[0]->columnData);
    // // print_r($jsonFormattedColumnData);
    // // echo(addslashes($jsonFormattedColumnData));
    // updateColumnIf($columnId, addslashes($jsonFormattedColumnData));

    // $cardId = $dataArray->cards[0]->cardId;
    // $jsonFormattedCardData = json_encode($dataArray->cards[0]->cardData);
    // updateCardIf($cardId, $jsonFormattedCardData);

    // $tagId = $dataArray->tags[0]->tagId;
    // $jsonFormattedTagData = json_encode($dataArray->tags[0]->tagData);
    // updateTagIf($tagId, $jsonFormattedTagData);

    // $commentId = $dataArray->comments[0]->commentId;
    // $jsonFormattedcCmmentData = json_encode($dataArray->comments[0]->commentData);
    // // print_r($jsonFormattedcCmmentData);
    // updateCommentIf($commentId, $jsonFormattedCommentData);
}


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
} else if (!isset($_POST["update"])) {
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
        $ind_item["boardData"] = json_decode($boardData);

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

        $ind_item["columnData"] = json_decode($columnData);

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

        $ind_item["cardData"] = json_decode($cardData);
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

        $ind_item["tagData"] = json_decode($tagData);

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

        $ind_item["commentData"] = json_decode($commentData);

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
