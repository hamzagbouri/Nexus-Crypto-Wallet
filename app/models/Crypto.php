<?php
class Crypto {
    public $id;
    public $nom;
    public $symbol;
    public $slug;
    public $max_supply;
    public $market_cap;
    public $price;
    public $volume_24h;
    public $circulating_supply;
    public $total_supply;

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

    public function getId() { return $this->id; }
    public function getNom() { return $this->nom; }
    public function getSymbol() { return $this->symbol; }
    public function getSlug() { return $this->slug; }
    public function getMaxSupply() { return $this->max_supply; }
    public function getMarketCap() { return $this->market_cap; }
    public function getPrice() { return $this->price; }
    public function getVolume24h() { return $this->volume_24h; }
    public function getCirculatingSupply() { return $this->circulating_supply; }
    public function getTotalSupply() { return $this->total_supply; }

    public function setNom($nom) { $this->nom = $nom; }
    public function setSymbol($symbol) { $this->symbol = $symbol; }
    public function setSlug($slug) { $this->slug = $slug; }
    public function setMaxSupply($max_supply) { $this->max_supply = $max_supply; }
    public function setMarketCap($market_cap) { $this->market_cap = $market_cap; }
    public function setPrice($price) { $this->price = $price; }
    public function setVolume24h($volume_24h) { $this->volume_24h = $volume_24h; }
    public function setCirculatingSupply($circulating_supply) { $this->circulating_supply = $circulating_supply; }
    public function setTotalSupply($total_supply) { $this->total_supply = $total_supply; }

    public static function getAllCryptos() {}
    public static function findBySymbol($symbol) {}
}
?>