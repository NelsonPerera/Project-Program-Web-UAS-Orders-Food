<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\Database\Exceptions\DatabaseException;

class OrderApi extends ResourceController
{
    protected $format = 'json';

    public function create()
    {
        $json = $this->request->getJSON();

        if (!$json) {
            return $this->fail('Invalid JSON data');
        }

        $orderModel = new \App\Models\OrderModel();
        $orderItemModel = new \App\Models\OrderItemModel(); // Verify this model exists or create it
        $db = \Config\Database::connect();

        $userId = $json->user_id ?? null;
        $items = $json->items ?? [];
        $address = $json->address ?? '';
        $paymentMethod = $json->payment_method ?? 'cod';
        $totalAmount = $json->total_amount ?? 0;
        $customerName = $json->customer_name ?? 'Guest';
        $customerPhone = $json->customer_phone ?? '';

        if (empty($items) || !$userId) {
            return $this->fail('Missing required fields (items or user_id)', 400);
        }

        // Calculate total valid amount and get restaurant_id from first item
        // ideally all items should be from same restaurant, but for now take first
        $firstItemC = (array)$items[0];
        $restaurantId = $firstItemC['restaurant_id'] ?? 1; // Fallback or need to fetch from DB for real validation

        $deliveryFee = 15000;
        
        $db->transStart();

        try {
            // Generate Order Number
            $orderNumber = 'ORD-' . strtoupper(uniqid());

            $orderData = [
                'order_number' => $orderNumber,
                'user_id' => $userId,
                'restaurant_id' => $restaurantId,
                'total_amount' => $totalAmount,
                'delivery_fee' => $deliveryFee,
                'status' => 'pending',
                'payment_method' => $paymentMethod,
                'payment_status' => 'pending',
                'delivery_address' => $address,
                'delivery_city' => 'Jakarta', // Hardcoded for now or add to form
                'customer_name' => $customerName,
                'customer_phone' => $customerPhone,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $orderId = $orderModel->insert($orderData);

            if (!$orderId) {
                throw new DatabaseException('Failed to create order');
            }

            foreach ($items as $item) {
                $item = (array)$item;
                $itemData = [
                    'order_id' => $orderId,
                    'food_item_id' => $item['id'],
                    'quantity' => $item['qty'],
                    'price' => $item['price'],
                    'subtotal' => $item['price'] * $item['qty']
                ];
                $orderItemModel->insert($itemData);
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                return $this->fail('Transaction failed', 500);
            }

            return $this->respondCreated([
                'status' => 'success',
                'message' => 'Order placed successfully',
                'order_id' => $orderId,
                'order_number' => $orderNumber
            ]);

        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 500);
        }
    }
}
