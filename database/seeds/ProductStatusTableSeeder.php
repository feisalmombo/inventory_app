<?php

use Illuminate\Database\Seeder;
use App\Product_Status;

class ProductStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = new Product_Status();
        $status->pro_status_slug = 'sold';
        $status->pro_status_name = 'Sold';
        $status->save();

        $status = new Product_Status();
        $status->pro_status_slug = 'leased';
        $status->pro_status_name = 'Leased';
        $status->save();


        $status = new Product_Status();
        $status->pro_status_slug = 'instock';
        $status->pro_status_name = 'InStock';
        $status->save();
    }
}
