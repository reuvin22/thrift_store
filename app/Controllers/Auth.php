<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    public function login()
    {
        $employeeLogin = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $data = $employeeLogin->where('email', $email)->first();

        if ($data) {
            if (password_verify($password, $data['password'])) {
                session()->set([
                    'id' => $data['id'],
                    'email' => $data['email'],
                    'employee_id' => $data['employee_id'],
                    'employee_name' => $data['employee_name'],
                    'department' => $data['department'],
                    'age' => $data['age'],
                    'gender' => $data['gender'],
                    'address' => $data['address'],
                    'contact_number' => $data['contact_number'],
                    'created_at' => $data['created_at'],
                    'role' => $data['role'],
                    'logged_in' => true
                ]);
                return redirect()->to('/');
            } else {
                session()->setFlashdata('error', 'Invalid email or password');
                return redirect()->to('/grantAccess');
            }
        } else {
            session()->setFlashdata('error', 'Email not found');
            return redirect()->to('/grantAccess');
        }
    }

    public function logout()
    {
        session()->destroy();

        session()->setFlashdata('success', 'Logout Successfully');
        return redirect()->to('/');
    }
}
