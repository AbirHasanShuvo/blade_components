<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
// namespace App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Post::truncate();
        $csvData = fopen(base_path('database/csv/test.csv'), 'r');



        $transRaw = true;

        while (($data = fgetcsv($csvData, 555, ',')) !== false) {
            if ($transRaw) {
                $transRaw = false; // skip header
                continue;
            }

            Post::create([
                'name' => $data[0],
                'description' => $data[1],
            ]);
        }
        fclose($csvData);
    }
}
