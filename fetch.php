<?php

header("Content-Type: application/json");

if (!isset($_GET["url"])) {
    echo json_encode(["error" => "Missing URL"]);
    exit;
}

$url = $_GET["url"];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "User-Agent: Mozilla/5.0",
    "Accept: application/json"
]);

$response = curl_exec($ch);
curl_close($ch);

$json = json_decode($response, true);

if ($json) {
    echo json_encode($json);
} else {
    echo $response;
}
