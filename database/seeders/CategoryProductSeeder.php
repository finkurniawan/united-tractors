<?php

namespace Database\Seeders;

use Database\Factories\CategoryProductFactory;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        CategoryProductFactory::new()->count(10)->create();
    }
}
