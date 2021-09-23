<?php

namespace Database\Seeders;

use App\Models\Asset;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $assets = [
            [
            'id' => '1', 
            'title' => 'Twitter Web Rules', 
            'slug' => Str::slug('Twitter Web Rules'), 
            'description' => 'A twitter handbook of rules', 
            'content' => 'http://twitter.com/handbook', 
            'type' => 'link', 
            'option' => '1'],
            [
            'id' => '2', 
            'title' => 'How I Met Your Mother', 
            'slug' => Str::slug('How I Met Your Mother'), 
            'description' => 'After Friends, this is the best TV series of all time', 
            'content' => 'https://res.cloudinary.com/dtgglytjm/image/upload/v1632174187/Files/kiwpjldrst8ujc61zhui.pdf', 
            'type' => 'pdf', 
            'option' => '0'],
            [
            'id' => '3', 
            'title' => 'The Big Bang', 
            'slug' => Str::slug('The Big Bang'), 
            'description' => 'What happened before the big bang', 
            'content' => '<p>The big boom</p>', 
            'type' => 'snippet', 
            'option' => '0'],
        ];
        foreach ($assets as $asset) {
            Asset::firstOrCreate([
                'id' => $asset['id'],
                'title' => $asset['title'],
                'slug' => $asset['slug'],
                'description' => $asset['description'],
                'content' => $asset['content'],
                'type' => $asset['type'],
                'option' => $asset['option']
                
            ]);
        }
        unset($assets);
    }
}
