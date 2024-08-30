<?php

namespace Source\App\Api;

// Introduzindo token de segurança

use Source\Models\User;
use Source\Core\TokenJWT;

class Users extends Api
{
    public function listUsers ()
    {
        $users = new User();
        $this->back($users->selectAll());
    }

    public function createUser (array $data)
    {
        var_dump($data);
        if(in_array("", $data)) {
            $this->back([
                "type" => "error",
                "message" => "Preencha todos os campos"
            ]);
            return;
        }

        $user = new User(
            null,
            $data["status_id"],
            $data["services_id"],
            $data["name"],
            $data["email"],
            $data["password"]
        
        );
       

        $insertUser = $user->insert();

        if(!$insertUser){
            $this->back([
                "type" => "error",
                "message" => $user->getMessage()
            ]);
            return;
        }

        $this->back([
            "type" => "success",
            "message" => "Usuário cadastrodo com sucesso!"
        ]);

    }
    public function loginUser (array $data) {
        $user = new User();

        if(!$user->login($data["email"],$data["password"])){
            $this->back([
                "type" => "error",
                "message" => $user->getMessage()
            ]);
            return;
        }
        $token = new TokenJWT();
        $this->back([
            "type" => "success",
            "message" => $user->getMessage(),
            "user" => [
                "id" => $user->getId(),
                "name" => $user->getName(),
                "email" => $user->getEmail(),
                "token" => $token->create([
                    "id" => $user->getId(),
                    "name" => $user->getName(),
                    "email" => $user->getEmail()
                ])
            ]
        ]);

    }
    public function loginAdmin (array $data)
    {
        $user = new User();

        if(!$user->loginAdmin($data["email"],$data["password"])){
            $this->back([
                "type" => "error",
                "message" => $user->getMessage()
            ]);
            return;
        }
        $token = new TokenJWT();
        $this->back([
            "type" => "success",
            "message" => $user->getMessage(),
            "user" => [
                "id" => $user->getId(),
                "name" => $user->getName(),
                "email" => $user->getEmail(),
                "token" => $token->create([
                    "id" => $user->getId(),
                    "name" => $user->getName(),
                    "email" => $user->getEmail()
                ])
            ]
        ]);

    }

    
    
}