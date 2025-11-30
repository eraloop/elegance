<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure categories exist
        $categories = [
            'Wigs' => 'Premium human hair wigs and synthetic options.',
            'Hair Care' => 'Shampoos, conditioners, and treatments for all hair types.',
            'Accessories' => 'Combs, brushes, clips, and other styling tools.',
            'Bundles' => 'Luxury hair bundles in various textures and lengths.',
        ];

        foreach ($categories as $name => $description) {
            Category::firstOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'description' => $description,
                    'is_active' => true,
                    'is_featured' => true,
                ]
            );
        }

        $wigsCat = Category::where('slug', 'wigs')->first();
        $hairCareCat = Category::where('slug', 'hair-care')->first();
        $accessoriesCat = Category::where('slug', 'accessories')->first();
        $bundlesCat = Category::where('slug', 'bundles')->first();

        $products = [
            [
                'name' => 'Luxury Body Wave Wig',
                'category_id' => $wigsCat->id,
                'price' => 250.00,
                'sale_price' => 199.99,
                'sku' => 'WIG-BW-24',
                'brand' => 'Elegance Premium',
                'weight' => '0.3 kg',
                'dimensions' => '30x20x10 cm',
                'material' => '100% Human Hair',
                'texture' => 'Body Wave',
                'color' => 'Natural Black',
                'is_new' => true,
                'short_description' => '100% Human Hair Body Wave Wig, 24 inches.',
                'description' => "Experience the ultimate in luxury with our Body Wave Wig. Made from 100% human hair, this wig offers a natural look and feel. The body wave texture adds volume and movement, perfect for any occasion. \n\nFeatures:\n- 100% Human Hair\n- 24 Inches Length\n- Natural Black Color\n- Pre-plucked Hairline",
                'in_stock' => true,
                'stock_quantity' => 10,
            ],
            [
                'name' => 'Silky Straight Bob Wig',
                'category_id' => $wigsCat->id,
                'price' => 150.00,
                'sale_price' => null,
                'sku' => 'WIG-ST-12',
                'brand' => 'Elegance Essentials',
                'weight' => '0.2 kg',
                'dimensions' => '25x15x8 cm',
                'material' => 'High-Quality Synthetic',
                'texture' => 'Straight',
                'color' => '1B',
                'is_new' => false,
                'short_description' => 'Chic and timeless straight bob wig, 12 inches.',
                'description' => "Achieve a sleek and sophisticated look with our Silky Straight Bob Wig. This 12-inch wig is perfect for a modern, polished appearance. Easy to style and maintain.\n\nFeatures:\n- High-Quality Synthetic Fiber\n- Heat Resistant\n- Adjustable Cap Size",
                'in_stock' => true,
                'stock_quantity' => 15,
            ],
            [
                'name' => 'Deep Wave Bundles (3pcs)',
                'category_id' => $bundlesCat->id,
                'price' => 180.00,
                'sale_price' => 165.00,
                'sku' => 'BUN-DW-3PC',
                'brand' => 'Elegance Virgin',
                'weight' => '0.3 kg',
                'dimensions' => '30x10x5 cm',
                'material' => 'Virgin Human Hair',
                'texture' => 'Deep Wave',
                'color' => 'Natural Black',
                'is_new' => true,
                'short_description' => 'Three bundles of deep wave virgin hair.',
                'description' => "Get the full, voluminous look you desire with our Deep Wave Bundles. This set includes three bundles of premium virgin hair that can be dyed, curled, and straightened.\n\nLengths: 18\", 20\", 22\"",
                'in_stock' => true,
                'stock_quantity' => 20,
            ],
            [
                'name' => 'Argan Oil Shampoo',
                'category_id' => $hairCareCat->id,
                'price' => 25.00,
                'sale_price' => null,
                'sku' => 'HC-SH-ARGAN',
                'brand' => 'Elegance Care',
                'weight' => '0.5 kg',
                'dimensions' => '8x8x20 cm',
                'material' => 'Liquid',
                'texture' => 'Smooth',
                'color' => 'N/A',
                'is_new' => false,
                'short_description' => 'Nourishing shampoo infused with Argan Oil.',
                'description' => "Revitalize your hair with our Argan Oil Shampoo. Rich in Vitamin E and essential fatty acids, this shampoo hydrates and strengthens your hair, leaving it soft and shiny.",
                'in_stock' => true,
                'stock_quantity' => 50,
            ],
            [
                'name' => 'Detangling Brush',
                'category_id' => $accessoriesCat->id,
                'price' => 15.00,
                'sale_price' => 12.00,
                'sku' => 'ACC-BR-DET',
                'brand' => 'Elegance Tools',
                'weight' => '0.1 kg',
                'dimensions' => '20x8x4 cm',
                'material' => 'Plastic',
                'texture' => 'N/A',
                'color' => 'Pink',
                'is_new' => false,
                'short_description' => 'Gentle detangling brush for wet or dry hair.',
                'description' => "Say goodbye to knots and tangles with our Detangling Brush. Designed to glide through hair without pulling or breaking, making it perfect for all hair types.",
                'in_stock' => true,
                'stock_quantity' => 100,
            ],
            [
                'name' => 'Keratin Hair Mask',
                'category_id' => $hairCareCat->id,
                'price' => 35.00,
                'sale_price' => null,
                'sku' => 'HC-MSK-KER',
                'brand' => 'Elegance Care',
                'weight' => '0.3 kg',
                'dimensions' => '10x10x8 cm',
                'material' => 'Cream',
                'texture' => 'Creamy',
                'color' => 'White',
                'is_new' => true,
                'short_description' => 'Intensive repair mask for damaged hair.',
                'description' => "Restore your hair's health with our Keratin Hair Mask. This deep conditioning treatment repairs damage, reduces frizz, and improves elasticity.",
                'in_stock' => true,
                'stock_quantity' => 30,
            ],
            [
                'name' => 'HD Lace Frontal 13x4',
                'category_id' => $bundlesCat->id,
                'price' => 120.00,
                'sale_price' => null,
                'sku' => 'BUN-LF-HD',
                'brand' => 'Elegance Virgin',
                'weight' => '0.1 kg',
                'dimensions' => '15x10x2 cm',
                'material' => 'HD Lace',
                'texture' => 'Straight',
                'color' => 'Transparent',
                'is_new' => false,
                'short_description' => 'Undetectable HD lace frontal for a seamless melt.',
                'description' => "Achieve a flawless hairline with our HD Lace Frontal. The ultra-thin lace melts into your skin for an undetectable look. 13x4 size allows for versatile parting.",
                'in_stock' => false,
                'stock_quantity' => 0,
            ],
            [
                'name' => 'Satin Bonnet',
                'category_id' => $accessoriesCat->id,
                'price' => 10.00,
                'sale_price' => null,
                'sku' => 'ACC-BON-SAT',
                'brand' => 'Elegance Accessories',
                'weight' => '0.05 kg',
                'dimensions' => '15x15x1 cm',
                'material' => 'Satin',
                'texture' => 'Smooth',
                'color' => 'Black',
                'is_new' => false,
                'short_description' => 'Protect your hair while you sleep.',
                'description' => "Keep your hair smooth and frizz-free with our Satin Bonnet. The soft satin material prevents breakage and retains moisture while you sleep.",
                'in_stock' => true,
                'stock_quantity' => 200,
            ],
        ];

        foreach ($products as $productData) {
            Product::firstOrCreate(
                ['name' => $productData['name']],
                array_merge($productData, ['slug' => Str::slug($productData['name'])])
            );
        }
    }
}
