<?php

namespace App\Models;

use CodeIgniter\Model;

class FoodItemModel extends Model
{
    protected $table            = 'food_items';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'restaurant_id', 'name', 'description', 'price', 
        'image', 'is_veg', 'category', 'is_available'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getItemsByRestaurant($restaurantId)
    {
        return $this->where('restaurant_id', $restaurantId)
                    ->where('is_available', 1)
                    ->findAll();
    }
}
