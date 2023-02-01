<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Libraries\Hash;

class LoginController extends BaseController
{

    public function index()
    {
        $data['pageTitle'] = 'JeffLTE';
       return view('layouts/login',$data);

    }
    public function signin(){
        if ($this->request->isAJAX()) {
            $userModel = new UserModel();

            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');

            $data = $userModel->where('email', $email)->first();

            if ($data) {
                $checkpass = Hash::check($password, $data['password']);

                if ($checkpass) {
                    $set_data = [
                        'id' => $data['id'],
                        'email' => $data['email'],
                        'success' => true,
                        'msg' => 'Login in Successfully',
                        'redirectTo' => base_url('user/home'),
                    ];
                    return $this->response->setJSON(json_encode($set_data));
                } else {
                    $set_data = [
                        'success' => false,
                        'msg' => 'Incorrect password'
                    ];
                    return $this->response->setJSON(json_encode($set_data));
                }
            } else {
                $set_data = [
                    'success' => false,
                    'msg' => 'Email does not exist'
                ];
                return $this->response->setJSON(json_encode($set_data));
            }
        }
    }

    public function register(){
        $data['pageTitle'] = 'JeffLTE';
       return view('layouts/newregister',$data);
    }

    public function signup(){
        if ($this->request->isAJAX()) {
            
            $userModel = new UserModel();

            $data = [
                'name' =>  $this->request->getPost('name'),
                'email' =>  $this->request->getPost('email'),
                'password' => Hash::encrypt($this->request->getPost('password')),
            ];

            $data = $userModel->insert($data);

            if ($data) {
                $set_data = [
                    'success' => true,
                    'msg' => 'Registerd Successfully',
                    'redirectTo' => base_url('/')
                ];
                return $this->response->setJSON(json_encode($set_data));
            } else {
                $set_data = [
                    'success' => false,
                    'msg' => 'Registration failed encounterd an error',
                ];
                return $this->response->setJSON(json_encode($set_data));
            }
        }
    }
}
