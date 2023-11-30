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

    public function index()
    {
        //
    }

    public function register()
    {
        $request = $this->request;

        // Validate input
        $validationRules = [
            'username' => 'required|min_length[3]',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]',
        ];

        if (!$this->validate($validationRules)) {
            return $this->fail($this->validator->getErrors(), 400);
        }

        $mainModel = new UserModel();
        $data = [
            'username' => $request->getVar('username'),
            'password' => $request->getVar('password'),
            'role' => 'admin', // Set the role to 'admin' by default
        ];

        // Debugging: Output the received data
        var_dump($data);

        // Debugging: Output the model's validation errors
        var_dump($mainModel->errors());

        $mainModel->save($data);

        return $this->respond(['message' => 'Registration successful'], 201);
    }
      
}
