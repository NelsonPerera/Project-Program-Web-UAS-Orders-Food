<?php

namespace App\Models;

use CodeIgniter\Model;

class RestaurantModel extends Model
{
    protected $table            = 'restaurants';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name', 'slug', 'description', 'image', 'cuisines', 
        'rating', 'delivery_time', 'price_for_two', 'address', 
        'city', 'phone', 'is_active', 'owner_id'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'name' => 'required|min_length[3]|max_length[150]',
        'slug' => 'required|is_unique[restaurants.slug,id,{id}]',
        'city' => 'required',
    ];

    public function getActiveRestaurants()
    {
        return $this->where('is_active', 1)->findAll();
    }

    public function search($keyword)
    {
        return $this->groupStart()
                    ->like('name', $keyword)
                    ->orLike('cuisines', $keyword)
                    ->orLike('city', $keyword)
                    ->groupEnd()
                    ->where('is_active', 1)
                    ->findAll();
    }
}
