<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RestaurantModel;

class Restaurants extends BaseController
{
    protected $restaurantModel;

    public function __construct()
    {
        $this->restaurantModel = new RestaurantModel();
    }

    public function index()
    {
        $search = $this->request->getGet('search');
        
        if ($search) {
            $restaurants = $this->restaurantModel->like('name', $search)
                                     ->orLike('city', $search)
                                     ->paginate(10);
        } else {
            $restaurants = $this->restaurantModel->paginate(10);
        }

        $data = [
            'title' => 'Manage Restaurants',
            'restaurants' => $restaurants,
            'pager' => $this->restaurantModel->pager,
            'search' => $search
        ];

        return view('admin/restaurants/index', $data);
    }

    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            $imageFile = $this->request->getFile('image_file');
            $imagePath = $this->request->getPost('image_url');

            if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
                $newName = $imageFile->getRandomName();
                $imageFile->move(FCPATH . 'uploads/restaurants', $newName);
                $imagePath = 'uploads/restaurants/' . $newName;
            }

            $data = [
                'name' => $this->request->getPost('name'),
                'slug' => url_title($this->request->getPost('name'), '-', true),
                'description' => $this->request->getPost('description'),
                'image' => $imagePath,
                'cuisines' => $this->request->getPost('cuisines'),
                'delivery_time' => $this->request->getPost('delivery_time'),
                'price_for_two' => $this->request->getPost('price_for_two'),
                'address' => $this->request->getPost('address'),
                'city' => $this->request->getPost('city'),
                'phone' => $this->request->getPost('phone'),
                'is_active' => 1
            ];

            if ($this->restaurantModel->save($data)) {
                return redirect()->to('/admin/restaurants')->with('success', 'Restaurant created successfully');
            } else {
                return redirect()->back()->withInput()->with('errors', $this->restaurantModel->errors());
            }
        }

        return view('admin/restaurants/create', ['title' => 'Add Restaurant']);
    }

    public function edit($id)
    {
        $restaurant = $this->restaurantModel->find($id);
        
        if (!$restaurant) {
            return redirect()->to('/admin/restaurants')->with('error', 'Restaurant not found');
        }

        if ($this->request->getMethod() === 'post') {
            $imageFile = $this->request->getFile('image_file');
            $imagePath = $this->request->getPost('image_url');

            if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
                $newName = $imageFile->getRandomName();
                $imageFile->move(FCPATH . 'uploads/restaurants', $newName);
                $imagePath = 'uploads/restaurants/' . $newName;
            }

            $data = [
                'id' => $id,
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description'),
                'image' => $imagePath,
                'cuisines' => $this->request->getPost('cuisines'),
                'delivery_time' => $this->request->getPost('delivery_time'),
                'price_for_two' => $this->request->getPost('price_for_two'),
                'address' => $this->request->getPost('address'),
                'city' => $this->request->getPost('city'),
                'phone' => $this->request->getPost('phone'),
            ];

            if ($this->restaurantModel->save($data)) {
                return redirect()->to('/admin/restaurants')->with('success', 'Restaurant updated successfully');
            } else {
                return redirect()->back()->withInput()->with('errors', $this->restaurantModel->errors());
            }
        }

        return view('admin/restaurants/edit', ['title' => 'Edit Restaurant', 'restaurant' => $restaurant]);
    }

    public function toggleStatus($id)
    {
        $restaurant = $this->restaurantModel->find($id);
        
        if ($restaurant) {
            $newStatus = !$restaurant['is_active'];
            $this->restaurantModel->update($id, ['is_active' => $newStatus]);
            
            return redirect()->back()->with('success', 'Restaurant status updated successfully');
        }

        return redirect()->back()->with('error', 'Restaurant not found');
    }

    public function delete($id)
    {
        $this->restaurantModel->delete($id);
        return redirect()->back()->with('success', 'Restaurant deleted successfully');
    }
}
