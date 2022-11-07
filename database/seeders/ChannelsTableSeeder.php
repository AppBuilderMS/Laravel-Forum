<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Channel;
use Illuminate\Support\Str;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channels =

        Channel::create([
            'name' => 'Laravel 5.8',
            'slug' => Str::slug('Laravel 5.8')
        ]);

        Channel::create([
            'name' => 'Vue js 3',
            'slug' => Str::slug('Vue js 3')
        ]);

        Channel::create([
            'name' => 'Angular 7',
            'slug' => Str::slug('Angular 7')
        ]);

        Channel::create([
            'name' => 'Node js',
            'slug' => Str::slug('Node js')
        ]);
    }
}
