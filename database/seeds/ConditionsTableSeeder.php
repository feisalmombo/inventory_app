<?php

use Illuminate\Database\Seeder;
use App\Condition;

class ConditionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $condition = new Condition();
        $condition->condition_slug = 'good';
        $condition->condition_name='Good';
        $condition->save();

        $condition = new Condition();
        $condition->condition_slug = 'bad';
        $condition->condition_name ='Bad';
        $condition->save();
    }
}
