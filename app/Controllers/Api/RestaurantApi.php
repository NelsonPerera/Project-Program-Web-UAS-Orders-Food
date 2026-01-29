<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\RestaurantModel;

class RestaurantApi extends ResourceController
{
    protected $modelName = 'App\Models\RestaurantModel';
    protected $format    = 'json';

    public function index()
    {
        $restaurants = $this->model->where('is_active', 1)->findAll();
        
        // Transform data if necessary to match frontend expectations
        $data = array_map(function($r) {
            return [
                'id' => $r['id'],
                'name' => $r['name'],
                'slug' => $r['slug'],
                'image' => strpos($r['image'], 'http') === 0 ? $r['image'] : base_url($r['image']),
                'cuisines' => $r['cuisines'],
                'rating' => (float)$r['rating'],
                'time' => $r['delivery_time'] . ' MINS',
                'price' => 'Rp ' . number_format($r['price_for_two'], 0, ',', '.') . ' FOR TWO',
                'offer' => 'FREE DELIVERY' // Placeholder or logic for offers
            ];
        }, $restaurants);

        return $this->respond($data);
    }

    public function menu($id = null)
    {
        $foodItemModel = new \App\Models\FoodItemModel();
        $items = $foodItemModel->getItemsByRestaurant($id);

        $data = array_map(function($item) {
            return [
                'id' => $item['id'],
                'name' => $item['name'],
                'description' => $item['description'],
                'price' => (float)$item['price'],
                'image' => strpos($item['image'], 'http') === 0 ? $item['image'] : base_url($item['image']),
                'is_veg' => (bool)$item['is_veg'],
                'category' => $item['category'],
                'restaurant_id' => $item['restaurant_id']
            ];
        }, $items);

        return $this->respond($data);
    }
}
