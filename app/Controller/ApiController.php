<?php

namespace App\Controller;

class ApiController
{
public function get(){

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    $apiKey = "463d4c26-b9c5-4882-8541-7aae66f65764";
    $url = "https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest?convert=USD&limit=10";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "X-CMC_PRO_API_KEY: $apiKey"
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    echo $response;


}
}