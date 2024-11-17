<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemsModel;
use CodeIgniter\HTTP\ResponseInterface;

class ItemsController extends BaseController
{
    public function index()
    {
        try {
            $model = new ItemsModel();
            $items = $model->findAll();

            $data = [
                'items' => $items,
            ];

            return view('items/index', $data);
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return 'An error occurred: ' . $e->getMessage();
        }
    }

    public function store()
    {
        $model = new ItemsModel();
    
        $items_name = $this->request->getPost('items_name');
        $description = $this->request->getPost('description');
        $category = $this->request->getPost('category');
        $size = $this->request->getPost('size');
        $color = $this->request->getPost('color');
        $price = $this->request->getPost('price');
        $stock = $this->request->getPost('stock');
    
        $image = $this->request->getFile('image_url');
        $image_url = null;
    
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
    
            // Save to public/uploads directory
            $path = FCPATH . 'uploads/';
            if (!is_dir($path)) {
                mkdir($path, 0755, true); // Create the directory if it doesn't exist
            }
    
            if ($image->move($path, $newName)) {
                $image_url = 'uploads/' . $newName; // Save relative path for public access
            } else {
                die("Failed to move file: " . $image->getErrorString());
            }
        } else {
            $error = $image ? $image->getErrorString() : 'No file uploaded';
            die("File upload error: " . $error);
        }
    
        $data = [
            'items_name' => $items_name,
            'description' => $description,
            'category' => $category,
            'size' => $size,
            'color' => $color,
            'price' => $price,
            'stock' => $stock,
            'image_url' => $image_url
        ];
    
        if (!$model->save($data)) {
            $errors = $model->errors();
            die("Database save error: " . print_r($errors, true));
        }
    
        return redirect()->to('/items')->with('success', 'Item added successfully.');
    }    


    public function show($id)
    {
        $model = new ItemsModel();

        $buyer = $model->findById($id);

        if (!$buyer) {
            return $this->response->setStatusCode(404, 'Buyer not found');
        }

        return $this->response->setJSON($buyer);
    }

    public function update($id)
    {
        $model = new ItemsModel();
    
        $currentItem = $model->find($id);
        if (!$currentItem) {
            die("Item not found");
        }
    
        $items_name = $this->request->getPost('items_name');
        $description = $this->request->getPost('description');
        $category = $this->request->getPost('category');
        $size = $this->request->getPost('size');
        $color = $this->request->getPost('color');
        $price = $this->request->getPost('price');
        $stock = $this->request->getPost('stock');
    
        $image = $this->request->getFile('image_url');
        $image_url = $currentItem['image_url'];
    
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
    
            $path = FCPATH . 'uploads/';
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }
    
            if ($image->move($path, $newName)) {
                $image_url = 'uploads/' . $newName;
    
                $oldImagePath = FCPATH . $currentItem['image_url'];
                if (file_exists($oldImagePath) && is_file($oldImagePath)) {
                    unlink($oldImagePath);
                }
            } else {
                die("Failed to move file: " . $image->getErrorString());
            }
        }
    
        $data = [
            'id' => $id,
            'items_name' => $items_name,
            'description' => $description,
            'category' => $category,
            'size' => $size,
            'color' => $color,
            'price' => $price,
            'stock' => $stock,
            'image_url' => $image_url
        ];
    
        if (!$model->save($data)) {
            $errors = $model->errors();
            die("Database save error: " . print_r($errors, true));
        }
    
        return redirect()->to('/items')->with('success', 'Item updated successfully.');
    }    
    
    public function delete($id)
    {
        $model = new ItemsModel();
    
        $items = $model->find($id);
        if (!$items) {
            return $this->response->setStatusCode(404)->setBody(json_encode(['message' => 'Item not found']));
        }
    
        if (!empty($items['image_url'])) {
            $imagePath = FCPATH . $items['image_url'];
            if (file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);
            }
        }
    
        if ($model->delete($id)) {
            return redirect()->to('/items')->with('success', 'Item deleted successfully.');
        } else {
            return $this->response->setStatusCode(500)->setBody(json_encode(['message' => 'Failed to delete item']));
        }
    }
}
