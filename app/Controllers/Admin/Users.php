<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Users extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $search = $this->request->getGet('search');
        
        if ($search) {
            $users = $this->userModel->like('name', $search)
                                     ->orLike('email', $search)
                                     ->orLike('mobile', $search)
                                     ->paginate(10);
        } else {
            $users = $this->userModel->paginate(10);
        }

        $data = [
            'title' => 'Manage Users',
            'users' => $users,
            'pager' => $this->userModel->pager,
            'search' => $search
        ];

        return view('admin/users/index', $data);
    }

    public function toggleStatus($id)
    {
        $user = $this->userModel->find($id);
        
        if ($user) {
            $newStatus = !$user['is_active'];
            $this->userModel->update($id, ['is_active' => $newStatus]);
            
            return redirect()->back()->with('success', 'User status updated successfully');
        }

        return redirect()->back()->with('error', 'User not found');
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
        return redirect()->back()->with('success', 'User deleted successfully');
    }
}
