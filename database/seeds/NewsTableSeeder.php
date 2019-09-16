<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\News;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(News::class, 50)->create()->each(function ($news) {
        });
    }
}
