<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class IndonesianFoodItemsSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        $restaurants = $db->table('restaurants')->get()->getResultArray();
        
        $foodItems = [];
        
        foreach ($restaurants as $resto) {
            // Add a variety of 5-8 items per restaurant to reach 20+ total
            $items = [
                [
                    'name' => 'Nasi Goreng Spesial',
                    'description' => 'Indonesian fried rice with egg, chicken, and crackers.',
                    'price' => 28000,
                    'image' => 'assets/food/nasi_goreng.png',
                    'category' => 'Main Course', 'is_veg' => 0
                ],
                [
                    'name' => 'Sate Ayam (10 Tusuk)',
                    'description' => 'Grilled chicken skewers with rich peanut sauce.',
                    'price' => 35000,
                    'image' => 'https://images.pexels.com/photos/12737657/pexels-photo-12737657.jpeg?auto=compress&cs=tinysrgb&w=300',
                    'category' => 'Grill', 'is_veg' => 0
                ],
                [
                    'name' => 'Gado-Gado Jakarta',
                    'description' => 'Mixed vegetables with peanut sauce dressing.',
                    'price' => 22000,
                    'image' => 'assets/food/gado_gado.png',
                    'category' => 'Salad', 'is_veg' => 1
                ],
                [
                    'name' => 'Es Teh Manis',
                    'description' => 'Chilled Indonesian sweet jasmine tea.',
                    'price' => 8000,
                    'image' => 'https://images.pexels.com/photos/2612250/pexels-photo-2612250.jpeg?auto=compress&cs=tinysrgb&w=300',
                    'category' => 'Drink', 'is_veg' => 1
                ],
                [
                    'name' => 'Jus Alpukat',
                    'description' => 'Creamy avocado juice with chocolate condensed milk.',
                    'price' => 18000,
                    'image' => 'https://images.pexels.com/photos/2839446/pexels-photo-2839446.jpeg?auto=compress&cs=tinysrgb&w=300',
                    'category' => 'Drink', 'is_veg' => 1
                ],
            ];

            // Add specific items based on restaurant type
            if ($resto['slug'] === 'bakso-boedjangan') {
                $items[] = [
                    'name' => 'Bakso Pentol Besar',
                    'description' => 'Extra large beef ball with spicy center.',
                    'price' => 32000,
                    'image' => 'https://images.pexels.com/photos/12044810/pexels-photo-12044810.jpeg?auto=compress&cs=tinysrgb&w=300',
                    'category' => 'Main Course', 'is_veg' => 0
                ];
            } else if ($resto['slug'] === 'rendang-simpang-raya') {
                $items[] = [
                    'name' => 'Rendang Daging Sapi',
                    'description' => 'Slow-cooked beef in coconut milk and spices.',
                    'price' => 45000,
                    'image' => 'https://images.pexels.com/photos/2232433/pexels-photo-2232433.jpeg?auto=compress&cs=tinysrgb&w=300',
                    'category' => 'Main Course', 'is_veg' => 0
                ];
            }

            foreach ($items as $item) {
                $foodItems[] = array_merge($item, [
                    'restaurant_id' => $resto['id'],
                    'is_available' => 1
                ]);
            }
        }

        $db->query('SET FOREIGN_KEY_CHECKS=0');
        $db->table('food_items')->truncate();
        $db->query('SET FOREIGN_KEY_CHECKS=1');
        $db->table('food_items')->insertBatch($foodItems);
    }
}
