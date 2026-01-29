<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('home_view');
    }

    public function search(): string
    {
        return view('search_view');
    }

    public function menu($id): string
    {
        $restaurantModel = new \App\Models\RestaurantModel();
        $restaurant = $restaurantModel->find($id);
        return view('menu_view', ['restaurant' => $restaurant]);
    }

    public function cart(): string
    {
        return view('cart_view');
    }

    public function profile(): string
    {
        return view('profile_view');
    }

    public function orderSuccess(): string
    {
        return view('order_success');
    }
}
