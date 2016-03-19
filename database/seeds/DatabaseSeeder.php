<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        //Eloquent::unguard();//je sais pas si c'est vraiment neccessaire car ce n'était pas là à la base
        $this->call(ForumTableSeeder::class);
        Model::reguard();
    }
}
