<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create(); 
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        
        // Create sample articles
        Article::create([
            'title' => 'Getting Started with Laravel',
            'content' => 'Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as routing, dependency injection, sessions, caching, database schema migrations, background job processing, and real-time event broadcasting.',
            'excerpt' => 'An introduction to the Laravel PHP framework and its core concepts.',
            'published' => true,
            'published_at' => now()->subDays(5),
        ]);

        Article::create([
            'title' => 'Building Modern Web Applications',
            'content' => 'Modern web development has evolved significantly over the past decade. Today developers have access to powerful frameworks, tools, and methodologies that make building scalable applications more accessible than ever before. From single-page applications to progressive web apps, the landscape offers numerous possibilities for creating engaging user experiences.',
            'excerpt' => 'Exploring the current state of web development and modern application architecture.',
            'published' => true,
            'published_at' => now()->subDays(3),
        ]);

        Article::create([
            'title' => 'The Future of Database Management',
            'content' => 'Database technology continues to evolve with new paradigms and approaches emerging regularly. From traditional relational databases to NoSQL solutions, graph databases, and beyond, developers now have more choices than ever when it comes to data storage and retrieval strategies.',
            'excerpt' => 'A look at emerging trends and technologies in database management.',
            'published' => true,
            'published_at' => now()->subDay(),
        ]);
    }
}
