<?php
namespace App\Model;
class Crypto {
    private $id;
    private $nom;
    private $symbol;
    private $slug;
    private $max_supply;
    private $market_cap;
    private $price;
    private $volume_24h;
    private $circulating_supply;
    private $total_supply;

    public function __construct($id, $nom, $symbol, $slug, $max_supply, $market_cap, $price, $volume_24h, $circulating_supply, $total_supply) {
        $this->id = $id;
        $this->nom = $nom;
        $this->symbol = $symbol;
        $this->slug = $slug;
        $this->max_supply = $max_supply;
        $this->market_cap = $market_cap;
        $this->price = $price;
        $this->volume_24h = $volume_24h;
        $this->circulating_supply = $circulating_supply;
        $this->total_supply = $total_supply;
    }

    public static function getAllCryptos() {
        return [];  // Placeholder
    }

    public static function findBySymbol( $symbol) {
        return null; // Placeholder
    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getSymbol(){
        return $this->symbol;
    }

    public function getSlug() {
        return $this->slug;
    }

    public function getMaxSupply(){
        return $this->max_supply;
    }

    public function getMarketCap() {
        return $this->market_cap;
    }

    public function getPrice(){
        return $this->price;
    }

    public function getVolume24h() {
        return $this->volume_24h;
    }

    public function getCirculatingSupply() {
        return $this->circulating_supply;
    }

    public function getTotalSupply() {
        return $this->total_supply;
    }
}
?>