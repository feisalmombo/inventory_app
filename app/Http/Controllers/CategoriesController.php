<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;
use App\Category;
use App\Store;
use Barryvdh\DomPDF\Facade as PDF;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoriesData =DB::select(
            "SELECT categories.category_name, categories.id,stores.store_name, category_store.category_id ,category_store.store_id,categories.created_at FROM categories,stores,category_store WHERE categories.id = category_store.category_id AND stores.id = category_store.store_id
        ORDER BY categories.created_at"
        );

        return view('categories.view-category')->with('categoriesData',$categoriesData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->middleware(function($request,$next){
            if(\Auth::user()->can('create_user')){
                return $next($request);
            }
            return redirect()->back();
        });

        $store = Store::all();
        return view('categories.add-category')->with('storeData',$store);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->middleware(function($request,$next){
            if(\Auth::user()->can('create_user')){
                return $next($request);
            }
            return redirect()->back();
        });



        $this->validate(request(), [
            'store_name'=> 'required',
            'category_name'=> 'required',
        ]);


        $store = Store::where('id',$request->store_name)->first();

        //return $store;
        
        
        $catego = new Category();
        $catego->category_name = $request->category_name;
        $catego->description = $request->category_desc;
        
        //return $catego;
        $st = $catego->save();
        $catego->store()->attach($store);

        if (!$st) {
          return redirect()->back()->with('message', 'Failed to insert Category!');
      }
      return redirect()->back()->with('message', 'Category is successfully added!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $categories = DB::select(
            "SELECT categories.category_name,categories.description, categories.id, stores.store_name, category_store.category_id, category_store.store_id  FROM categories,stores,category_store WHERE categories.id = $id AND categories.id = category_store.category_id AND stores.id = category_store.store_id"
        );

        //return $categories;

        return view('categories.show-category')->with('categories',$categories);
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
            if(\Auth::user()->can('edit_user')){
                return $next($request);
            }
            return redirect()->back();
        });
        $category = DB::select("SELECT categories.category_name,categories.description, categories.id, stores.store_name, category_store.category_id , category_store.store_id FROM categories, stores, category_store WHERE categories.id = $id AND categories.id = category_store.category_id AND stores.id = category_store.store_id");

        //dd($category);

        //$category = Category::findOrFail($id);

       $stock = Store::all();

       return view('categories.edit-category')->with('category',$category)->with('stock',$stock);
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
            if(\Auth::user()->can('edit_user')){
                return $next($request);
            }
            return redirect()->back();
        });

         $this->validate(request(), [
            'categoryName'=> 'required',
            'store'=> 'required',
        ]);



         $category = Category::findOrFail($id);

         //$store = Store::where('id',$request->id_store)->first();
         //dd($store->id);
         //$cate = new Category();
         //$cate->store()->detach($store);

         $store = Store::where('id',$request->store)->first();

         

         $st1 = Category::find($id)->store()->detach();

         //dd($y);
         $category->category_name = $request->categoryName;
         $category->description = $request->descr;
         $st = $category->save();
         $category->store()->attach($store);


         // //$cate->store()->updateExistingPivot($request->id_store,$store1);

         // //UPDATE category_store SET category_store.store_id = WHERE category='Fiction';

         if (!$st) {
            return redirect()->back()->with('message', 'Failed to Update Category');
        }
        return redirect()->back()->with('message', 'Category is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->middleware(function($request,$next){
            if(\Auth::user()->can('delete_category')){
                return $next($request);
            }
            return redirect()->back();
        });
        $cate = Category::findOrFail($id);
        $cate->delete();
        return back()->with('message', 'Category is successfully deleted');
    }

       public function pdf(Request $request)
    {
         $str_var = $_POST['tad'];
         $categoriesData = unserialize(base64_decode($str_var));

       if($request->view_type === 'downloadPdf'){
        $pdf = PDF::loadView('categories.pdf-category', ['categoriesData' => $categoriesData]);
        return $pdf->download('categories.pdf');
    }
    
}

    //Download Excel
    public function getCategoryExcel($type)
    {
        //dd($type);
        $str_var = $_POST['tadas'];
        $data  = unserialize(base64_decode($str_var));
        //dd($data);
        //$data = $data1->toArray();
        return Excel::create('categories', function($excel) use ($data) {
                // Chain the setters
            $excel->setCreator(\Auth::user()->first_name." ".\Auth::user()->last_name)
                      ->setCompany('UmojaSwitch Co. Ltd');

                // Call them separately
            $excel->setDescription('A file with all Categories.');
            $excel->setManager('Eng. Frank Mbwilo');
            $excel->setLastModifiedBy('');
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->cell('A1',function($cell){ $cell->setValue('S/N');});
                $sheet->cell('B1',function($cell){ $cell->setValue('Category Name');});
                $sheet->cell('C1',function($cell){ $cell->setValue('Store Name');});
                $sheet->cell('D1',function($cell){ $cell->setValue('Date Created');});

                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                            $i = $key + 2;
                            $sheet->cell('A'.$i, $key + 1);
                            $sheet->cell('B'.$i, $value->category_name);
                            $sheet->cell('C'.$i, $value->store_name);
                            $sheet->cell('D'.$i, $value->created_at);
                    }
                    $sheet->setTitle('UmojaSwitch Co. Ltd');
                }
            });
        })->download($type);
    }

    
    
}



//Edit -- SQLSTATE[42S22]: Column not found: 1054 Unknown column '4' in 'where clause' (SQL: select `stores`.*, `category_store`.`category_id` as `pivot_category_id`, `category_store`.`store_id` as `pivot_store_id` from `stores` inner join `category_store` on `stores`.`id` = `category_store`.`store_id` where `category_store`.`category_id` = 7 and `4` is null)

//Create -- SQLSTATE[23000]: Integrity constraint violation: 1452 Cannot add or update a child row: a foreign key constraint fails (`git_inventory`.`products_stores`, CONSTRAINT `products_stores_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE) (SQL: insert into products_stores(product_id, store_id,created_at,updated_at) values (3,8,2019-03-19 13:16:35,2019-03-19 13:16:35))