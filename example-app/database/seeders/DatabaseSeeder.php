<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create categories
        $categories = [
            ['name' => 'Electronics'],
            ['name' => 'Clothing'],
            ['name' => 'Home & Garden'],
            ['name' => 'Books'],
            ['name' => 'Sports & Outdoors'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create products
        $products = [
            // Electronics
            [
                'name' => 'Laptop Pro 15"',
                'price' => 1299.99,
                'description' => 'Powerful laptop with the latest processor, 16GB RAM, and 512GB SSD storage.',
                'category_id' => 1,
                'image_url' => 'https://via.placeholder.com/300x200?text=Laptop',
            ],
            [
                'name' => 'Smartphone X',
                'price' => 999.99,
                'description' => 'Latest smartphone with advanced camera system and all-day battery life.',
                'category_id' => 1,
                'image_url' => 'https://via.placeholder.com/300x200?text=Smartphone',
            ],
            [
                'name' => 'Wireless Headphones',
                'price' => 199.99,
                'description' => 'Premium noise-cancelling wireless headphones with 30-hour battery life.',
                'category_id' => 1,
                'image_url' => 'https://via.placeholder.com/300x200?text=Headphones',
            ],

            // Clothing
            [
                'name' => 'Classic T-Shirt',
                'price' => 24.99,
                'description' => 'Comfortable cotton t-shirt available in multiple colors.',
                'category_id' => 2,
                'image_url' => 'https://via.placeholder.com/300x200?text=T-Shirt',
            ],
            [
                'name' => 'Denim Jeans',
                'price' => 59.99,
                'description' => 'Classic denim jeans with a modern fit, made from premium materials.',
                'category_id' => 2,
                'image_url' => 'https://via.placeholder.com/300x200?text=Jeans',
            ],
            [
                'name' => 'Winter Jacket',
                'price' => 129.99,
                'description' => 'Warm winter jacket with water-resistant outer layer and insulated lining.',
                'category_id' => 2,
                'image_url' => 'https://via.placeholder.com/300x200?text=Jacket',
            ],

            // Home & Garden
            [
                'name' => 'Smart LED Bulb',
                'price' => 29.99,
                'description' => 'Wi-Fi connected LED bulb that can be controlled via smartphone app.',
                'category_id' => 3,
                'image_url' => 'https://via.placeholder.com/300x200?text=LED+Bulb',
            ],
            [
                'name' => 'Non-Stick Cookware Set',
                'price' => 149.99,
                'description' => 'Complete set of non-stick cookware, including pans, pots, and utensils.',
                'category_id' => 3,
                'image_url' => 'https://via.placeholder.com/300x200?text=Cookware',
            ],
            [
                'name' => 'Indoor Plant Set',
                'price' => 49.99,
                'description' => 'Set of three easy-to-maintain indoor plants with decorative pots.',
                'category_id' => 3,
                'image_url' => 'https://via.placeholder.com/300x200?text=Plants',
            ],

            // Books
            [
                'name' => 'Bestselling Fiction Novel',
                'price' => 18.99,
                'description' => 'The latest bestselling novel that\'s captivating readers worldwide.',
                'category_id' => 4,
                'image_url' => 'https://via.placeholder.com/300x200?text=Fiction+Book',
            ],
            [
                'name' => 'Cooking Encyclopedia',
                'price' => 35.99,
                'description' => 'Comprehensive cookbook with hundreds of recipes from around the world.',
                'category_id' => 4,
                'image_url' => 'https://via.placeholder.com/300x200?text=Cookbook',
            ],
            [
                'name' => 'Photography Guide',
                'price' => 24.99,
                'description' => 'In-depth guide to improving your photography skills for beginners and intermediates.',
                'category_id' => 4,
                'image_url' => 'https://via.placeholder.com/300x200?text=Photography+Book',
            ],

            // Sports & Outdoors
            [
                'name' => 'Yoga Mat',
                'price' => 29.99,
                'description' => 'Premium non-slip yoga mat with carrying strap, perfect for all types of yoga.',
                'category_id' => 5,
                'image_url' => 'https://via.placeholder.com/300x200?text=Yoga+Mat',
            ],
            [
                'name' => 'Mountain Bike',
                'price' => 649.99,
                'description' => 'Durable mountain bike with front suspension and 21-speed gear system.',
                'category_id' => 5,
                'image_url' => 'https://via.placeholder.com/300x200?text=Mountain+Bike',
            ],
            [
                'name' => 'Camping Tent',
                'price' => 129.99,
                'description' => 'Waterproof 4-person tent, easy to set up and perfect for family camping trips.',
                'category_id' => 5,
                'image_url' => 'https://via.placeholder.com/300x200?text=Camping+Tent',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
