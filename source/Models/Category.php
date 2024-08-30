<?php

namespace Source\Models;
use Source\Core\Connect;

use Source\Core\Model;

class Category extends Model
{
    private $id;
    private $name;
    private $message;

    public function __construct(
        int $id = null,
        string $name = null,

    ) {
        $this->id = $id;
        $this->name = $name;
        $this->entity = "categories";

    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function insert(): ?int
    {

        $conn = Connect::getInstance();


        $query = "SELECT * FROM categories WHERE name LIKE :name";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $this->message = "Categoria já cadastrada!";
            return false;
        }

        $query = "INSERT INTO categories (name) 
                  VALUES (:name)";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(":name", $this->name);

        try {
            $stmt->execute();
            return $conn->lastInsertId();
        } catch (PDOException) {
            $this->message = "Por favor, informe todos os campos";
            return false;
        }
    }

    public function deleteCategory(int $id): bool
{

    $conn = Connect::getInstance();

    $checkQuery = "SELECT id FROM categories WHERE id = :id";
    
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bindParam(":id", $id);
    $checkStmt->execute();

    if ($checkStmt->rowCount() === 0) {
        $this->message = "Categoria não encontrada.";
        return false;
    }

    $query = "DELETE FROM categories WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $id);

    try {
        $stmt->execute();
        $this->message = "Categoria Excluida com sucesso ";
        return true;
    } catch (PDOException) {
        $this->message = "Erro ao excluir a categoria: ";
        return false;
    }
}

public function listCategory()
{

    $query = "SELECT * FROM categories";
    $conn = Connect::getInstance();
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

    public function getCategoryById(int $id): array
    {
        $query = "SELECT 
                    categories.id, 
                 categories.name
                  FROM categories
                  WHERE categories.id = :id";
        $conn = Connect::getInstance();
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateService(): bool
    {

        $conn = Connect::getInstance();

    $checkQuery = "SELECT name FROM categories WHERE name = :name";
    
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bindParam(":name", $name);
    $checkStmt->execute();

    if ($checkStmt->rowCount() === 1) {
        $this->message = "Nome já cadastrado.";
        return false;
    }

        $query = "UPDATE categories 
        SET categories.name = :name,
        WHERE categories.id = :id";
        $conn = Connect::getInstance();
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":name", $this->name);
       
        
        try {
            $stmt->execute();
            $this->message = "Categoria Atualizada com sucesso ";
            return true;
        } catch (PDOException) {
            $this->message = "Erro ao Atualizar a categoria: ";
            return false;
        }
    }



}