<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Listing;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(5)->create();
        $user=User::factory()->create([
            'name'=>'John Sham',
            'email'=>'john@gmail.com'
        ]);

        //Debugging
echo "User ID: " . $user->id . "\n";

        Listing::factory(6)->create([
            'user_id'=>$user->id
        ]);

        // Listing::create([
        //     'title' => 'Laravel Senior Developer',
        //     'tags' => 'laravel, php',
        //     'company' => 'SkeinSoft Technologies',
        //     'location' => 'Bagbazzar, Kathmandu',
        //     'email' => 'contact@skeinsoft.com',
        //     'website' => 'https://www.skeinsoft.com',
        //     'description' => 'We are seeking an experienced Laravel developer to join our team. The ideal candidate should have strong expertise in Laravel framework and JavaScript. If you are passionate about creating efficient and scalable web applications, we would love to hear from you.'
        // ]);

        // Listing::create([
        //     'title' => 'PHP Senior Developer',
        //     'tags' => 'php, web development',
        //     'company' => 'SkeinSoft Technologies',
        //     'location' => 'Bagbazzar, Kathmandu',
        //     'email' => 'contact@skeinsoft.com',
        //     'website' => 'https://www.skeinsoft.com',
        //     'description' => 'We are hiring a skilled PHP developer to work on exciting web development projects. The candidate should have a strong understanding of PHP programming language and experience in building web applications. Join our dynamic team and contribute to innovative projects.'
        // ]);

        // Listing::create([
        //     'title' => 'Flutter Senior Developer',
        //     'tags' => 'flutter, mobile development',
        //     'company' => 'SkeinSoft Technologies',
        //     'location' => 'Bagbazzar, Kathmandu',
        //     'email' => 'contact@skeinsoft.com',
        //     'website' => 'https://www.skeinsoft.com',
        //     'description' => 'We are looking for a talented Flutter developer to join our mobile app development team. The ideal candidate should have a strong background in Flutter framework and experience in building cross-platform mobile applications. If you are passionate about mobile development, we want to hear from you.'
        // ]);

        // Listing::create([
        //     'title' => 'WordPress Senior Developer',
        //     'tags' => 'wordpress, cms',
        //     'company' => 'SkeinSoft Technologies',
        //     'location' => 'Bagbazzar, Kathmandu',
        //     'email' => 'contact@skeinsoft.com',
        //     'website' => 'https://www.skeinsoft.com',
        //     'description' => 'We are seeking a WordPress developer with expertise in custom theme and plugin development. The candidate should have a deep understanding of WordPress CMS and experience in building custom solutions. Join our team and work on exciting WordPress projects.'
        // ]);

        // Listing::create([
        //     'title' => 'Python Senior Developer',
        //     'tags' => 'python, backend development',
        //     'company' => 'SkeinSoft Technologies',
        //     'location' => 'Bagbazzar, Kathmandu',
        //     'email' => 'contact@skeinsoft.com',
        //     'website' => 'https://www.skeinsoft.com',
        //     'description' => 'We are hiring a Python developer to work on backend development projects. The ideal candidate should have strong programming skills in Python and experience in building scalable backend systems. If you are passionate about backend development, we would like to hear from you.'
        // ]);


        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
