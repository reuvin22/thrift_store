<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserItemModel;

class Orders extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'Employee') {
            session()->setFlashdata('error', 'Unauthorized access. Only employees can access this page.');
            return redirect()->to('/');
        }

        try {
            $model = new UserItemModel();
            $orders = $model->findAll();
        
            if (empty($orders)) {
                log_message('info', 'No data found in the userItems table.');
            } else {
                log_message('info', 'Data retrieved successfully: ' . print_r($orders, true));
            }
        
            return view('orders', ['orders' => $orders]);
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return 'An error occurred: ' . $e->getMessage();
        }        
    }
}
