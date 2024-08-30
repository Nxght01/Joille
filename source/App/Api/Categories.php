<?php

namespace Source\App\Api;
use Source\Core\TokenJWT;
use Source\Models\Category;

class Categories extends Api
{
    public function __construct()
    {
        parent::__construct();
        // quando todas as rotas da classe são autenticadas, o método $this->auth() pode ser evocado aqui
        // $this->auth();
    }

    public function insertCategories (array $data)
    {
        //$this->auth();

        if(in_array("", $data)) {
            $this->back([
                "type" => "error",
                "message" => "Preencha todos os campos"
            ]);
            return;
        }

        $category = new Category(
            null,
            $data["name"],
        );

        $insertcategory = $category->insert();

        if(!$insertcategory){
            $this->back([
                "type" => "error",
                "message" => $category->getMessage()
            ]);
            return;
        }

        $this->back([
            "type" => "success",
            "message" => "Categoria cadastrada com sucesso!"
        ]);

    }
    
    public function deleteCategory(array $data)
{
    //$this->auth();

    $categories = new Category();
    $success = $categories->deleteCategory($data["id"]);
    
    if(!$success){
        $this->back([
            "type" => "error",
            "message" => $service->getMessage()
        ]);
        return;
    }

    $this->back([
        "type" => "success",
        "message" => "Categoria Excluida com sucesso!"
    ]);
}

    public function listCategory(array $data)
    {
        
        $category = new Category();
        $listcategories = $category->listCategory($data);
        $this->back($listcategories);
    }
    
    public function listById(array $data)
{
    $category = new Category();
    $category = $category->getCategoryById($data["id"]);
    $this->back($category);
}
public function updateCategory(array $data)
{
    //$this->auth();
    $category = new Category(
        $data["id"],
        $data["name"],
        $data["description"],
        $data["value"],
        $data["categories_id"]
    );
    $categoryResult = $category->updateCategory();
   

}

}

