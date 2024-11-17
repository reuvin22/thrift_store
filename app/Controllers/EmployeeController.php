<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class EmployeeController extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'Employee') {
            session()->setFlashdata('error', 'Unauthorized access. Only employees can access this page.');
            return redirect()->to('/');
        }

        try {
            $model = new UserModel();
            $employees = $model->where('role', 'Employee')->findAll();

            $data = [
                'employees' => $employees,
            ];

            return view('employee/index', $data);
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return 'An error occurred: ' . $e->getMessage();
        }
    }


    public function store()
    {
        $model = new UserModel();
        $employee_id = '';
        do {
            $random_number = rand(0, 99999);
            
            $employee_id = str_pad($random_number, 5, '0', STR_PAD_LEFT);
            
            $existing_employee = $model->where('employee_id', $employee_id)->first();
        } while ($existing_employee); 

        $employee_name = $this->request->getPost('employee_name');
        $password = $this->request->getPost('password');
        $department = $this->request->getPost('department');
        $age = $this->request->getPost('age');
        $gender = $this->request->getPost('gender');
        $email = $this->request->getPost('email');
        $address = $this->request->getPost('address');
        $contact_number = $this->request->getPost('contact_number');
        $role = "Employee";
        $data = [
            'employee_id' => $employee_id, 
            'employee_name' => $employee_name,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'department' => $department,
            'age' => $age,
            'gender' => $gender,
            'email' => $email,
            'address' => $address,
            'contact_number' => $contact_number,
            'role' => $role
        ];

        

        log_message('info', 'Received form data: ' . json_encode($this->request->getPost()));

        $model->save($data);

        return redirect()->to('/employees');
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
        $employeeModel = new UserModel();
        $employee = $employeeModel->find($id);

        if (!$employee) {
            return redirect()->to('/employees')->with('error', 'Employee not found');
        }

        $data = [
            'employee_name'    => $this->request->getPost('employee_name') ?? $employee['employee_name'],
            'email'            => $this->request->getPost('email') ?? $employee['email'],
            'department'       => $this->request->getPost('department') ?? $employee['department'],
            'age'              => $this->request->getPost('age') ?? $employee['age'],
            'gender'           => $this->request->getPost('gender') ?? $employee['gender'],
            'address'          => $this->request->getPost('address') ?? $employee['address'],
            'contact_number'   => $this->request->getPost('contact_number') ?? $employee['contact_number']
        ];
        $employeeModel->update($id, $data);
        
        return redirect()->to('/employees')->with('success', 'Employee updated successfully');
    }


    public function delete($id)
    {
        $model = new UserModel();
    
        $employee = $model->find($id);
        if (!$employee) {
            return $this->response->setStatusCode(404)->setBody(json_encode(['message' => 'Employee not found']));
        }
    
        $model->delete($id);
        return redirect()->to('/employees');
    }

}
