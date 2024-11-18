<?php
require 'vendor/autoload.php';
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
function trackIMEI($imei) {
    $apiKey = $_ENV['API_KEY'];
    $apiUrl = "https://telecom-api.example.com/track?imei=$imei";
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $apiUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer $apiKey",
        ],
    ]);
    $response = curl_exec($curl);
    $error = curl_error($curl);
    curl_close($curl);
    if ($error) {
        return ["error" => $error];
    }
    return json_decode($response, true);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imei = $_POST['imei'] ?? null;
    if (!$imei) {
        echo json_encode(["error" => "IMEI is required!"]);
        exit;
    }
    $result = trackIMEI($imei);
    header('Content-Type: application/json');
    echo json_encode($result);
    exit;
}
?>

<!-- API KEY For IMEI  -->