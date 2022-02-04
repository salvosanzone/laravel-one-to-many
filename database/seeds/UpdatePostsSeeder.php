<?php

use App\Category;
use App\Post;
use Illuminate\Database\Seeder;

class UpdatePostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // salvo all'interno di una variabile i post facendo una query
        $posts = Post::all();

        foreach ($posts as $post) {
            $post->category_id = Category::inRandomOrder()->first()->id;
            
            $post->update();
        }

    }
}
