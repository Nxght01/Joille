<?php

namespace Source\Models;
use Source\Core\Connect;

use Source\Core\Model;

class Service extends Model
{
    private $id;
    private $name;
    private $description;
    private $value;
    private $categories_id;
    private $message;

    public function __construct(
        int $id = null,
        string $name = null,
        string $description = null,
        int $value = null,
        int $categories_id = null


    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->value = $value;
        $this->categories_id = $categories_id;
        $this->entity = "services";

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

    public function getDescription(): ?string
    {
        return $this->$description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getValue(): ?int 
    {
        return $this->$value;
    }

    public function setValue(int $value): void 
    {
        $this->value = $value;
    }
    public function getCategories_id(): ?int 
    {
        return $this->$categories_id;
    }

    public function setCategories_id(int $categories_id): void 
    {
        $this->categories_id = $categories_id;
    }
    public function getMessage(): ?string
    {
        return $this->message;
    }


    public function insert(): ?int
    {

        $conn = Connect::getInstance();


        $query = "SELECT * FROM services WHERE name LIKE :name";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $this->message = "Serviço já adicionado!";
            return false;
        }

        $query = "INSERT INTO services (name,description,value,categories_id) 
                  VALUES (:name,:description,:value,:categories_id)";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":value", $this->value);
        $stmt->bindParam(":categories_id", $this->categories_id);


        try {
            $stmt->execute();
            return $conn->lastInsertId();
        } catch (PDOException) {
            $this->message = "Por favor, informe todos os campos";
            return false;
        }
    }

    public function delete(int $id): bool
{

    $conn = Connect::getInstance();

    $checkQuery = "SELECT id FROM services WHERE id = :id";
    
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bindParam(":id", $id);
    $checkStmt->execute();

    if ($checkStmt->rowCount() === 0) {
        $this->message = "Serviço não encontrado.";
        return false;
    }

    $query = "DELETE FROM services WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":id", $id);

    try {
        $stmt->execute();
        $this->message = "Serviço Excluido com sucesso ";
        return true;
    } catch (PDOException) {
        $this->message = "Erro ao excluir o serviço: ";
        return false;
    }
}

public function listService()
    {

        $query = "SELECT * FROM services";
        $conn = Connect::getInstance();
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getServiceById(int $id): array
    {
        $query = "SELECT 
                    services.id, 
                    services.name
                  FROM services
                  WHERE services.id = :id";
        $conn = Connect::getInstance();
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateService(): bool
    {

        $conn = Connect::getInstance();

    $checkQuery = "SELECT name FROM services WHERE name = :name";
    
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bindParam(":name", $name);
    $checkStmt->execute();

    if ($checkStmt->rowCount() === 1) {
        $this->message = "Nome já cadastrado.";
        return false;
    }

        $query = "UPDATE services 
        SET services.name = :name,
            services.description = :description,
            services.value = :value,
            services.categories_id = :categories_id,
        WHERE services.id = :id";
        $conn = Connect::getInstance();
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":value", $this->value);
        $stmt->bindParam(":categories_id", $this->categories_id);
        
        try {
            $stmt->execute();
            $this->message = "Serviço Atualizado com sucesso ";
            return true;
        } catch (PDOException) {
            $this->message = "Erro ao Atualizar o serviço: ";
            return false;
        }
    }


}