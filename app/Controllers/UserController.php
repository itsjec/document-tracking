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
    
        $validationRules = [
            'username' => 'required|min_length[3]',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]',
        ];
    
        try {
            if (!$this->validate($validationRules)) {
                return $this->fail($this->validator->getErrors(), 400);
            }
    
            $mainModel = new UserModel();
            $mainModel->save([
                'username' => $request->getVar('username'),
                'password' => $request->getVar('password'),
                'role' => 'user',
            ]);
    
            return $this->respond(['message' => 'Registration successful'], 201);
        } catch (\Exception $e) {
            // Return an error message with additional details
            return $this->respondServerError([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
    
    public function login()
    {
        $model = new UserModel();
    
        $usernameOrEmail = $this->request->getPost('usernameOrEmail');
        $password = $this->request->getPost('password');
    
        if (empty($usernameOrEmail) || empty($password)) {
            return $this->respond(['message' => 'Invalid input'], 400);
        }
    
        $user = $model->where('username', $usernameOrEmail)
                      ->orWhere('email', $usernameOrEmail)
                      ->first();
    
        if ($user && password_verify($password, $user['password'])) {
            $userData = [
                'user_id' => $user['user_id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'role' => $user['role'],
            ];
    
            session()->set($userData);
    
            return $this->respond(['role' => $user['role']], 200);
        } else {
            return $this->respond(['message' => 'Invalid credentials'], 401);
        }
    }    
}
