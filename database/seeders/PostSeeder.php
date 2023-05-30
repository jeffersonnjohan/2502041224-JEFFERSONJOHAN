<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for($i = 1; $i <= 20; $i++){

            $countParagraph = $faker->numberBetween(1, 10);
            
            if($countParagraph >= 7){
                $category_id = 3;
            } elseif($countParagraph >= 4){
                $category_id = 2;
            } else{
                $category_id = 1;
            }

            Post::create([
                'title' => $faker->sentence(),
                'description' => $faker->paragraph(),
                'author' => $faker->name(),
                'date' => $faker->date(),
                'category_id' => $category_id,
                'body' => $this->breakParagraphToHTML($faker->paragraphs($countParagraph)),
                // Image with faker jelek, sehingga saya menggunakan dari unsplash saja
                // 'image' => $faker->imageUrl(600, 400,null ,true), 
                'image' => 'https://source.unsplash.com/random/500x400?book&sig='.$faker->numberBetween(1,500),
                'ratingcount' => $faker->numberBetween(1,200),
                'created_at' => $faker->date().' '.$faker->time(),
            ]);
        }
    }

    private function breakParagraphToHTML($listParagraph){
        $result = '';

        foreach($listParagraph as $paragraph){
            $result .= '<p class="mb-2">' . $paragraph .'</p>';
        }
        return $result;
    }
}
