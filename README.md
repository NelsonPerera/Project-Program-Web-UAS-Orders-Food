# Food Delivery App - Jakarta Edition

A high-end, responsive food ordering platform built with **CodeIgniter 4**. This application features a dynamic restaurant discovery system, interactive food menus, a seamless cart experience, and a comprehensive Admin Dashboard for order management.

## Features

- **Dynamic Homepage**: High-end design with animated carousels and restaurant listings.
- **Smart Search**: Find restaurants by name or cuisine with real-time filtering.
- **Interactive Menu**: Browse food items with category tags and "Add to Cart" functionality.
- **Premium Order Flow**: Smooth checkout process with a dedicated animation-rich success page.
- **Admin Dashboard**: 
    - Real-time statistics (Revenue, Orders, Users).
    - Manage Restaurants & Food Items.
    - Track and process customer orders.
- **Authentication**: Secure Login/Registration system for both customers and admins.

## Tech Stack

- **Framework**: CodeIgniter 4 (PHP 8.1+)
- **Database**: MySQL

## Installation & Setup

### 1. Prerequisites
- XAMPP/WAMP or equivalent (PHP 8.1+, MySQL)
- Composer installed

### 2. Clone the Repository
```bash
git clone https://github.com/yourusername/food-order-website.git
cd food-order-website
```

### 3. Install Dependencies
```bash
composer install
```

### 4. Database Configuration
1. Create a database named `food_ordering_db` in your MySQL server.
2. Copy `env` to `.env`:
   ```bash
   cp env .env
   ```
3. Update `.env` with your database credentials:
   ```env
   database.default.hostname = localhost
   database.default.database = food_ordering_db
   database.default.username = root
   database.default.password = 
   ```

### 5. Run Migrations & Seeders
Populate the database with tables and sample data:
```bash
php spark migrate
php spark db:seed AdminUserSeeder
php spark db:seed IndonesianRestaurantsSeeder
php spark db:seed IndonesianFoodItemsSeeder
```

### 6. Start the Server
```bash
php spark serve --port 8081
```
Visit `http://localhost:8081` in your browser.

## Admin Credentials
- **Email**: `admin@foodapp.com`
- **Password**: `admin123`
- **Dashboard**: `http://localhost:8081/admin/dashboard`
## sample of our project screenshot

## Project Screenshots

### Homepage
!(screenshots/page-0001.jpg)

### Restaurant Discovery
## Project Screenshots

### Homepage
### Restaurant Discovery
![Restaurant Discovery 1](screenshots/Github%20link_page-0001.jpg)
![Restaurant Discovery 2](screenshots/Github%20link_page-0002.jpg)
![Restaurant Discovery 3](screenshots/Github%20link_page-0003.jpg)
![Restaurant Discovery 4](screenshots/Github%20link_page-0004.jpg)


## License
Distributed under the MIT License.
