<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RequestProduct;
use App\Product;
use App\Bank;
use App\Product_status;
use DB;

class RequestProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$requestData = DB::select('SELECT request_products.id,users.first_name,users.last_name,product_statuses.pro_status_name,banks.bank_name, products.product_name, products.product_model,request_products.pro_quantity
    		FROM request_products
    		JOIN users ON users.id = request_products.user_id
  			JOIN product_statuses ON product_statuses.id = request_products.pro_status_id
  			JOIN banks ON banks.id = request_products.bank_id
  			JOIN products ON products.id = request_products.product_id
    		WHERE request_status = ?', [0]);
        //dd($requestData);
        //return $requestData;
        return view('productRequest.index-request')->with('requestData',$requestData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $productData = DB::select("SELECT products.product_name,products.product_model,products.id
       FROM products
       JOIN prod_cond_comme ON products.id = prod_cond_comme.product_id
       JOIN products_status_banks ON products_status_banks.product_id = products.id
       WHERE products_status_banks.pstatus_id = ?
       AND prod_cond_comme.condition_id = ?", [3,1]);

      // return $productData;
       $bank = Bank::all();
       return view('productRequest.create-request')->with('productData',$productData)->with('bank',$bank);
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
           'quantity'=> 'required',
           'statusRadios'=> 'required',
           'bank_id'=> 'required',

       ]);

       $requests = new RequestProduct;
       $productData =  Product::where('id',$request->product_id)->value('quantity');
       // dd(((int) $request->quantity));
	       if (($productData>0) && ($productData <= ((int) $request->quantity))) {
	       		return redirect()->back()->with('error', 'Sorry!! The quantity in store does not satisfy your requests.');
	       }
       // $bank =  Bank::where('id',$request->bank_id)->first();
       $statusId  = DB::table('product_statuses')->select('id')->where('pro_status_slug', '=', $request->statusRadios)->value('id');

       //dd($statusId);
       //return $statusId;

       $requests->product_id = $request->product_id;
       $requests->bank_id = $request->bank_id;
       $requests->pro_status_id = $statusId;
       $requests->user_id = \Auth::id();
       $requests->pro_quantity = $request->quantity;

       //return $requests;
       $done = $requests->save();
       if ($done) {
       		return redirect()->back()->with('message', 'You are request is successfully logged!!');
       } else {
       		return redirect()->back()->with('error', 'Failled to log your request!!');
       }
   }


    /**
     * Display the specified resource.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //dd($id);
        // For confirm the request
        $query = RequestProduct::findOrFail($id);
        //return $query;

        $bank_id = $query['bank_id'];
        //dd($bank_id);

        $product_id = $query['product_id'];
        //return $product_id;

        $product_quantity = $query['pro_quantity'];
        //return $product_quantity;

        $business_status = $query['pro_status_id'];
        //return $business_status;

        $query->request_status = true;
        //return $query;

        $product = Product::findOrFail($product_id);
        //return $product;

        $quantity = $product['quantity'];
        //return $quantity;

        $new_quantity = $quantity - $product_quantity;
        //return $new_quantity;

        $product->quantity =  $new_quantity;
        $st = $product->save();
        $st2 = $query->save();
        if ($new_quantity <= 0) {
          $statusUpdate = DB::update('UPDATE products_status_banks set pstatus_id =?,bank_id = ?  where product_id = ?',[$business_status,$bank_id,$product_id]);
        }
        //
        //dd($st);

        if ($st && $st2) {
        	return redirect('/manage-request')->with('message', 'Confirmed Successfully!!');
        } else {
        	return redirect()->back()->with('error', 'Failed to Confirm!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }

    // Single product
    public function getSingleProduct($id){
      //dd($id);
      $requestData = DB::select('SELECT request_products.id,users.first_name,users.last_name,product_statuses.pro_status_name,banks.bank_name, products.product_name,request_products.pro_quantity, products.product_model
        FROM request_products
        JOIN users ON users.id = request_products.user_id
        JOIN product_statuses ON product_statuses.id = request_products.pro_status_id
        JOIN banks ON banks.id = request_products.bank_id
        JOIN products ON products.id = request_products.product_id
        WHERE request_status = ? AND request_products.id = ?', [0,$id]);
      //dd($requestData);
        return view('productRequest.single-request')->with('requestData',$requestData);
    }

    //Confirmed Products
    public function getAllConfirmed(){
      $confirmedData = DB::select('SELECT request_products.id,users.first_name,users.last_name,product_statuses.pro_status_name,banks.bank_name,request_products.pro_quantity, products.product_name, products.product_model
        FROM request_products
        JOIN users ON users.id = request_products.user_id
        JOIN product_statuses ON product_statuses.id = request_products.pro_status_id
        JOIN banks ON banks.id = request_products.bank_id
        JOIN products ON products.id = request_products.product_id
        WHERE request_status = ?', [1]);
      //dd($confirmedData);
        return view('productRequest.confirmed-requests')->with('confirmedData',$confirmedData);
    }

     public function pdf(Request $request)
    {
       $str_var = $_POST['tad'];
       $userData = unserialize(base64_decode($str_var));

       if($request->view_type === 'downloadPdf'){
        $pdf = PDF::loadView('manageUser.pdf-request', ['userData' => $userData]);
        return $pdf->download('users.pdf');
        }

    }


     public function getUsersExcel($type)
    {
        //dd($type);
        $str_var = $_POST['tadas'];
        $data  = unserialize(base64_decode($str_var));
        //dd($data);
        //$data = $data1->toArray();
        return Excel::create('users', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                //$sheet->fromArray($data);
                $sheet->cell('A1',function($cell){ $cell->setValue('S/N');});
                $sheet->cell('B1',function($cell){ $cell->setValue('Product Name');});
                $sheet->cell('C1',function($cell){ $cell->setValue('Product Model');});
                $sheet->cell('D1',function($cell){ $cell->setValue('Bank');});
                $sheet->cell('E1',function($cell){ $cell->setValue('Business Status');});
                $sheet->cell('F1',function($cell){ $cell->setValue('User Request');});

                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                            $i = $key + 2;
                            //dd($value);
                            $sheet->cell('A'.$i, $key + 1);
                            $sheet->cell('B'.$i, $value->product_name);
                            $sheet->cell('C'.$i, $value->product_model);
                            $sheet->cell('D'.$i, $value->bank_name);
                            $sheet->cell('E'.$i, $value->pro_status_name);
                            $sheet->cell('F'.$i, $value->first_name);
                    }
                    //$sheet->mergeCells('A5:B5');
                    $sheet->setTitle('UmojaSwitch Co. Ltd');
                }
            });
        })->download($type);
    }
}
