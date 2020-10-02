<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;
use Carbon\Carbon;
use App\Category;
use App\Store;
use App\Product;
use App\Price;
use Barryvdh\DomPDF\Facade as PDF;

class ManagePricesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $priceData =DB::select(
        "SELECT prices.id, prices.buying_price,
        prices.min_selling_price,
        prices.created_at,
        products.product_name,
        product_prices.product_id,
        product_prices.price_id
        FROM
        prices,
        products,
        product_prices
        WHERE prices.id = product_prices.price_id AND products.id = product_prices.product_id
        ORDER BY prices.created_at"
    );
    //return $priceData;
     return view('managePrices.view-price')->with('priceData',$priceData);
 }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products =DB::select(
        "SELECT prices.id, prices.buying_price, prices.min_selling_price,prices.created_at,products.product_name, product_prices.product_id, product_prices.price_id FROM prices,products,product_prices WHERE prices.id = product_prices.price_id AND products.id = product_prices.product_id
        ORDER BY prices.created_at");

        //return $products;

        return view('managePrices.add-price')->with('products',$products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
         'product_id'=> 'required',
         'buyingPrice'=> 'required',
         'minSalePrice'=> 'required',

     ]);
        $price = new Price();

        $product = Product::where('id',$request->product_id)->value('id');

        //return $product;

        $price->buying_price = $request->buyingPrice;
        $price->min_selling_price = $request->minSalePrice;
        $done = $price->save();

        $priceId = DB::table('prices')->select('id')
        ->where('buying_price', '=', $request->buyingPrice)
        ->where('min_selling_price', '=', $request->minSalePrice)
        ->value('id');

        //return $priceId;


        if ($done) {
            DB::insert('insert into product_prices(product_id, price_id, created_at,updated_at) values (?,?,?,?)',[$product, $priceId,Carbon::now(),Carbon::now()]);
            return redirect()->back()->with('message', 'Product Price has successfully added!!!');
        }
        return redirect()->back()->with('message', 'Failed to insert Product Price!');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     $prices = DB::select(
        "SELECT prices.buying_price,prices.min_selling_price, prices.created_at,prices.id, prices.actual_selling_price, products.product_name, product_prices.product_id, product_prices.price_id  FROM prices,products,product_prices WHERE prices.id = $id AND prices.id = product_prices.price_id AND products.id = product_prices.product_id"
    );


     // return $price;
     return view('managePrices.show-price')->with('prices',$prices);
 }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     $this->middleware(function($request,$next){
        if(\Auth::user()->can('edit_price')){
            return $next($request);
        }
        return redirect()->back();
    });

     $price = DB::select(
        "SELECT prices.buying_price,prices.min_selling_price, prices.id, prices.actual_selling_price, products.product_name, product_prices.product_id, product_prices.price_id  FROM prices,products,product_prices WHERE prices.id = $id AND prices.id = product_prices.price_id AND products.id = product_prices.product_id"
    );

     $products = Product::all();


     return view('managePrices.edit-price')->with('price',$price)->with('products',$products);
 }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     $this->middleware(function($request,$next){
        if(\Auth::user()->can('edit_price')){
            return $next($request);
        }
        return redirect()->back();
    });

     $this->validate(request(), [
        'BuyingPrice'=> 'required',
        'minSellingPrice'=> 'required',

    ]);

     $price= Price::findOrFail($id);

     $product = Product::where('id',$request->price)->first();

     $price->buying_price = $request->BuyingPrice;
     $price->min_selling_price = $request->minSellingPrice;
     $st = $price->save();
     $productPrice = DB::update('UPDATE product_prices set product_id =?  where price_id = ?',[$request->product_id,$id]);


     if (!$st) {
        return redirect()->back()->with('message', 'Failed to Update Product Price data');
    }

    return redirect('/manage-prices')->with('message', 'Product Price is successfully updated');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $price = Price::findOrFail($id);
        $price->delete();

        return redirect()->back()->with('message', 'Product Price is successfully deleted');
    }

    public function pdf(Request $request)
    {
       $str_var = $_POST['tad'];
       $priceData = unserialize(base64_decode($str_var));

       if($request->view_type === 'downloadPdf'){
        $pdf = PDF::loadView('managePrices.pdf-price', ['priceData' => $priceData]);
        return $pdf->download('prices.pdf');
    }

}

public function getPriceExcel($type)
{
            //dd($type);
    $str_var = $_POST['tadas'];
    $data  = unserialize(base64_decode($str_var));
            //dd($data);
            //$data = $data1->toArray();
    return Excel::create('All Products-Price', function($excel) use ($data) {
                    // Chain the setters
        $excel->setCreator(\Auth::user()->first_name." ".\Auth::user()->last_name)
        ->setCompany('UmojaSwitch Co. Ltd');

                    // Call them separately
        $excel->setDescription('A file with all Price.');
        $excel->setManager('Eng. Frank Mbwilo');
        $excel->setLastModifiedBy('');
        $excel->sheet('mySheet', function($sheet) use ($data)
        {
            $sheet->cell('A1',function($cell){ $cell->setValue('S/N');});
            $sheet->cell('B1',function($cell){ $cell->setValue('Products Name');});
            $sheet->cell('C1',function($cell){ $cell->setValue('Buying Price');});
            $sheet->cell('D1',function($cell){ $cell->setValue('Minimum Price');});
            $sheet->cell('E1',function($cell){ $cell->setValue('Actual Price');});
            $sheet->cell('F1',function($cell){ $cell->setValue('Date Created');});

            if (!empty($data)) {
                foreach ($data as $key => $value) {
                    $i = $key + 2;
                    $sheet->cell('A'.$i, $key + 1);
                    $sheet->cell('B'.$i, $value->product_name);
                    $sheet->cell('C'.$i, $value->buying_price);
                    $sheet->cell('D'.$i, $value->min_selling_price);
                    $sheet->cell('E'.$i, $value->actual_selling_price);
                    $sheet->cell('F'.$i, $value->created_at);
                }
                $sheet->setTitle('UmojaSwitch Co. Ltd');
            }
        });
    })->download($type);
}


public function getSinglePrice($id){
            //dd($id);
            //return $id;
    $addPrice = DB::select('SELECT products.id,products.product_name, products.product_model FROM products WHERE products.id = ?',[$id]);
            //dd($addPrice);
            //return $addPrice;
    return view('managePrices.add-single-price')->with('addPrice',$addPrice);
}

}
