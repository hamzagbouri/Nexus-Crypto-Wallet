<?php
class Crypto {
    public int $id;
    public string $nom;
    public string $symbol;
    public string $slug;
    public float $max_supply;
    public float $market_cap;
    public float $price;
    public float $volume_24h;
    public float $circulating_supply;
    public float $total_supply;

    public function __construct(int $id, string $nom, string $symbol, string $slug, float $max_supply, float $market_cap, float $price, float $volume_24h, float $circulating_supply, float $total_supply) {
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

    public function getId(): int { return $this->id; }
    public function getNom(): string { return $this->nom; }
    public function getSymbol(): string { return $this->symbol; }
    public function getSlug(): string { return $this->slug; }
    public function getMaxSupply(): float { return $this->max_supply; }
    public function getMarketCap(): float { return $this->market_cap; }
    public function getPrice(): float { return $this->price; }
    public function getVolume24h(): float { return $this->volume_24h; }
    public function getCirculatingSupply(): float { return $this->circulating_supply; }
    public function getTotalSupply(): float { return $this->total_supply; }

    public function setNom(string $nom) { $this->nom = $nom; }
    public function setSymbol(string $symbol) { $this->symbol = $symbol; }
    public function setSlug(string $slug) { $this->slug = $slug; }
    public function setMaxSupply(float $max_supply) { $this->max_supply = $max_supply; }
    public function setMarketCap(float $market_cap) { $this->market_cap = $market_cap; }
    public function setPrice(float $price) { $this->price = $price; }
    public function setVolume24h(float $volume_24h) { $this->volume_24h = $volume_24h; }
    public function setCirculatingSupply(float $circulating_supply) { $this->circulating_supply = $circulating_supply; }
    public function setTotalSupply(float $total_supply) { $this->total_supply = $total_supply; }

    public static function getAllCryptos() {}
    public static function findBySymbol(string $symbol) {}
}
?>