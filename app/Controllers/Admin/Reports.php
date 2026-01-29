<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Reports extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Overview', // Keep title consistent with dashboard if unified
            'stats' => $this->getStats()
        ];
        
        return view('admin/dashboard', $data);
    }

    private function getStats()
    {
        $orderModel = new \App\Models\OrderModel();
        $userModel = new \App\Models\UserModel();
        $restaurantModel = new \App\Models\RestaurantModel();

        $totalRevenue = $orderModel->selectSum('total_amount')->get()->getRow()->total_amount ?? 0;

        return [
            'total_orders' => $orderModel->countAllResults(),
            'total_revenue' => $totalRevenue,
            'total_users' => $userModel->countAllResults(),
            'total_restaurants' => $restaurantModel->countAllResults(),
            'recent_orders' => $orderModel->select('orders.*, restaurants.name as restaurant_name')
                                          ->join('restaurants', 'restaurants.id = orders.restaurant_id', 'left')
                                          ->orderBy('orders.created_at', 'DESC')
                                          ->limit(5)
                                          ->findAll()
        ];
    }
}
