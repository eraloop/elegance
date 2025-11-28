<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $services = [
      [
        "name" => "Haircut and Styling",
        "slug" => "haircut-and-styling",
        "category_slug" => "hair-care",
        "short_description" => "Professional haircuts and stylish hairdos for every occasion.",
        "description" => "Offering expert haircuts tailored to your face shape and desired style, along with blow-dry and styling services.",
        "responsibilities" => ["Cutting", "Blow-drying", "Styling", "Customer consultation"],
        "gallery" => ["image1.jpg", "image2.jpg"],
        "thumbnail" => "thumbnail1.jpg",
        "price_min" => 30.00,
        "price_max" => 80.00,
        "duration" => 45,
        "preparation_tips" => "Arrive with clean, dry hair for best results.",
        "is_featured" => true,
        "is_popular" => true,
        "is_active" => true,
        "is_promotion" => true,
        "is_gift" => true,
        "seo_title" => "Professional Haircuts and Styling",
        "seo_description" => "Get the perfect haircut and styling tailored to your preferences."
      ],
      [
        "name" => "Manicure",
        "slug" => "manicure",
        "category_slug" => "nail-care",
        "short_description" => "Pamper your hands with a luxurious manicure.",
        "description" => "Our manicure includes nail trimming, shaping, cuticle care, and polish application, leaving your hands looking elegant and refreshed.",
        "responsibilities" => ["Nail trimming", "Shaping", "Cuticle care", "Polish application"],
        "gallery" => ["image3.jpg", "image4.jpg"],
        "thumbnail" => "thumbnail2.jpg",
        "price_min" => 20.00,
        "price_max" => 50.00,
        "duration" => 30,
        "preparation_tips" => "Remove any old polish before your appointment.",
        "is_featured" => false,
        "is_popular" => true,
        "is_active" => true,
        "is_promotion" => true,
        "is_gift" => true,
        "seo_title" => "Relaxing Manicure Services",
        "seo_description" => "Treat your hands to a relaxing manicure and enjoy beautifully groomed nails."
      ],
      [
        "name" => "Pedicure",
        "slug" => "pedicure",
        "category_slug" => "nail-care",
        "short_description" => "Refresh your feet with a rejuvenating pedicure.",
        "description" => "A thorough treatment for your feet, including nail trimming, shaping, exfoliation, and polish application.",
        "responsibilities" => ["Nail trimming", "Shaping", "Exfoliation", "Polish application"],
        "gallery" => ["image5.jpg", "image6.jpg"],
        "thumbnail" => "thumbnail3.jpg",
        "price_min" => 30.00,
        "price_max" => 70.00,
        "duration" => 45,
        "preparation_tips" => "Arrive with clean feet for best results.",
        "is_featured" => false,
        "is_popular" => true,
        "is_active" => true,
        "is_promotion" => true,
        "is_gift" => true,
        "seo_title" => "Refreshing Pedicure Services",
        "seo_description" => "Indulge in a relaxing pedicure that leaves your feet soft, smooth, and polished."
      ],
      [
        "name" => "Facial Treatment",
        "slug" => "facial-treatment",
        "category_slug" => "skin-care",
        "short_description" => "Rejuvenate your skin with a nourishing facial.",
        "description" => "A custom facial designed for your skin type, focusing on cleansing, exfoliation, and hydration.",
        "responsibilities" => ["Cleansing", "Exfoliation", "Hydration", "Mask application"],
        "gallery" => ["image7.jpg", "image8.jpg"],
        "thumbnail" => "thumbnail4.jpg",
        "price_min" => 50.00,
        "price_max" => 120.00,
        "duration" => 60,
        "preparation_tips" => "Avoid wearing makeup prior to your appointment.",
        "is_featured" => true,
        "is_popular" => true,
        "is_active" => true,
        "is_promotion" => true,
        "is_gift" => true,
        "seo_title" => "Rejuvenating Facial Treatments",
        "seo_description" => "Refresh your skin with a luxurious facial tailored to your skin's needs."
      ],
      [
        "name" => "Eyebrow Shaping",
        "slug" => "eyebrow-shaping",
        "category_slug" => "hair-care",
        "short_description" => "Perfectly shaped brows that frame your face.",
        "description" => "Expert eyebrow shaping using waxing or tweezing to create a beautiful and balanced look.",
        "responsibilities" => ["Shaping", "Waxing", "Tweezing"],
        "gallery" => ["image9.jpg", "image10.jpg"],
        "thumbnail" => "thumbnail5.jpg",
        "price_min" => 15.00,
        "price_max" => 40.00,
        "duration" => 20,
        "preparation_tips" => "Avoid plucking your eyebrows for at least a week prior.",
        "is_featured" => false,
        "is_popular" => true,
        "is_active" => true,
        "is_promotion" => true,
        "is_gift" => true,
        "seo_title" => "Expert Eyebrow Shaping",
        "seo_description" => "Get perfectly shaped eyebrows that complement your features."
      ],
      [
        "name" => "Full Body Waxing",
        "slug" => "full-body-waxing",
        "category_slug" => "hair-removal",
        "short_description" => "Smooth, hair-free skin with a full body wax.",
        "description" => "Professional waxing service for all areas of the body, leaving your skin silky smooth.",
        "responsibilities" => ["Full body waxing", "Skin exfoliation"],
        "gallery" => ["image11.jpg", "image12.jpg"],
        "thumbnail" => "thumbnail6.jpg",
        "price_min" => 100.00,
        "price_max" => 200.00,
        "duration" => 90,
        "preparation_tips" => "Exfoliate before your waxing appointment for the best results.",
        "is_featured" => false,
        "is_popular" => true,
        "is_active" => true,
        "is_promotion" => true,
        "is_gift" => true,
        "seo_title" => "Full Body Waxing for Silky Smooth Skin",
        "seo_description" => "Achieve smooth, hair-free skin with our professional full body waxing service."
      ],
      [
        "name" => "Hair Coloring",
        "slug" => "hair-coloring",
        "category_slug" => "hair-care",
        "short_description" => "Enhance your look with vibrant hair color.",
        "description" => "From highlights to full color, our expert colorists provide a range of hair coloring services.",
        "responsibilities" => ["Consultation", "Coloring", "Treatment", "Styling"],
        "gallery" => ["image13.jpg", "image14.jpg"],
        "thumbnail" => "thumbnail7.jpg",
        "price_min" => 50.00,
        "price_max" => 150.00,
        "duration" => 120,
        "preparation_tips" => "Avoid shampooing your hair right before your color session.",
        "is_featured" => true,
        "is_popular" => true,
        "is_active" => true,
        "is_promotion" => true,
        "is_gift" => true,
        "seo_title" => "Hair Coloring Services",
        "seo_description" => "Add a fresh burst of color to your hair with professional coloring services."
      ],
      [
        "name" => "Bridal Makeup",
        "slug" => "bridal-makeup",
        "category_slug" => "bridal-services",
        "short_description" => "Stunning bridal makeup for your special day.",
        "description" => "Customized makeup for brides, ensuring you look flawless on your wedding day.",
        "responsibilities" => ["Consultation", "Makeup application", "Touch-ups"],
        "gallery" => ["image15.jpg", "image16.jpg"],
        "thumbnail" => "thumbnail8.jpg",
        "price_min" => 150.00,
        "price_max" => 300.00,
        "duration" => 90,
        "preparation_tips" => "Arrive with a clean, moisturized face.",
        "is_featured" => true,
        "is_popular" => true,
        "is_active" => true,
        "is_promotion" => true,
        "is_gift" => true,
        "seo_title" => "Flawless Bridal Makeup",
        "seo_description" => "Look absolutely stunning on your wedding day with bridal makeup."
      ],
      [
        "name" => "Lash Extensions",
        "slug" => "lash-extensions",
        "category_slug" => "makeup-services",
        "short_description" => "Enhance your lashes with extensions that add volume and length.",
        "description" => "Custom lash extensions that provide a fuller, more dramatic look to your lashes.",
        "responsibilities" => ["Lash application", "Customization", "Consultation"],
        "gallery" => ["image17.jpg", "image18.jpg"],
        "thumbnail" => "thumbnail9.jpg",
        "price_min" => 80.00,
        "price_max" => 150.00,
        "duration" => 120,
        "preparation_tips" => "Avoid wearing mascara or eyeliner before your appointment.",
        "is_featured" => false,
        "is_popular" => true,
        "is_active" => true,
        "is_promotion" => true,
        "is_gift" => true,
        "seo_title" => "Lash Extensions for Voluminous Lashes",
        "seo_description" => "Achieve voluminous, beautiful lashes with professional lash extensions."
      ]
    ];

    foreach ($services as $service) {
      $category = \App\Models\Category::where('slug', $service['category_slug'])->first();
      unset($service['category_slug']);

      if ($category) {
        $service['category_id'] = $category->id;
      }

      Service::create($service);
    }
  }
}
