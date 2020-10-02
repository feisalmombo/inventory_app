<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Bank;


class BanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banks')->insert([
    		'bank_name' => 'Access Bank Tanzania Ltd',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Bank::create([
    		'bank_name' => 'Akiba Commercial Bank Ltd',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Bank::create([
    		'bank_name' => 'Azania Bank',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Bank::create([
    		'bank_name' => 'Bank of Africa',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Bank::create([
    		'bank_name' => 'Commercial Bank of Africa',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Bank::create([
    		'bank_name' => 'DCB Commercial Bank',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Bank::create([
    		'bank_name' => 'EFC Tanzania Microfinance Bank',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Bank::create([
    		'bank_name' => 'Kilimanjaro Co-operative Bank',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Bank::create([
    		'bank_name' => 'Letshego Bank',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Bank::create([
    		'bank_name' => 'Maendeleo Bank',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Bank::create([
    		'bank_name' => 'Mkombozi Commercial Bank',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Bank::create([
    		'bank_name' => 'MuCoba Bank',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Bank::create([
    		'bank_name' => 'Mwanga Commmunity Bank',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Bank::create([
    		'bank_name' => 'Tanzania Womens Bank',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Bank::create([
    		'bank_name' => 'The peoples Bank of Zanzibar',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Bank::create([
    		'bank_name' => 'TIB Corporate Bank',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);
    	Bank::create([
    		'bank_name' => 'TPB Bank',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Bank::create([
    		'bank_name' => 'Uchumi Commercial Bank',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Bank::create([
    		'bank_name' => 'United Bank Limited (UBL)',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Bank::create([
    		'bank_name' => 'Yetu Microfinance',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

    	Bank::create([
    		'bank_name' => 'No Bank',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);
    }
}
