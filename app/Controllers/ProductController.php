<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemsModel;
use CodeIgniter\HTTP\ResponseInterface;

class ProductController extends BaseController
{
    public function index()
    {
        try {
            $session = session();
            $employeeName = $session->get('employee_name');
            $role = $session->get('role');

            $model = new ItemsModel();
            $items = $model->findAll();

            $data = [
                'employee_name' => $employeeName,
                'role' => $role,
                'items' => $items,
            ];

            return view('products', $data);
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return 'An error occurred: ' . $e->getMessage();
        }
    }
}
