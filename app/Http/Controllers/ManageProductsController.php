<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;
use Carbon\Carbon;
use App\Category;
use App\Store;
use App\Product;
use App\Product_Status;
use App\Comment;
use App\Condition;
use App\Bank;
use App\ProductHistory;
use Barryvdh\DomPDF\Facade as PDF;


class ManageProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $productsInfo = DB::select('SELECT products.id,products.product_name,products.product_model,products.created_at,products.quantity,categories.category_name,stores.store_name,conditions.condition_name,product_statuses.pro_status_name
        FROM products
        JOIN products_category ON products.id = products_category.product_id
        JOIN prod_cond_comme ON products.id = prod_cond_comme.product_id
        JOIN comments ON comments.id = prod_cond_comme.comment_id
        JOIN conditions ON conditions.id = prod_cond_comme.condition_id
        JOIN categories ON categories.id = products_category.category_id
        JOIN category_store ON categories.id = category_store.category_id
        JOIN stores ON stores.id = category_store.store_id
        JOIN products_status_banks ON products.id = products_status_banks.product_id
        JOIN banks ON banks.id = products_status_banks.bank_id
        JOIN product_statuses ON product_statuses.id = products_status_banks.pstatus_id
        WHERE product_statuses.pro_status_name = "InStock"');

      //return $productsInfo;

     return view('products.view-products')->with('productsInfo',$productsInfo);
 }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoriesPro = DB::table('categories')->get();
        $storePro = Store::all();

        //return $categoriesPro;
        //return $storePro;
        return view('products.add-product')->with('storePro',$storePro)
        ->with('categoriesPro',$categoriesPro);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
    {$this->middleware(function($request,$next){
        if(\Auth::user()->can('edit_product')){
          return $next($request);
        }
        return redirect()->back();
      });

      $this->validate(request(), [
        'productName'=> 'required',
        'category_id'=> 'required',
        'statusRadios'=> 'required',
        'store_id'=> 'required',
        'conditionRadios' => 'required',
      ]);

      $product = new Product();
      $preview_pro = new ProductHistory();
      $categoryId = Category::where('id',$request->category_id)->value('id');
      //return $categoryId;
      $storeId = Store::where('id',$request->store_id)->value('id');
      $conditionId = DB::table('conditions')->select('id')->where('condition_slug', '=', $request->conditionRadios)->value('id');
      $statusId  = DB::table('product_statuses')->select('id')->where('pro_status_slug', '=', $request->statusRadios)->value('id');
        //dd("Category : ".$categoryId."Status : ".$statusId."Condition : ".$conditionId);

      $quantityValue = ($request->productQuantity != null) ? $request->productQuantity : 1 ;
      $product->product_name = $request->productName;
      $product->product_model = $request->productModel;
      $product->quantity = $quantityValue;


      $productsInfo = DB::select("SELECT products.id,products.quantity,products.created_at
      FROM products
        JOIN products_category ON products.id = products_category.product_id
        JOIN prod_cond_comme ON products.id = prod_cond_comme.product_id
        JOIN comments ON comments.id = prod_cond_comme.comment_id
        JOIN conditions ON conditions.id = prod_cond_comme.condition_id
        JOIN categories ON categories.id = products_category.category_id
        JOIN category_store ON categories.id = category_store.category_id
        JOIN stores ON stores.id = category_store.store_id
        JOIN products_status_banks ON products.id = products_status_banks.product_id
        JOIN banks ON banks.id = products_status_banks.bank_id
        JOIN product_statuses ON product_statuses.id = products_status_banks.pstatus_id
        WHERE stores.id = '$storeId'
        AND products.product_name = '$request->productName'
        AND categories.id = '$categoryId'
        AND conditions.id = '$conditionId'
        AND product_statuses.id = '$statusId'");

      //dd($productsInfo[0]->id);

      if ($productsInfo) {
      $check = DB::select("UPDATE products
        JOIN products_category ON products.id = products_category.product_id
        JOIN prod_cond_comme ON products.id = prod_cond_comme.product_id
        JOIN comments ON comments.id = prod_cond_comme.comment_id
        JOIN conditions ON conditions.id = prod_cond_comme.condition_id
        JOIN categories ON categories.id = products_category.category_id
        JOIN category_store ON categories.id = category_store.category_id
        JOIN stores ON stores.id = category_store.store_id
        JOIN products_status_banks ON products.id = products_status_banks.product_id
        JOIN banks ON banks.id = products_status_banks.bank_id
        JOIN product_statuses ON product_statuses.id = products_status_banks.pstatus_id
        SET products.quantity = products.quantity + ?,products.updated_at = ?
        WHERE stores.id = ?
        AND products.product_name = ?
        AND categories.id = ?
        AND conditions.id = ?
        AND product_statuses.id = ?",[$quantityValue,Carbon::now(),$storeId,$request->productName,$categoryId,$conditionId,$statusId]);

         $preview_pro->pro_id = $productsInfo[0]->id;
         $preview_pro->user_id = \Auth::id();
         $preview_pro->prev_quantity = $quantityValue;//$productsInfo[0]->quantity;
         $preview_pro->prev_time = $productsInfo[0]->created_at;
         $preview_pro->save();

        return redirect('/manage-products')->with('message',' Product is Successfully inserted!!!.');

      }
      else{
        $done = $product->save();
        $toInsert = DB::table('products')->orderBy('created_at', 'desc')->first();
        //dd($toInsert);
        $preview_pro->pro_id = $toInsert->id;
        $preview_pro->user_id = \Auth::id();
        $preview_pro->prev_quantity = $toInsert->quantity;
        $preview_pro->prev_time = $toInsert->created_at;
        $preview_pro->save();

      $proId = $product->id;

        //Insert Comment/Description in Comment
      if (empty($request->pro_descr)) {
        $desc = "No Description";
      }else{
        $desc = $request->pro_descr;
      }
      $comment = new Comment();
      $comment->content = $desc;
      $comment->save();

      if ($done) {

        $commentId = DB::table('comments')->select('id')
        ->where('content', '=', $desc)
        ->value('id');
            //dd($commentId);
        $categoryInsert = DB::insert('insert into products_category(product_id, category_id,created_at,updated_at) values (?,?,?,?)',[$proId,$categoryId,Carbon::now(),Carbon::now()]);
            //Default bank
        $bankId = 21;

        if ($categoryInsert) {
                // $storeInsert = DB::insert('insert into products_stores(product_id, store_id,created_at,updated_at) values (?,?,?,?)',[$proId,$categoryId,Carbon::now(),Carbon::now()]);
                // if ($storeInsert) {
          $conditionInsert = DB::insert('insert into prod_cond_comme(product_id, comment_id, condition_id,created_at,updated_at) values (?,?,?,?,?)',[$proId,$commentId,$conditionId,Carbon::now(),Carbon::now()]);
          if ($conditionInsert) {
           $statusInsert = DB::insert('insert into products_status_banks(product_id, pstatus_id, bank_id,created_at,updated_at) values (?,?,?,?,?)',[$proId,$statusId,$bankId,Carbon::now(),Carbon::now()]);
           if ($statusInsert) {
            return redirect()->back()->with('message',' Product is Successfully inserted!!!.');
          }else{
            return redirect()->back()->with('error','Failed to insert Status.');
          }
        }else{
         return redirect()->back()->with('error','Failed to insert Condition.');
       }

     }
     else{
       return redirect()->back()->with('error','Failed to insert Category.');
     }
   }
   else{
     return redirect()->back()->with('error','Failed to insert Product name and model.');
   }
 }

 }

   //Product History processing
    public function productHistory($id){
      $productHistory = DB::table('product_histories')->select('product_histories.prev_quantity','products.product_name','products.product_model','products.quantity as currentQuantity','product_histories.created_at as oldCreated'  )->join('products','products.id', '=', 'product_histories.pro_id')->where('pro_id','=',$id)->orderby('product_histories.created_at','desc')->get();
        return view('products.product-histories')->with('productHistory',$productHistory);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $showInfo = DB::select('SELECT products.id,products.product_name,products.quantity,products.product_model ,products.updated_at,categories.category_name,stores.store_name,conditions.condition_name,product_statuses.pro_status_name, comments.content
          FROM products
          JOIN products_category ON products.id = products_category.product_id
          JOIN prod_cond_comme ON products.id = prod_cond_comme.product_id
          JOIN comments ON comments.id = prod_cond_comme.comment_id
          JOIN conditions ON conditions.id = prod_cond_comme.condition_id
          JOIN categories ON categories.id = products_category.category_id
          JOIN category_store ON categories.id = category_store.category_id
          JOIN stores ON stores.id = category_store.store_id
          JOIN products_status_banks ON products.id = products_status_banks.product_id
          JOIN banks ON banks.id = products_status_banks.bank_id
          JOIN product_statuses ON product_statuses.id = products_status_banks.pstatus_id
          WHERE products.id = '.$id);

        return view('products.show-product')->with('showInfo',$showInfo);
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
            if(\Auth::user()->can('edit_product')){
                return $next($request);
            }
            return redirect()->back();
        });

        $proData = DB::select('SELECT products.id,products.product_name,products.product_model,products.quantity,categories.category_name,comments.content,products_status_banks.bank_id,stores.store_name,conditions.condition_name,prod_cond_comme.condition_id,product_statuses.pro_status_name ,products_status_banks.pstatus_id,banks.bank_name
            FROM products
            JOIN products_category ON products.id = products_category.product_id
            JOIN prod_cond_comme ON products.id = prod_cond_comme.product_id
            JOIN comments ON comments.id = prod_cond_comme.comment_id
            JOIN conditions ON conditions.id = prod_cond_comme.condition_id
            JOIN categories ON categories.id = products_category.category_id
            JOIN category_store ON categories.id = category_store.category_id
            JOIN stores ON stores.id = category_store.store_id
            JOIN products_status_banks ON products.id = products_status_banks.product_id
            JOIN banks ON banks.id = products_status_banks.bank_id
            JOIN product_statuses ON product_statuses.id = products_status_banks.pstatus_id
            WHERE products.id = '.$id);

        $store = Store::all();

        $bank = Bank::all();

        $proStatus = Product_Status::all();

        $cond =  Condition::all();

        return view('products.edit-product')->with('proData',$proData)
        ->with('stores',$store)
        ->with('bank',$bank)
        ->with('proStatus',$proStatus)
        ->with('cond',$cond);
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
            if(\Auth::user()->can('edit_product')){
                return $next($request);
            }
            return redirect()->back();
        });

        $this->validate(request(), [
            'categoryId'=> 'required',
        ]);

        $product = DB::select('SELECT products.id,products_status_banks.bank_id,prod_cond_comme.condition_id,prod_cond_comme.comment_id,products_category.category_id,products_status_banks.pstatus_id
            FROM products
            JOIN products_category ON products.id = products_category.product_id
            JOIN prod_cond_comme ON products.id = prod_cond_comme.product_id
            JOIN comments ON comments.id = prod_cond_comme.comment_id
            JOIN conditions ON conditions.id = prod_cond_comme.condition_id
            JOIN categories ON categories.id = products_category.category_id
            JOIN category_store ON categories.id = category_store.category_id
            JOIN stores ON stores.id = category_store.store_id
            JOIN products_status_banks ON products.id = products_status_banks.product_id
            JOIN banks ON banks.id = products_status_banks.bank_id
            JOIN product_statuses ON product_statuses.id = products_status_banks.pstatus_id
            WHERE products.id = '.$id);

        $proUpdate = Product::findOrFail($product[0]->id);
        $commentUpdate = Comment::findOrFail($product[0]->comment_id);

        $cate = Category::where('id',$request->categoryId)->first();

        $commentUpdate->content = $request->productDescr;
        $commentUpdate->save();

        $proUpdate->product_name = $request->productName;
        $proUpdate->product_model = $request->productModel;
        $proUpdate->quantity = $request->productQuantity;
        $st = $proUpdate->save();
        $cateProduct = DB::update('UPDATE products_category set category_id =?  where product_id = ?',[$request->categoryId,$id]);

        $statusUpdate = DB::update('UPDATE products_status_banks set pstatus_id =?,bank_id = ?  where product_id = ?',[$request->pro_status_id,$request->bankId,$id]);

        $conditionUpdate = DB::update('UPDATE prod_cond_comme set condition_id =? where product_id = ?',[$request->conditionRadios,$id]);

        return redirect()->back()->with('message', 'Product is successfully updated');

    }


    function category_fetch(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');

        $data = Store::where('id','=',$value)->with('category')->get();

        return json_encode($data);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $user = $request->user();

        $this->middleware(function($request,$next){
            if(\Auth::user()->can('create_user')){
                return $next($request);
            }
            return redirect()->back();
        });
        $uid=\Auth::id();
        $product = Product::findOrFail($id);
        $product->delete();
        //ActivityLog::where('task_id',$id)->where('changetype','Delete User')->update(['user_id'=>$uid]);

        return redirect()->back()->with('message', 'Product is successfully deleted');
    }

    public function pdf(Request $request)
    {
       $str_var = $_POST['tad'];
       $productsInfo = unserialize(base64_decode($str_var));

       if($request->view_type === 'downloadPdf'){
        $pdf = PDF::loadView('products.pdf-product', ['productsInfo' => $productsInfo]);
        return $pdf->download('products.pdf');
    }

}

    public function getProductsExcel($type)
        {
            //dd($type);
            $str_var = $_POST['tadas'];
            $data  = unserialize(base64_decode($str_var));

            return Excel::create('All Products', function($excel) use ($data) {
                    // Chain the setters
                $excel->setCreator(\Auth::user()->first_name." ".\Auth::user()->last_name)
                          ->setCompany('UmojaSwitch Co. Ltd');

                    // Call them separately
                $excel->setDescription('A file with all Products.');
                $excel->setManager('Eng. Frank Mbwilo');
                $excel->setLastModifiedBy('');
                $excel->sheet('mySheet', function($sheet) use ($data)
                {
                    $sheet->cell('A1',function($cell){ $cell->setValue('S/N');});
                    $sheet->cell('B1',function($cell){ $cell->setValue('Products Name');});
                    $sheet->cell('C1',function($cell){ $cell->setValue('Category Name');});
                    $sheet->cell('D1',function($cell){ $cell->setValue('Store Name');});
                    $sheet->cell('E1',function($cell){ $cell->setValue('Model');});
                    $sheet->cell('F1',function($cell){ $cell->setValue('Quantity');});
                    $sheet->cell('G1',function($cell){ $cell->setValue('Condition');});
                    $sheet->cell('H1',function($cell){ $cell->setValue('Status');});
                    $sheet->cell('I1',function($cell){ $cell->setValue('Date Created');});

                    if (!empty($data)) {
                        foreach ($data as $key => $value) {
                                $i = $key + 2;
                                $sheet->cell('A'.$i, $key + 1);
                                $sheet->cell('B'.$i, $value->product_name);
                                $sheet->cell('C'.$i, $value->category_name);
                                $sheet->cell('D'.$i, $value->store_name);
                                $sheet->cell('E'.$i, $value->product_model);
                                $sheet->cell('F'.$i, $value->quantity);
                                $sheet->cell('G'.$i, $value->condition_name);
                                $sheet->cell('H'.$i, $value->pro_status_name);
                                $sheet->cell('I'.$i, $value->created_at);
                        }
                        $sheet->setTitle('UmojaSwitch Co. Ltd');
                    }
                });
            })->download($type);
        }
}
