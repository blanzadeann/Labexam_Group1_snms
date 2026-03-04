<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Jilmar Ferrer',
            'email' => 'jilmarferrer29@gmail.com',
            'password' => Hash::make('password123'),
        ]);

        $tech = Category::create([
            'name' => 'Technology',
            'description' => 'Latest tech news and gadgets.'
        ]);

        $news = Category::create([
            'name' => 'General News',
            'description' => 'Global events and updates.'
        ]);

        Article::create([
            'category_id' => $tech->id,
            'title' => 'The Rise of AI in 2026',
            'body' => 'Artificial Intelligence continues to reshape the digital landscape...',
            'author_email' => 'jilmarferrer29@gmail.com',
            'image_url' => 'https://example.com/ai.jpg',
            'status' => 'published'
        ]);

        Article::create([
            'category_id' => $tech->id,
            'title' => 'Mastering Laravel Seeders',
            'body' => 'Learn how to populate your database efficiently using Laravel seeders.',
            'author_email' => 'jilmarferrer29@gmail.com',
            'image_url' => null,
            'status' => 'draft'
        ]);

        Article::create([
            'category_id' => $news->id,
            'title' => 'Campus Updates: Final Exams',
            'body' => 'Preparation for the upcoming lab exams is in full swing at ISU.',
            'author_email' => 'admin@isu.edu.ph',
            'image_url' => 'https://example.com/campus.jpg',
            'status' => 'published'
        ]);
    }
}