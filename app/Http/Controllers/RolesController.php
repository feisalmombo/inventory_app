<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;
use Barryvdh\DomPDF\Facade as PDF;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = DB::select('SELECT users.first_name, users.id, users.last_name, roles.role_slug, roles.role_name, roles.created_at FROM users, roles, users_roles WHERE users_roles.role_id = roles.id AND users_roles.user_id = users.id ORDER BY users.created_at');
        return view('managePermissionAndRole.view-User-Role')->with('roles',$roles);
    }


    public function all_roles(){
        $roles = DB::select('SELECT roles.role_slug, roles.role_name, roles.created_at FROM roles ORDER BY roles.created_at');
        return view('managePermissionAndRole.view-All-Roles')->with('roles',$roles);
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

     public function pdfRoles(Request $request)
    {
       $str_var = $_POST['tad'];
       $roles = unserialize(base64_decode($str_var));

       if($request->view_type === 'downloadPdf'){
        $pdf = PDF::loadView('managePermissionAndRole.pdf-Userrole', ['roles' => $roles]);
        return $pdf->download('roles.pdf');
    }
    
}

public function pdfAll(Request $request)
    {
       $str_var = $_POST['tad'];
       $roles = unserialize(base64_decode($str_var));

       if($request->view_type === 'downloadPdf'){
        $pdf = PDF::loadView('managePermissionAndRole.pdf-Allrole', ['roles' => $roles]);
        return $pdf->download('roles.pdf');
    }
    
    }

    //Download Excel
    public function getRolesExcel($type)
    {
        //dd($type);
        $str_var = $_POST['tadas'];
        $data  = unserialize(base64_decode($str_var));
        //dd($data);
        //$data = $data1->toArray();
        return Excel::create('user-roles', function($excel) use ($data) {
                // Chain the setters
            $excel->setCreator(\Auth::user()->first_name." ".\Auth::user()->last_name)
                      ->setCompany('UmojaSwitch Co. Ltd');

                // Call them separately
            $excel->setDescription('A file with User Roles.');
            $excel->setManager('Eng. Frank Mbwilo');
            $excel->setLastModifiedBy('');
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->cell('A1',function($cell){ $cell->setValue('S/N');});
                $sheet->cell('B1',function($cell){ $cell->setValue('Full Name');});
                $sheet->cell('C1',function($cell){ $cell->setValue('Role Name');});
                $sheet->cell('D1',function($cell){ $cell->setValue('Date Created');});

                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                            $i = $key + 2;
                            $sheet->cell('A'.$i, $key + 1);
                            $sheet->cell('B'.$i, $value->first_name.' '.$value->last_name);
                            $sheet->cell('C'.$i, $value->role_name);
                            $sheet->cell('D'.$i, $value->created_at);
                    }
                    $sheet->setTitle('UmojaSwitch Co. Ltd');
                }
            });
        })->download($type);
    }

    public function getAllRolesExcel($type)
    {
        //dd($type);
        $str_var = $_POST['tadas'];
        $data  = unserialize(base64_decode($str_var));
        //dd($data);
        //$data = $data1->toArray();
        return Excel::create('All Roles', function($excel) use ($data) {
                // Chain the setters
            $excel->setCreator(\Auth::user()->first_name." ".\Auth::user()->last_name)
                      ->setCompany('UmojaSwitch Co. Ltd');

                // Call them separately
            $excel->setDescription('A file with all Roles.');
            $excel->setManager('Eng. Frank Mbwilo');
            $excel->setLastModifiedBy('');
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->cell('A1',function($cell){ $cell->setValue('S/N');});
                $sheet->cell('B1',function($cell){ $cell->setValue('Role Name');});
                $sheet->cell('C1',function($cell){ $cell->setValue('Date Created');});

                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                            $i = $key + 2;
                            $sheet->cell('A'.$i, $key + 1);
                            $sheet->cell('B'.$i, $value->role_name);
                            $sheet->cell('C'.$i, $value->created_at);
                    }
                    $sheet->setTitle('UmojaSwitch Co. Ltd');
                }
            });
        })->download($type);
    }
}
