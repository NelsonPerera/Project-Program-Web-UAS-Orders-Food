<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = session();
    }

    public function login()
    {
        if (strtoupper($this->request->getMethod()) === 'POST') {
            $rules = [
                'mobile' => 'required|numeric|min_length[10]',
                'password' => 'required|min_length[8]'
            ];

            if (!$this->validate($rules)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'errors' => $this->validator->getErrors()
                ]);
            }

            $mobile = $this->request->getPost('mobile');
            $password = $this->request->getPost('password');

            $user = $this->userModel->where('mobile', $mobile)->first();

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $this->setUserSession($user);
                    return $this->response->setJSON([
                        'status' => 'success',
                        'message' => 'Login successful',
                        'user' => [
                            'id' => $user['id'],
                            'name' => $user['name'],
                            'email' => $user['email'],
                            'mobile' => $user['mobile'],
                            'role' => $user['role']
                        ],
                        'redirect' => $user['role'] === 'admin' ? base_url('admin/dashboard') : base_url()
                    ]);
                }
            }

            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid mobile number or password'
            ]);
        }
        
        // Return view if GET request (though frontend uses modal)
        return view('auth/login');
    }

    public function register()
    {
        if (strtoupper($this->request->getMethod()) === 'POST') {
            $rules = [
                'name' => 'required|min_length[3]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'mobile' => 'required|numeric|min_length[10]|is_unique[users.mobile]',
                'password' => 'required|min_length[8]'
            ];

            if (!$this->validate($rules)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'errors' => $this->validator->getErrors()
                ]);
            }

            $data = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'mobile' => $this->request->getPost('mobile'),
                'password' => $this->request->getPost('password'),
                'role' => 'customer'
            ];

            if ($this->userModel->insert($data)) {
                $user = $this->userModel->where('id', $this->userModel->getInsertID())->first();
                $this->setUserSession($user);
                
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Registration successful',
                    'user' => [
                        'id' => $user['id'],
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'mobile' => $user['mobile'],
                        'role' => $user['role']
                    ],
                    'redirect' => '/'
                ]);
            }

            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Registration failed'
            ]);
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/');
    }

    private function setUserSession($user)
    {
        $data = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'mobile' => $user['mobile'],
            'role' => $user['role'],
            'isLoggedIn' => true
        ];

        $this->session->set($data);
    }
    
    public function check()
    {
        return $this->response->setJSON([
            'isLoggedIn' => $this->session->get('isLoggedIn') ?? false,
            'user' => $this->session->get('isLoggedIn') ? [
                'id' => $this->session->get('id'),
                'name' => $this->session->get('name'),
                'email' => $this->session->get('email'),
                'mobile' => $this->session->get('mobile'),
                'role' => $this->session->get('role')
            ] : null
        ]);
    }
}
