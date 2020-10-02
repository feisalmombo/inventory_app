<?php

use Illuminate\Database\Seeder;
use App\Status;

class UserStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = new Status();
        $status->status_name = 'Active';
        $status->status_slug = true;
        $status->save();

        $status = new Status();
        $status->status_name = 'Inactive';
        $status->status_slug = false;
        $status->save();
    }
}
