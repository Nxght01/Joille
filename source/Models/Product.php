<?php

namespace Source\Models;

use PDOException;
use Source\Core\Connect;
use Source\Core\Model;

class Product extends Model
{
    private $id;
    private $name;
    private $value;
    private $quantity;
    private $description;
    private $categories;
    private $categories_id;
    private $url;
    private $message;

    public function __construct(
        int $id = null,
        string $name = null,
        float $value = null,
        int $quantity = null,
        string $description = null,
        string $categories = null,
        int $categories_id = null,
        string $url = null

    ) {
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
        $this->quantity = $quantity;
        $this->description = $description;
        $this->url = $url;
        $this->categories = $categories;
        $this->entity = "products";
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(?float $value): void
    {
        $this->value = $value;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }
    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setQuantity(?int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
    public function getCategories(): ?string
    {
        return $this->categories;
    }

    public function setCategories(?string $categories): void
    {
        $this->categories = $categories;
    }
    public function getCategories_id(): ?string
    {
        return $this->categories;
    }

    public function setCategories_id(?string $categories_id): void
    {
        $this->categories = $categories_id;
    }
    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function getProductById(int $id): array
    {
        $query = "SELECT 
                    products.id, 
                    products.name, 
                    products.description, 
                    products.value, 
                    products.quantity, 
                    products.url, 
                    categories.name as 'category_name'
                  FROM products
                  INNER JOIN categories 
                  ON products.categories_id = categories.id
                  WHERE products.id = :product_id";
        $conn = Connect::getInstance();
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":product_id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function listProduct()
    {

        $query = "SELECT * FROM products";
        $conn = Connect::getInstance();
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateProduct(int $id): array
    {

        $query = "UPDATE products 
        SET products.name = :name, 
            products.value = :value, 
            products.quantity = :quantity, 
            products.description = :description, 
            products.url = :url, 
            products.categories_id = :categories_id 
        WHERE products.id = :id";
        $conn = Connect::getInstance();
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":value", $value);
        $stmt->bindParam(":quantity", $quantity);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":url", $url);
        $stmt->bindParam(":categories_id", $categories_id);
        
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function deleteProduct(int $id): bool
{

    $conn = Connect::getInstance();

    $checkQuery = "SELECT id FROM products WHERE id = :id";
    
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bindParam(":id", $id);
    $checkStmt->execute();

    if ($checkStmt->rowCount() === 0) {
        $this->message = "Produto não encontrado.";
        return false;
    }

    $query = "DELETE FROM products WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $id);

    try {
        $stmt->execute();
        $this->message = "Produto Excluido com sucesso ";
        return true;
    } catch (PDOException) {
        $this->message = "Erro ao excluir o produto: ";
        return false;
    }
}



    public function insert(): ?int
    {

        $conn = Connect::getInstance();


        $query = "SELECT * FROM products WHERE name LIKE :name";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $this->message = "Produto já cadastrado!";
            return false;
        }

        $query = "INSERT INTO products (name, value, quantity, description,url, categories_id) 
                  VALUES (:name, :value, :quantity, :description, :url, :categories)";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":value", $this->value);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":url", $this->url);
        $stmt->bindParam(":categories", $this->categories);

        try {
            $stmt->execute();
            return $conn->lastInsertId();
        } catch (PDOException) {
            $this->message = "Por favor, informe todos os campos";
            return false;
        }
    }
}