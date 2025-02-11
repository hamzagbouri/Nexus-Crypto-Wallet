<?php
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

    public static function getAllCryptos(): array {
        return [];  // Placeholder
    }

    public static function findBySymbol(string $symbol): ?Crypto {
        return null; // Placeholder
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getSymbol(): string {
        return $this->symbol;
    }

    public function getSlug(): string {
        return $this->slug;
    }

    public function getMaxSupply(): float {
        return $this->max_supply;
    }

    public function getMarketCap(): float {
        return $this->market_cap;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function getVolume24h(): float {
        return $this->volume_24h;
    }

    public function getCirculatingSupply(): float {
        return $this->circulating_supply;
    }

    public function getTotalSupply(): float {
        return $this->total_supply;
    }
}
?>