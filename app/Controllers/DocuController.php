<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Restful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\DocuModel;

class DocuController extends ResourceController
{
    public function __construct()
    {
        header('Access-Control-Allow-Origin: http://localhost:8081');
    }
    
    public function index()
    {
        //
    }

    
    public function getDocu()
    {
        header('Access-Control-Allow-Origin: http://localhost:8081');
        $main = new DocuModel();
        $data = $main->findAll();
        return $this->respond($data, 200);
    }
}
