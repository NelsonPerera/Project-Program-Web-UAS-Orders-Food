<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\OrderModel;

class Orders extends BaseController
{
    protected $orderModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
    }

    public function index()
    {
        $status = $this->request->getGet('status');
        
        if ($status) {
            $orders = $this->orderModel->where('status', $status)
                                       ->orderBy('created_at', 'DESC')
                                       ->paginate(10);
        } else {
            $orders = $this->orderModel->orderBy('created_at', 'DESC')->paginate(10);
        }

        $data = [
            'title' => 'Manage Orders',
            'orders' => $orders,
            'pager' => $this->orderModel->pager,
            'status' => $status
        ];

        return view('admin/orders/index', $data);
    }
    
    public function view($id)
    {
        // Placeholder for order details view
        $order = $this->orderModel->find($id);
        if (!$order) {
            return redirect()->to('/admin/orders')->with('error', 'Order not found');
        }
        
        return view('admin/orders/view', ['order' => $order, 'title' => 'Order Details']);
    }

    public function updateStatus()
    {
        $id = $this->request->getPost('order_id');
        $status = $this->request->getPost('status');
        
        if ($id && $status) {
            $this->orderModel->update($id, ['status' => $status]);
            return redirect()->back()->with('success', 'Order status updated');
        }
        
        return redirect()->back()->with('error', 'Failed to update status');
    }
}
