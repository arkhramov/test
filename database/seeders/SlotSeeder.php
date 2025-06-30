<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slot;

class SlotSeeder extends Seeder
{
    public function run(): void
    {
        Slot::insert([
            [
                'title' => 'Book of Ra',
                'provider' => 'Novomatic',
                'image_url' => 'https://codewave.space/images/s1.png',
                'description' => 'Classic Egyptian slot from Novomatic.',
            ],
            [
                'title' => 'Gonzo’s Quest',
                'provider' => 'NetEnt',
                'image_url' => 'https://codewave.space/images/s2.png',
                'description' => 'Adventure slot in search of Eldorado.',
            ],
            [
                'title' => 'Starburst',
                'provider' => 'NetEnt',
                'image_url' => 'https://codewave.space/images/s3.png',
                'description' => 'Bright arcade-style slot.',
            ],
            [
                'title' => 'Sweet Bonanza',
                'provider' => 'Pragmatic Play',
                'image_url' => 'https://codewave.space/images/s4.png',
                'description' => 'Candy-filled chaos with multipliers.',
            ],
            [
                'title' => 'Fruit Party',
                'provider' => 'Pragmatic Play',
                'image_url' => 'https://codewave.space/images/s5.png',
                'description' => 'Colorful slot with cluster wins.',
            ],
        ]);
    }
}
