<?php

include '../includes/db.php';
header("Content-Type:application/json");
if (isset($_GET['resource_id']) && $_GET['resource_id'] != "") {

    $resource_id = $_GET['resource_id'];
    $result = mysqli_query(
        $connection,
        "SELECT * FROM `resource` WHERE resource_id=$resource_id"
    );
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        extract($row);
        //extracts resource_id, resource_image_dir, resource_category, resource_status, resource_prediction, raw_api_json
        individualResponse($resource_id, $resource_image_dir, $resource_category, $resource_status, $resource_prediction, $raw_api_json);
    } else {
        individualResponse(NULL, NULL, NULL, NULL, NULL, "No Record Found");
    }
} else {
    returnAllResources();
}

function individualResponse($resource_id, $resource_image_dir, $resource_category, $resource_status, $resource_prediction, $raw_api_json)
{
    $response['resource_id'] = $resource_id;
    $response['resource_image_dir'] = $resource_image_dir;
    $response['resource_category'] = $resource_category;
    $response['resource_status'] = $resource_status;
    $response['resource_prediction'] = $resource_prediction;
    $response['raw_api_json'] = $raw_api_json;

    $json_response = json_encode($response);
    echo $json_response;
}


function returnAllResources()
{
    global $connection;
    $result = mysqli_query($connection, "SELECT * FROM `resource`");

    while ($row = mysqli_fetch_assoc($result)) {
        extract($row);
        individualResponse($resource_id, $resource_image_dir, $resource_category, $resource_status, $resource_prediction, $raw_api_json);
    }
}

mysqli_close($connection);
