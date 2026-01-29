<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('search', 'Home::search');
$routes->get('menu/(:num)', 'Home::menu/$1');
$routes->get('cart', 'Home::cart');
$routes->get('profile', 'Home::profile');
$routes->get('order-success', 'Home::orderSuccess');

// API Routes
$routes->group('api', function($routes) {
    $routes->get('restaurants', 'Api\RestaurantApi::index');
    $routes->get('restaurants/(:num)/menu', 'Api\RestaurantApi::menu/$1');
    $routes->post('orders', 'Api\OrderApi::create');
});

// Auth Routes
$routes->match(['GET', 'POST'], 'auth/login', 'Auth::login');
$routes->match(['GET', 'POST'], 'auth/register', 'Auth::register');
$routes->get('auth/logout', 'Auth::logout');
$routes->get('auth/check', 'Auth::check');

// Admin Routes (Protected by auth and admin filters)
$routes->group('admin', ['filter' => ['auth', 'admin']], function($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
    
    // Restaurants
    $routes->get('restaurants', 'Admin\Restaurants::index');
    $routes->match(['GET', 'POST'], 'restaurants/create', 'Admin\Restaurants::create');
    $routes->match(['GET', 'POST'], 'restaurants/edit/(:num)', 'Admin\Restaurants::edit/$1');
    $routes->get('restaurants/delete/(:num)', 'Admin\Restaurants::delete/$1');
    $routes->get('restaurants/toggle/(:num)', 'Admin\Restaurants::toggleStatus/$1');

    // Food Items
    $routes->get('food-items', 'Admin\FoodItems::index');
    $routes->match(['GET', 'POST'], 'food-items/create', 'Admin\FoodItems::create');
    $routes->match(['GET', 'POST'], 'food-items/edit/(:num)', 'Admin\FoodItems::edit/$1');
    $routes->get('food-items/delete/(:num)', 'Admin\FoodItems::delete/$1');

    // Orders
    $routes->get('orders', 'Admin\Orders::index');
    $routes->get('orders/view/(:num)', 'Admin\Orders::view/$1');
    $routes->post('orders/update-status', 'Admin\Orders::updateStatus');

    // Users
    $routes->get('users', 'Admin\Users::index');
    $routes->get('users/toggle/(:num)', 'Admin\Users::toggleStatus/$1');
    $routes->get('users/delete/(:num)', 'Admin\Users::delete/$1');
    
    // Reports
    $routes->get('reports', 'Admin\Reports::index');
});

// API Routes (to be expanded)
$routes->group('api', function($routes) {
    $routes->get('restaurants', 'Api\RestaurantApi::index');
    $routes->get('restaurants/(:num)/menu', 'Api\RestaurantApi::menu/$1');
});
