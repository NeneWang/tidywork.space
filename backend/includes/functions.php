<?php

header('Access-Control-Allow-Origin: *'); 

function consoleLogFromPHP($text)
{

    echo '<script>console.log("' . $text . '")</script>';
}



// UpdateIfs

function updateUserIf($userId, $userData)
{
    global $connection;
    $query = "INSERT INTO users (userId, userData) VALUES ($userId, '$userData') ON DUPLICATE KEY UPDATE userData='$userData' ";

    // echo($query);

    $update_query = mysqli_query($connection, $query);
}


function updateBoardIf($boardId, $boardData)
{
    global $connection;
    $query = "INSERT INTO boards (boardId, boardData) VALUES ($boardId, '$boardData') ON DUPLICATE KEY UPDATE boardData='$boardData' ";

    // echo($query);

    $update_query = mysqli_query($connection, $query);
}




function updateColumnIf($columnId, $columnData)
{
    // echo($columnData);
    global $connection;
    $query = "INSERT INTO columns (columnId, columnData) VALUES ($columnId, '{$columnData}') ON DUPLICATE KEY UPDATE columnData='$columnData' ";

    // echo($query);

    $update_query = mysqli_query($connection, $query);
}

function updateCardIf($cardId, $cardData)
{
    global $connection;
    $query = "INSERT INTO cards (cardId, cardData) VALUES ($cardId, '$cardData') ON DUPLICATE KEY UPDATE cardData='$cardData' ";

    // echo($query);

    $update_query = mysqli_query($connection, $query);
}

function updateTagIf($tagId, $tagData)
{
    global $connection;
    $query = "INSERT INTO tags (tagId, tagData) VALUES ($tagId, '$tagData') ON DUPLICATE KEY UPDATE tagData='$tagData' ";

    // echo($query);

    $update_query = mysqli_query($connection, $query);
}

function updateCommentIf($commentId, $commentData)
{
    global $connection;
    $query = "INSERT INTO comments (commentId, commentData) VALUES ($commentId, '$commentData') ON DUPLICATE KEY UPDATE commentData='$commentData' ";

    // echo($query);

    $update_query = mysqli_query($connection, $query);
}



?>