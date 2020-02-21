<?php

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1 = Category::create([
            'name' => 'PHP'
        ]);

        $category2 = Category::create([
            'name' => 'Ruby'
        ]);

        $category3 = Category::create([
            'name' => 'Go'
        ]);

        $category4 = Category::create([
            'name' => 'JavaScript'
        ]);

        $post1 = Post::create([
            'title' => 'We relocated our office to a new designed garage',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ',
            'category_id' => $category1->id,
            'image' => 'posts/1.jpg',
        ]);

        $post2 = Post::create([
            'title' => 'We relocated our office to a new designed garage',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ',
            'category_id' => $category2->id,
            'image' => 'posts/2.jpg',
        ]);

        $post3 = Post::create([
            'title' => 'We relocated our office to a new designed garage',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ',
            'category_id' => $category3->id,
            'image' => 'posts/3.jpg',
        ]);

        $post4 = Post::create([
            'title' => 'We relocated our office to a new designed garage',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ',
            'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ',
            'category_id' => $category4->id,
            'image' => 'posts/4.jpg',
        ]);

        $tag1 = Tag::create([
            'name' => 'Laravel'
        ]);

        $tag2 = Tag::create([
            'name' => 'Ruby on Rails'
        ]);

        $tag3 = Tag::create([
            'name' => 'Spring'
        ]);

        $tag4 = Tag::create([
            'name' => 'Vue.js'
        ]);

        $post1->tags()->attach([$tag1->id, $tag2->id]);
        $post2->tags()->attach([$tag2->id, $tag3->id]);
        $post3->tags()->attach([$tag4->id, $tag1->id]);
        $post4->tags()->attach([$tag1->id, $tag3->id]);
    }
}
