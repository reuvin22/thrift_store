<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserRegistration extends BaseController
{
    public function index()
    {
       
    }


    public function store()
    {
        $model = new UserModel();
        $employee_name = $this->request->getPost('employee_name');
        $password = $this->request->getPost('password');
        $contact_number = $this->request->getPost('contact_number');
        $age = $this->request->getPost('age');
        $gender = $this->request->getPost('gender');
        $email = $this->request->getPost('email');
        $address = $this->request->getPost('address');
        $role = 'User';
        $data = [
            'employee_name' => $employee_name,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'contact_number' => $contact_number,
            'age' => $age,
            'gender' => $gender,
            'email' => $email,
            'address' => $address,
            'role' => $role
        ];

        log_message('info', 'Received form data: ' . json_encode($this->request->getPost()));

        $model->save($data);

        session()->setFlashdata('success', 'User registered successfully!');

        return redirect()->to('/grantAccess');
    }

    public function show($id)
    {
        $model = new UserModel();
        $buyer = $model->findById($id);

        if (!$buyer) {
            return $this->response->setStatusCode(404, 'Buyer not found');
        }

        return $this->response->setJSON($buyer);
    }

    public function update($id)
    {
       
    }


    public function delete($id)
    {
        
    }
}
