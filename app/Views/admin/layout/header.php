<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Panel' ?> - FOOD Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            color: #fff;
        }
        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
        }
        .sidebar a:hover, .sidebar a.active {
            color: #fff;
            background-color: #495057;
        }
        .content {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3" style="width: 250px;">
            <h4 class="mb-4 text-center">FOOD Admin</h4>
            <ul class="list-unstyled">
                <li><a href="/admin/dashboard" class="<?= url_is('admin/dashboard') ? 'active' : '' ?>"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a></li>
                <li><a href="/admin/restaurants" class="<?= url_is('admin/restaurants') ? 'active' : '' ?>"><i class="fas fa-utensils me-2"></i> Restaurants</a></li>
                <li><a href="/admin/food-items" class="<?= url_is('admin/food-items') ? 'active' : '' ?>"><i class="fas fa-hamburger me-2"></i> Menu Items</a></li>
                <li><a href="/admin/orders" class="<?= url_is('admin/orders') ? 'active' : '' ?>"><i class="fas fa-shopping-cart me-2"></i> Orders</a></li>
                <li><a href="/admin/users" class="<?= url_is('admin/users') ? 'active' : '' ?>"><i class="fas fa-users me-2"></i> Users</a></li>
                <li><a href="/admin/reports" class="<?= url_is('admin/reports') ? 'active' : '' ?>"><i class="fas fa-chart-line me-2"></i> Reports</a></li>
                <li class="mt-4 border-top pt-2"><a href="/auth/logout"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
            </ul>
        </div>
        
        <!-- Main Content -->
        <div class="flex-grow-1 bg-light">
            <!-- Navbar -->
            <nav class="navbar navbar-light bg-white shadow-sm px-4">
                <button class="btn btn-link d-md-none" id="sidebarToggle"><i class="fas fa-bars"></i></button>
                <div class="ms-auto">
                    <span class="me-2">Welcome, <?= session()->get('name') ?? 'Admin' ?></span>
                    <img src="https://ui-avatars.com/api/?name=<?= session()->get('name') ?? 'Admin' ?>&background=random" class="rounded-circle" width="32" height="32">
                </div>
            </nav>
            
            <div class="content">
