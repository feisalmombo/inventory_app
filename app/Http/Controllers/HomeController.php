<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $instoke = DB::select('SELECT COUNT(*) as "countInstoke" FROM products JOIN products_status_banks ON products.id = products_status_banks.product_id WHERE products_status_banks.pstatus_id = ?', [3]);
        $requestCount = DB::select('SELECT COUNT(request_status) as "request_count" FROM request_products WHERE request_status = ?', [0]);

        $confirmCount = DB::select('SELECT COUNT(request_status) as "conf_count" FROM request_products WHERE request_status = ?', [1]);

        $priceCount = DB::select('SELECT COUNT(*) as "priceCount" FROM products LEFT JOIN product_prices ON product_prices.product_id = products.id WHERE product_prices.product_id IS null');

        $permissionCount = DB::select('SELECT COUNT(*) as "permissionCount" FROM permissions');

        $userCount = DB::select('SELECT COUNT(*) as "userCount" FROM users');

        $badCount = DB::select('SELECT COUNT(*) as "badCon" FROM prod_cond_comme WHERE condition_id = 2');

        $goodCount = DB::select('SELECT COUNT(*) as "goodCon" FROM prod_cond_comme WHERE condition_id = 1');

        $soldCount = DB::select('SELECT COUNT(*) as "soldCount" FROM products_status_banks WHERE pstatus_id = 1');

        $leasedCount = DB::select('SELECT COUNT(*) as "leasedCount" FROM products_status_banks WHERE pstatus_id = 2');

        $instockCount = DB::select('SELECT COUNT(*) as "instockCount" FROM products_status_banks WHERE pstatus_id = 3');


        return view('home')->with('reqCo',$requestCount)->with('confCo',$confirmCount)->with('instock',$instoke)->with('price',$priceCount)->with('permissionCount',$permissionCount)->with('badCount',$badCount)->with('goodCount',$goodCount)->with('userCount',$userCount)->with('soldCount',$soldCount)->with('leasedCount',$leasedCount)->with('instockCount',$instockCount);
    }
}
