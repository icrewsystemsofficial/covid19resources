<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Category::factory()->count(5)->create();
        DB::table('categories')->truncate();

        $categories = array(
            'Hospitals',
            'Ventilator',
            'Oxygen',
            'Plasma',
            'Home Quarentine',
            'Food & Groceries',
        );

        foreach($categories as $cat) {
            $category = new Category;
            $category->name = $cat;
            $category->description = 'Resources about '.$cat;
            $category->status = 1;
            $category->save();
        }

    }
}
