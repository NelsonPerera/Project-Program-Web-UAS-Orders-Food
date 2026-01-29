<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table            = 'cart';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'user_id', 'food_item_id', 'quantity'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getUserCart($userId)
    {
        return $this->select('cart.*, food_items.name, food_items.price, food_items.image, restaurants.name as restaurant_name')
                    ->join('food_items', 'food_items.id = cart.food_item_id')
                    ->join('restaurants', 'restaurants.id = food_items.restaurant_id')
                    ->where('cart.user_id', $userId)
                    ->findAll();
    }
    
    public function calculateTotal($userId)
    {
        $items = $this->getUserCart($userId);
        $total = 0;
        foreach ($items as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}
