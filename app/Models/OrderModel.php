<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table            = 'orders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'order_number', 'user_id', 'restaurant_id', 'total_amount', 
        'delivery_fee', 'status', 'payment_method', 'payment_status', 
        'delivery_address', 'delivery_city', 'customer_name', 
        'customer_phone', 'notes'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function generateOrderNumber()
    {
        return 'ORD-' . date('Ymd') . '-' . rand(1000, 9999);
    }

    public function getOrdersByUser($userId)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }
}
