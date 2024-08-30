<?php

namespace Source\App\Api;
use Source\Core\TokenJWT;
use Source\Models\Service;

class Services extends Api
{
    public function __construct()
    {
        parent::__construct();
        // quando todas as rotas da classe são autenticadas, o método $this->auth() pode ser evocado aqui
        // $this->auth();
    }

    public function insertServices (array $data)
    {
       // $this->auth();

        if(in_array("", $data)) {
            $this->back([
                "type" => "error",
                "message" => "Preencha todos os campos"
            ]);
            return;
        }

        $service = new Service(
            null,
            $data["name"],
            $data["description"],
            $data["value"],
            $data["categories_id"]
        );

        $insertservice = $service->insert();

        if(!$insertservice){
            $this->back([
                "type" => "error",
                "message" => $service->getMessage()
            ]);
            return;
        }

        $this->back([
            "type" => "success",
            "message" => "Serviço adicionado com sucesso!"
        ]);

    }
    
    public function delete(array $data)
    {
        //$this->auth();
    
        $service = new Service();
        $success = $service->delete($data["id"]);
        
        if(!$success){
            $this->back([
                "type" => "error",
                "message" => $service->getMessage()
            ]);
            return;
        }
    
        $this->back([
            "type" => "success",
            "message" => "Serviço Excluido com sucesso!"
        ]);
    }

    public function listService(array $data)
    {
        
        $service = new Service();
        $listservices = $service->listService($data);
        $this->back($listservices);
    }
    
    public function listById(array $data)
{
    $service = new Service();
    $service = $service->getServiceById($data["id"]);
    $this->back($service);
}
public function updateService(array $data)
{
    //$this->auth();
    $service = new Service(
        $data["id"],
        $data["name"],
        $data["description"],
        $data["value"],
        $data["categories_id"]
    );
    $serviceResult = $service->updateService();
   

}

}

