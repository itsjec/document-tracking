<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Restful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\DocuModel;
use App\Models\OfficeModel;

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

    public function getOffice()
    {
        header('Access-Control-Allow-Origin: http://localhost:8081');
        $main = new OfficeModel();
        $data = $main->findAll();
        return $this->respond($data, 200);
    }

    public function saveDocument()
    {
        $model = new DocuModel();


        $data = [
            'title' => $this->request->getPost('title'),
            'purpose' => $this->request->getPost('purpose'),
            'location' => $this->request->getPost('location'),
            'received_from' => $this->request->getPost('received_from'),
            'date_received' => $this->request->getPost('date_received'),
            'required_action' => $this->request->getPost('required_action'),
            'status' => $this->request->getPost('status'),
        ];

        $model->insert($data);
        return $this->response->setJSON(['success' => true]);
    }

}
