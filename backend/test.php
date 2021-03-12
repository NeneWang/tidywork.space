<?php

include './includes/db.php';

// header("Content-Type:application/json");
// if (isset($_GET['meta_id']) && $_GET['meta_id'] != "") {

//     $meta_id = $_GET['meta_id'];
//     $result = mysqli_query(
//         $connection,
//         "SELECT * FROM `resource_meta` WHERE meta_id=$meta_id"
//     );
//     if (mysqli_num_rows($result) > 0) {
//         $row = mysqli_fetch_array($result);
//         extract($row);
//         //extracts meta_id, meta_resource_id, pin_json, meta
//         individualResponse($meta_id, $meta_resource_id, $pin_json, $meta);
//     } else {
//         individualResponse(NULL, NULL, NULL, "No Record Found");
//     }
// } else {
//     returnAllResources();
// }

// function individualResponse($meta_id, $meta_resource_id, $pin_json, $meta)
// {
//     $response['meta_id'] = $meta_id;
//     $response['meta_resource_id'] = $meta_resource_id;
//     $response['pin_json'] = $pin_json;
//     $response['meta'] = $meta;

//     $json_response = json_encode($response);
//     echo $json_response;
// }


// function returnAllResources()
// {
//     global $connection;
//     $result = mysqli_query($connection, "SELECT * FROM `resource_meta`");

//     while ($row = mysqli_fetch_assoc($result)) {
//         extract($row);
//         individualResponse($meta_id, $meta_resource_id, $pin_json, $meta);
//     }
// }

global $connection;

$result = mysqli_query(
    $connection,
    "SELECT * FROM `users`"
);

echo($result);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    extract($row);
    echo($userId);
}

mysqli_close($connection);


?>

Hey 