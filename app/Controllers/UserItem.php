<?php

namespace App\Controllers;

use App\Models\ItemsModel;
use App\Models\UserItemModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class UserItem extends Controller
{
    public function store()
    {
        $model = new UserItemModel();
        $productModel = new ItemsModel();

        try {
            $cartItems = $this->request->getJSON(true);

            if (empty($cartItems)) {
                return $this->response->setJSON(['error' => 'No cart items provided.'])
                    ->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
            }

            log_message('info', 'Received cart data: ' . json_encode($cartItems));

            foreach ($cartItems as $item) {
                $product = $productModel->find($item['product_id']);

                if (!$product) {
                    return $this->response->setJSON(['error' => "Product with ID {$item['product_id']} not found."])
                        ->setStatusCode(ResponseInterface::HTTP_NOT_FOUND);
                }

                // Check if there's enough stock
                if ($product['stock'] < $item['qty']) {
                    return $this->response->setJSON([
                        'error' => "Insufficient stock for product: {$product['items_name']}."
                    ])->setStatusCode(ResponseInterface::HTTP_BAD_REQUEST);
                }

                $productModel->update($item['product_id'], [
                    'stock' => $product['stock'] - $item['qty']
                ]);

                $data = [
                    'product_id' => $item['product_id'],
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'qty' => $item['qty'],
                    'items_name' => $item['items_name'],
                    'buyer_id' => $item['buyer_id'],
                    'status' => 'Pending'
                ];

                $model->save($data);
            }

            return $this->response->setJSON(['success' => 'Order placed successfully.'])
                ->setStatusCode(ResponseInterface::HTTP_OK);

        } catch (\Exception $e) {
            return $this->response->setJSON(['error' => 'Error processing order: ' . $e->getMessage()])
                ->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function update($id)
    {
        $orderModel = new UserItemModel();
        $status = $this->request->getJSON()->status ?? null;

        if ($status) {
            $orderModel->update($id, ['status' => $status]);
            return $this->response->setJSON(['success' => true, 'message' => 'Order status updated']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Status not provided']);
    }

    public function delete($id)
    {
        $model = new UserItemModel();
        $orders = $model->find($id);

        if (!$orders) {
            return $this->response->setStatusCode(404)
                                ->setContentType('application/json')
                                ->setBody(json_encode(['success' => false, 'message' => 'Order not found']));
        }

        $model->delete($id);

        return $this->response->setStatusCode(200)
                            ->setContentType('application/json')
                            ->setBody(json_encode(['success' => true, 'message' => 'Order deleted successfully']));
    }
}

