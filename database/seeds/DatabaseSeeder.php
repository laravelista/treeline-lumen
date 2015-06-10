<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Status;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call('UserTableSeeder');
        $pending = ['name' => 'Pending'];
        $doing = ['name' => 'Doing'];
        $completed = ['name' => 'Completed'];

        Status::create($pending);
        Status::create($doing);
        Status::create($completed);
    }

}
