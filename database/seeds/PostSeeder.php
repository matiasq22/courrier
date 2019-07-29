<?php

use App\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 20; $i++) {
            $post = new App\Post;
            $post->title = "Mi primer post";
            $post->url= Str::slug("Mi primer post");
            $post->excerpt = "Extracto de mi primer post";
            $post->body = "<p> Contenido de este post </p>";
            $post->published_at = Carbon::now();
            $post->category_id = App\Category::inRandomOrder()->get()->first()->id;
            $post->save();

            $post->tags()->attach(Tag::create(['name'=>"etiqueta ". Str::random('1')]));

        }
    }
}
