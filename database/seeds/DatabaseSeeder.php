<?php

use App\Note;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        $this->call(UsersTableSeeder::class);
        $this->call(NotesTableSeeder::class);
        Model::reguard();
    }
}

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
            'name'=> 'test',
            'email' => 'test@test.com',
            'id' => '1',
            'password' => password_hash('$sh4rpspr1nG$', PASSWORD_DEFAULT)
        ]);

        factory(App\User::class)->create([
            'name'=> 'alex',
            'email' => 'alex@test.com',
            'id' => '2',
            'password' => password_hash('12345', PASSWORD_DEFAULT)
        ]);
    }
}

class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Note::class)->create([
            'title'=> 'This is a Note Title',
            'body' => 'This is the note body.',
            'user_id' => '1'
        ]);

        factory(App\Note::class)->create([
            'title'=> 'This is another Note Title',
            'body' => 'This is another note body.',
            'user_id' => '1'
        ]);
    }
}