<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Restful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class UserController extends ResourceController
{
    public function __construct()
    {
        header('Access-Control-Allow-Origin: http://localhost:8081');
    }

    public function getData()
    {
        header('Access-Control-Allow-Origin: http://localhost:8081');
        $main = new UserModel();
        $data = $main->findAll();
        return $this->respond($data, 200);
    }

    public function login()
    {
        $model = new AdminModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $admin = $model->where('AdminUsername', $username)
                      ->where('AdminPassword', $password)
                      ->first();

        if ($admin) {
            // Successful login
            return $this->respond(['success' => true, 'officeId' => $admin['OfficeID']]);
        } else {
            // Failed login
            return $this->respond(['success' => false]);
        }
    }

    public function index()
    {
        //
    }
  
}
