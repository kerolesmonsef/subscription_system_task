<?php

namespace Database\Seeders;

use App\Models\Website;
use Faker\Factory;
use Illuminate\Database\Seeder;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        foreach (range(1, 10) as $i) {
            Website::query()->create([
                'url' => $faker->url(),
            ]);
        }
    }
}
