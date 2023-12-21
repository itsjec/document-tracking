<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use Config\JWT as CodeIgniterJWT; // Alias CodeIgniter's JWT class
use \Firebase\JWT\JWT;


class UserController extends ResourceController
{

    public function getData()
    {
        $main = new UserModel();
        $data = $main->findAll();
        return $this->respond($data, 200);
    }

    private $key;

    public function login()
    {
        try {
            $model = new UserModel();
    
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
    
            $whereClause = [
                'AdminUsername' => $username,
                'AdminPassword' => $password
            ];
    
            $user = $model->where($whereClause)->first();
    
            if (is_null($user)) {
                return $this->respond(['error' => 'Invalid username or password']);
            }
    
            session()->set('OfficeID', $user['OfficeID']);
    
            $token = $this->generateToken($user);
    
            return $this->respond(['token' => $token, 'office_id' => $user['OfficeID']], 200);
        } catch (\Throwable $th) {
            return $this->respond(['error' => 'Login Error: ' . $th->getMessage()]);
        }
    }
    

    private function generateToken($user)
    {
        $key = getenv('JWT_SECRET');

        $payload = [
            'user_id' => $user['OfficeID'],
            'iat'     => time(),
            'exp'     => time() + 3600,
        ];
    
        try {
            $token = JWT::encode($payload, $key, 'HS256');
            return $token;
        } catch (\Exception $e) {
            log_message('error', 'JWT Token Encoding Error: ' . $e->getMessage());
            return null;
        }
    }
    
}
