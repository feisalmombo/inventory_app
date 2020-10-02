<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;
use App\Store;
use Barryvdh\DomPDF\Facade as PDF;


class StocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $storesData =DB::table('stores')
        ->select('id','store_name','created_at')
        ->get();
        return view('stock.view-stock')->with('storesData',$storesData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
              $this->middleware(function($request,$next){
            if( \Auth::user()->can('create_store')){
                return $next($request);
            }
            return redirect()->back();
        });

        return view('stock.add-stock');
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
            if( \Auth::user()->can('create_store')){
                return $next($request);
            }
            return redirect()->back();
        });
       $this->validate(request(), [
        'storeName'=> 'required',
        ]);

       $store = new Store();
       $store->store_name = $request->storeName;
       $st = $store->save();
       if (!$st) {
          return redirect()->back()->with('message', 'Failed to Add Store');
      }else{
        return  redirect('/product-store')->with('message', 'Store is successfully added');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $store= Store::findOrFail($id);

        return view('stock.show-stock')->with('store',$store);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = Store::findOrFail($id);

        return view('stock.edit-stock')->with('store',$store);
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
            if( \Auth::user()->can('edit_store')){
                return $next($request);
            }
            return redirect()->back();
        });
        $store = Store::findOrFail($id);
        $this->validate(request(), [
        'storeName'=> 'required',
        ]);
        $store->store_name = $request->storeName;
        $st = $store->save();

        return redirect('/product-store')->with('message', 'Store is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->middleware(function($request,$next){
            if( \Auth::user()->can('delete_store')){
                return $next($request);
            }
            return redirect()->back();
        });
        $store = Store::findOrFail($id);
        $store->delete();
        $request->session()->flash('message', 'Store is successfully deleted');
        return redirect('/product-store');
    }

      public function pdf(Request $request)
    {
         $str_var = $_POST['tad'];
        $storesData = unserialize(base64_decode($str_var));

       if($request->view_type === 'downloadPdf'){
        $pdf = PDF::loadView('stock.pdf-store', ['storesData' => $storesData]);
        return $pdf->download('stores.pdf');
        }
    }

    //Download Excel
    public function getStoresExcel($type)
    {
        //dd($type);
        $str_var = $_POST['tadas'];
        $data  = unserialize(base64_decode($str_var));
        //dd($data);
        //$data = $data1->toArray();
        return Excel::create('stores', function($excel) use ($data) {
                // Chain the setters
            $excel->setCreator(\Auth::user()->first_name." ".\Auth::user()->last_name)
                      ->setCompany('UmojaSwitch Co. Ltd');

                // Call them separately
            $excel->setDescription('A file with all stores.');
            $excel->setManager('Eng. Frank Mbwilo');
            $excel->setLastModifiedBy('');
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                //$sheet->fromArray($data);
                //$sheet->mergeCells('A1:C1')->setCellValue('All Stores');

                //$sheet->setOrientation('landscape');
                // // Set top, right, bottom, left
                //     $sheet->setPageMargin(array(
                //         0.25, 0.30, 0.25, 0.30
                //     ));

                //     // Set all margins
                //     $sheet->setPageMargin(0.25);
                // Set black background
                    // $sheet->row(1, function($row) {

                    //     // call cell manipulation methods
                    //     $row->setBackground('#000000');

                    // });
                $sheet->cell('A1',function($cell){ $cell->setValue('S/N');});
                $sheet->cell('B1',function($cell){ $cell->setValue('Store Name');});
                $sheet->cell('C1',function($cell){ $cell->setValue('Date Created');});

                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                            $i = $key + 2;
                            //dd($value);
                            $sheet->cell('A'.$i, $key + 1);
                            $sheet->cell('B'.$i, $value->store_name);
                            $sheet->cell('C'.$i, $value->created_at);
                    }
                    $sheet->setTitle('UmojaSwitch Co. Ltd');
                }
            });
        })->download($type);
    }
}
