<?php

namespace App\Models;

use CodeIgniter\Model;

class FavoriteModel extends Model
{
    protected $table            = 'favorites';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'user_id', 'restaurant_id'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = ''; // No updated_at

    public function getUserFavorites($userId)
    {
        return $this->select('favorites.*, restaurants.name, restaurants.image, restaurants.slug, restaurants.rating')
                    ->join('restaurants', 'restaurants.id = favorites.restaurant_id')
                    ->where('favorites.user_id', $userId)
                    ->findAll();
    }
}
