<?php

use App\Post;
use App\Tag;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->disableForeignKeyCheck();
        User::truncate();
        Tag::truncate();
        Post::truncate();

        factory(User::class, 50)->create();
        factory(Tag::class, 20)->create();
        factory(Post::class, 100)->create()->each(function ($post) {
            $tags = Tag::all()->random(mt_rand(1, 5))->pluck('id');
            $post->tags()->attach($tags);
        });
    }

    private function disableForeignKeyCheck()
    {
        $connection = config('database.connections')[config('database.default')];
        $sql = '';
        switch ($connection['driver']) {
            case 'mysql':
                $sql = 'SET FOREIGN_KEY_CHECKS = 0';
                break;
            case 'sqlite':
                $sql = 'PRAGMA foreign_keys = OFF';
                break;
        }

        DB::statement($sql);
    }
}
