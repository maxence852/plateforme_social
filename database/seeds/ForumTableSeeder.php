<?php

use Illuminate\Database\Seeder;

class ForumTableSeeder extends Seeder
{


    public function run()
    {
        DB::table('forum_groups')->insert(array(
            'title' => 'General Discussion',
            'author_id' => 1
        ));
        /*ForumGroup::create(array(
            'title' => 'General Discussion',
            'author_id' => 1
        ));*/
        DB::table('forum_categories')->insert(array(
            'group_id' => 1,
            'title' => 'Test Category 1',
            'author_id' => 1

        ));
        /*ForumCategory::create(array(
           'group_id' => 1,
            'title' => 'Test Category 1',
            'author_id' => 1
        ));*/
         DB::table('forum_categories')->insert(array(
             'group_id' => 1,
             'title' => 'Test Category 2',
             'author_id' => 1

         ));

        /*ForumCategory::create(array(
            'group_id' => 1,
            'title' => 'Test Category 2',
            'author_id' => 1
        ));*/
    }
}