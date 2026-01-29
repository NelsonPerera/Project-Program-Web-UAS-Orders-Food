<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class IndonesianRestaurantsSeeder extends Seeder
{
    public function run()
    {
        $restaurants = [
            [
                'name' => 'Ayam Geprek Bensu',
                'slug' => 'ayam-geprek-bensu',
                'description' => 'The most popular Ayam Geprek in Indonesia. Spicy, crispy, and delicious.',
                'image' => 'assets/images/restaurants/ayam_geprek.png',
                'cuisines' => 'Indonesian, Fast Food, Chicken',
                'rating' => 4.5,
                'delivery_time' => 30,
                'price_for_two' => 45000.00,
                'address' => 'Jl. Tebet Raya No. 123, Jakarta Selatan',
                'city' => 'Jakarta',
                'is_active' => 1
            ],
            [
                'name' => 'Bakso Boedjangan',
                'slug' => 'bakso-boedjangan',
                'description' => 'Modern twist on traditional Indonesian meatballs. Various fillings and broth options.',
                'image' => 'assets/images/restaurants/bakso.png',
                'cuisines' => 'Indonesian, Meatballs, Soup',
                'rating' => 4.6,
                'delivery_time' => 25,
                'price_for_two' => 50000.00,
                'address' => 'Jl. Braga No. 56, Bandung',
                'city' => 'Bandung',
                'is_active' => 1
            ],
            [
                'name' => 'Sate Khas Senayan',
                'slug' => 'sate-khas-senayan',
                'description' => 'Premium Indonesian satay and traditional cuisine with authentic flavors.',
                'image' => 'assets/images/restaurants/sate.png',
                'cuisines' => 'Indonesian, Satay, Grill',
                'rating' => 4.7,
                'delivery_time' => 40,
                'price_for_two' => 150000.00,
                'address' => 'Senayan City Mall, Jakarta Pusat',
                'city' => 'Jakarta',
                'is_active' => 1
            ],
            [
                'name' => 'Nasi Goreng Kambing Kebon Sirih',
                'slug' => 'nasgor-kambing-kebon-sirih',
                'description' => 'Legendary Lamb Fried Rice since 1958. A must-try Jakarta street food.',
                'image' => 'assets/images/restaurants/nasi_goreng.png',
                'cuisines' => 'Indonesian, Fried Rice',
                'rating' => 4.8,
                'delivery_time' => 35,
                'price_for_two' => 65000.00,
                'address' => 'Jl. Kebon Sirih, Jakarta Pusat',
                'city' => 'Jakarta',
                'is_active' => 1
            ],
            [
                'name' => 'Bebek Bengil (Dirty Duck)',
                'slug' => 'bebek-bengil',
                'description' => 'Famous crispy duck from Ubud, Bali. Served with sambal matah.',
                'image' => 'assets/images/restaurants/bebek_crispy.png',
                'cuisines' => 'Indonesian, Duck, Balinese',
                'rating' => 4.9,
                'delivery_time' => 45,
                'price_for_two' => 180000.00,
                'address' => 'Ubud, Bali (Jakarta Branch)',
                'city' => 'Jakarta',
                'is_active' => 1
            ],
            [
                'name' => 'Martabak San Francisco',
                'slug' => 'martabak-san-francisco',
                'description' => 'The pioneer of premium Martabak. Sweet and savory pancakes.',
                'image' => 'assets/images/restaurants/martabak.png',
                'cuisines' => 'Dessert, Indonesian, Street Food',
                'rating' => 4.7,
                'delivery_time' => 20,
                'price_for_two' => 75000.00,
                'address' => 'Jl. Burangrang, Bandung',
                'city' => 'Bandung',
                'is_active' => 1
            ],
            [
                'name' => 'Soto Betawi H. Ma\'ruf',
                'slug' => 'soto-betawi-h-maruf',
                'description' => 'Authentic Jakarta beef soup with coconut milk broth.',
                'image' => 'https://images.pexels.com/photos/12044810/pexels-photo-12044810.jpeg?auto=compress&cs=tinysrgb&w=800',
                'cuisines' => 'Indonesian, Soup',
                'rating' => 4.6,
                'delivery_time' => 30,
                'price_for_two' => 60000.00,
                'address' => 'Taman Ismail Marzuki, Jakarta',
                'city' => 'Jakarta',
                'is_active' => 1
            ],
            [
                'name' => 'Warung Leko',
                'slug' => 'warung-leko',
                'description' => 'Specialist in Igac Penyet (Smashed Ribs). Spicy and satisfying.',
                'image' => 'assets/images/restaurants/iga_penyet.png',
                'cuisines' => 'Indonesian, Ribs, Spicy',
                'rating' => 4.5,
                'delivery_time' => 35,
                'price_for_two' => 90000.00,
                'address' => 'Surabaya Town Square, Surabaya',
                'city' => 'Surabaya',
                'is_active' => 1
            ],
            [
                'name' => 'Rawon Setan',
                'slug' => 'rawon-setan',
                'description' => 'Famous black beef soup from Surabaya. Known for its rich flavor.',
                'image' => 'https://images.pexels.com/photos/11075723/pexels-photo-11075723.jpeg?auto=compress&cs=tinysrgb&w=800',
                'cuisines' => 'Indonesian, Soup',
                'rating' => 4.7,
                'delivery_time' => 25,
                'price_for_two' => 55000.00,
                'address' => 'Jl. Embong Malang, Surabaya',
                'city' => 'Surabaya',
                'is_active' => 1
            ],
            [
                'name' => 'Mie Gacoan',
                'slug' => 'mie-gacoan',
                'description' => 'Viral spicy noodles with affordable prices. Favorite among students.',
                'image' => 'https://images.pexels.com/photos/2323391/pexels-photo-2323391.jpeg?auto=compress&cs=tinysrgb&w=800',
                'cuisines' => 'Noodles, Spicy, Dimsum',
                'rating' => 4.4,
                'delivery_time' => 40,
                'price_for_two' => 30000.00,
                'address' => 'Many locations',
                'city' => 'Jakarta',
                'is_active' => 1
            ]
        ];

        // $this->db->table('restaurants')->truncate();
        $this->db->table('restaurants')->insertBatch($restaurants);
    }
}
