<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FoodItemModel;
use App\Models\RestaurantModel;

class FoodItems extends BaseController
{
    protected $foodItemModel;
    protected $restaurantModel;

    public function __construct()
    {
        $this->foodItemModel = new FoodItemModel();
        $this->restaurantModel = new RestaurantModel();
    }

    public function index()
    {
        $search = $this->request->getGet('search');
        $restaurantId = $this->request->getGet('restaurant_id');
        
        $query = $this->foodItemModel->select('food_items.*, restaurants.name as restaurant_name')
                                     ->join('restaurants', 'restaurants.id = food_items.restaurant_id');

        if ($search) {
            $query->like('food_items.name', $search);
        }

        if ($restaurantId) {
            $query->where('restaurant_id', $restaurantId);
        }

        $foodItems = $query->paginate(10);

        $data = [
            'title' => 'Manage Food Items',
            'foodItems' => $foodItems,
            'pager' => $this->foodItemModel->pager,
            'search' => $search,
            'restaurantId' => $restaurantId,
            'restaurants' => $this->restaurantModel->findAll() // For filter dropdown
        ];

        return view('admin/food_items/index', $data);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            $imageFile = $this->request->getFile('image_file');
            $imagePath = $this->request->getPost('image_url');

            if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
                $newName = $imageFile->getRandomName();
                $imageFile->move(FCPATH . 'uploads/food', $newName);
                $imagePath = 'uploads/food/' . $newName;
            }

            $data = [
                'restaurant_id' => $this->request->getPost('restaurant_id'),
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description'),
                'price' => $this->request->getPost('price'),
                'image' => $imagePath,
                'category' => $this->request->getPost('category'),
                'is_veg' => $this->request->getPost('is_veg'),
                'is_available' => 1
            ];

            if ($this->foodItemModel->save($data)) {
                return redirect()->to('/admin/food-items')->with('success', 'Food Item created successfully');
            } else {
                return redirect()->back()->withInput()->with('errors', $this->foodItemModel->errors());
            }
        }

        return view('admin/food_items/create', [
            'title' => 'Add Food Item',
            'restaurants' => $this->restaurantModel->findAll()
        ]);
    }

    public function edit($id)
    {
        $foodItem = $this->foodItemModel->find($id);
        
        if (!$foodItem) {
            return redirect()->to('/admin/food-items')->with('error', 'Food Item not found');
        }

        if ($this->request->getMethod() === 'post') {
            $imageFile = $this->request->getFile('image_file');
            $imagePath = $this->request->getPost('image_url');

            if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
                $newName = $imageFile->getRandomName();
                $imageFile->move(FCPATH . 'uploads/food', $newName);
                $imagePath = 'uploads/food/' . $newName;
            }

            $data = [
                'id' => $id,
                'restaurant_id' => $this->request->getPost('restaurant_id'),
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description'),
                'price' => $this->request->getPost('price'),
                'image' => $imagePath,
                'category' => $this->request->getPost('category'),
                'is_veg' => $this->request->getPost('is_veg'),
                'is_available' => $this->request->getPost('is_available')
            ];

            if ($this->foodItemModel->save($data)) {
                return redirect()->to('/admin/food-items')->with('success', 'Food Item updated successfully');
            } else {
                return redirect()->back()->withInput()->with('errors', $this->foodItemModel->errors());
            }
        }

        return view('admin/food_items/edit', [
            'title' => 'Edit Food Item', 
            'foodItem' => $foodItem,
            'restaurants' => $this->restaurantModel->findAll()
        ]);
    }

    public function delete($id)
    {
        $this->foodItemModel->delete($id);
        return redirect()->back()->with('success', 'Food Item deleted successfully');
    }
}
