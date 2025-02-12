<?php
namespace App\Model;
use PDO;
use PDOException;
class Database {
  private static $instance = null;
  private $pdo;

  private function __construct() {
      try {
          $dsn = "pgsql:host=localhost;port=5432;dbname=nexus";
          $username = "postgres";
          $password = "achraf123";
          
          $this->pdo = new PDO($dsn, $username, $password);
          $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $e) {
          die("Erreur de connexion à la base de données : " . $e->getMessage());
      }
  }

  public static function getInstance() {
      if (self::$instance === null) {
          self::$instance = new Database();
      }
      return self::$instance;
  }

  public function getConnection() {
      return $this->pdo;
  }
}
// class Database {
//     private static $instance = null;
//     private $pdo;

//     private function __construct($dsn, $username, $password) {
//         try {
//             $this->pdo = new PDO($dsn, $username, $password);
//             $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         } catch (PDOException $e) {
//             error_log("Database connection error: " . $e->getMessage());
//             throw new Exception("Database connection failed.");
//         }
//     }

//     public static function getInstance($dsn = null, $username = null, $password = null) {
//         if (self::$instance === null) {
//             $dsn = $dsn ?? 'pgsql:host=localhost;port=5432;dbname=nexus';
//             $username = "postgres";
//             $password = "achraf123";
//             self::$instance = new Database($dsn, $username, $password);
//         }
//         return self::$instance;
//     }

//     public function getConnection() {
//         return $this->pdo;
//     }
// }
?>

