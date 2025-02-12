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
    public function getCrypto($slug)
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json");

        // Vérifier si le slug est vide
        if (empty($slug)) {
            echo json_encode(["error" => "Missing cryptocurrency slug"]);
            return;
        }

        // Appeler l'API CoinMarketCap pour récupérer les informations de la crypto
        $apiKey = "463d4c26-b9c5-4882-8541-7aae66f65764";
        $url = "https://pro-api.coinmarketcap.com/v1/cryptocurrency/info?slug=" . urlencode($slug);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "X-CMC_PRO_API_KEY: $apiKey"
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        // Vérifier si la réponse est valide
        if (!isset($data['data']) || empty($data['data'])) {
            echo json_encode(["error" => "Cryptocurrency not found"]);
            return;
        }

        // Extraire la première clé de l'objet retourné (car CoinMarketCap renvoie un objet indexé par ID)
        $crypto = reset($data['data']);

        // Formater les données de sortie
        $formattedData = [
            "id" => $crypto['id'],
            "name" => $crypto['name'],
            "symbol" => $crypto['symbol'],
            "category" => $crypto['category'],
            "description" => $crypto['description'],
            "logo" => $crypto['logo'],
            "date_added" => $crypto['date_added'],
            "tags" => $crypto['tags'] ?? [],
            "urls" => $crypto['urls']
        ];

        echo json_encode($formattedData);
    }

}