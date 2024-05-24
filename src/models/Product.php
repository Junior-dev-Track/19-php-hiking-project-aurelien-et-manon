<?php
declare(strict_types=1);

namespace Models;

use PDO;

class Product extends Database
{
    public function findAll(int $limit = 0): array
    {
        if($limit == 0) {
            $sql = "SELECT * FROM hikes";
        } else {
            $sql = "SELECT * FROM hikes LIMIT " . $limit;
        }

        $stmt = $this->query($sql);

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }

    public function find(string $productCode): array|false
    {
        $stmt = $this->query(
            "SELECT * FROM hikes WHERE id_hikes = ?",
            [$productCode]
        );
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}