<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table            = 'reviews';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'user_id', 'restaurant_id', 'order_id', 'rating', 'comment'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = ''; // No updated_at for reviews

    public function getRestaurantReviews($restaurantId)
    {
        return $this->select('reviews.*, users.name as user_name, users.profile_image')
                    ->join('users', 'users.id = reviews.user_id')
                    ->where('restaurant_id', $restaurantId)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }
}
