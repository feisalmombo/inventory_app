<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use DB;
use Excel;
use App\User;
use App\Role;
use Barryvdh\DomPDF\Facade as PDF;


class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $permissions=User::with('permissions')->get();

        return view('managePermissionAndRole.view-User-Permission',compact('permissions'));
    } 

    // get permission based on userId
    public function permission_json(Request $request){
        $permissions = Permission::All();
        $id=$_GET['user'];
        //return($id);
        $users=User::where('id',$id)->with('permissions')->first();
        return json_encode([$users,$permissions]);
    }


    // Assign permission to user
    public function assign_entrust_user(Request $request){
        $permissions=Permission::All();
        $users=User::with('permissions')->get();
        return view('managePermissionAndRole.assign-user-permissions',compact('permissions','users'));
    }

    //Assign permission to role
    public function assign_entrust_role(){
        $roles=Role::All();
        return view('managePermissionAndRole.assign-role-permission',compact('roles'));
    }

    //Get json data for entrust roles in json
    public function role_permission_json(){
        $permissions = Permission::All();
        $id = $_GET['role'];
            //return($id);
        $roles = Role::where('id',$id)->with('permissions')->first();
        return json_encode([$roles,$permissions]);

    }

    public function role_permissions_trust(Request $request){
        $role=Role::where('id',$request->roles)->with('permissions')->first();
    //return($role);
        $arr=$request->permission;
        //return ($arr);
        $ar=array();
        foreach ($role as $key => $roles) {

            if (!empty($arr)) {
                foreach ($arr as $key => $permission) {
                    foreach ($role->permissions as $key => $value) {

                     //return $value->id;
                        if ($value->id == $permission) {
                            $role->deletePermissions($value->id);
                            //return $value->id;
                        }
                        $role->deletePermissions($value->id);
                    }
                    // return $value->id;
                }
               // dd($roles); // It works
                $check=$role->givePermissionsTo($arr);
                if($check){

                    return redirect()->back()->with('message','Successfull Entrusted');
                }
                else{
                    return redirect()->back()->with('message','Failed to grant Entrusting Permission');
                }
            }
            else {
                foreach ($role->permissions as $key => $value) {
                    $role->deletePermissions($value->id);
                }
                return redirect()->back()->with('message','Role was Successfull Detached with Permission');
            }
        }

        // return $arr;   

    }



    public function all_permissions(){
        $permissions = DB::select('SELECT permission_slug, permission_name FROM permissions  ORDER BY created_at');
        return view('managePermissionAndRole.view-All-Permissions',compact('permissions'));
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

    public function pdf(Request $request)
    {
       $str_var = $_POST['tad'];
       $permissions = unserialize(base64_decode($str_var));

       if($request->view_type === 'downloadPdf'){
        $pdf = PDF::loadView('managePermissionAndRole.pdf-Allpermission', ['permissions' => $permissions]);
        return $pdf->download('permission.pdf');
    }
    
}

    public function permissionsJSON(Request $request){
        $permissions=Permission::All();
        $id=1;//$_GET['user'];
         //return($id);
        $users = User::where('id',$id)->with('permissions')->first();

        dd($users);
        return json_encode([$users,$permissions]);
        
    }

    // Load data to the index page
    // public function indexData(){
    //     $per=User::with('permissions')->get();
    //     // return $per;
    //     $outPut = '';
    //     $permissions = DB::select('SELECT users.first_name, users.id, users.last_name, users_permissions.permission_id FROM users, users_permissions WHERE users.id = users_permissions.user_id');
    //     return $per;
    //     if (count($permissions)>0) {
    //     $outPut .= '<div class="box-body">
    //                         <table id="example1" class="table table-bordered table-striped">
    //                             <thead>
    //                                 <tr>
    //                                     <th>S/N</th>
    //                                     <th>Full Name</th>
    //                                     <th>Permission</th>
    //                                 </tr>
    //                             </thead>
    //                             <tbody>';
    //     foreach ($permissions as $key => $value) {
    //         $outPut .=$key + 1;
    //     }


    //     } else {
    //         $outPut .= '<div class="alert alert-info">
    //                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    //                     <strong>No User found with specific Permission</strong> 
    //                 </div>';
    //     }
        
    //     return json_encode($outPut);
    // }

    public function user_permissions_trust(Request $request){
    $role=User::where('id',$request->userId)->with('permissions')->first();
     //dd($request->userId);
    //return $role;
            $arr=$request->permission;
            // return $arr;
            $ar=array();
            foreach ($role as $key => $roles) {
                if (!empty($arr)) {
                    foreach ($arr as $key => $permission) {
                        foreach ($role->permissions as $key => $value) {

                            // return $value->id;
                            if ($value->id == $permission) {
                                $role->deletePermissions($value->id);
                            }
                            $role->deletePermissions($value->id);
                        }
                        // return $value->id;
                    }
                    $check=$role->givePermissionsTo($arr);
                    if($check){

                        return redirect()->back()->with('message','Successfull Entrusted');
                    }
                    else{
                        return redirect()->back()->with('message','Failed to grant Entrusting Permission(s)');
                    }
                }
                else {
                    foreach ($role->permissions as $key => $value) {
                        $role->deletePermissions($value->id);
                    }
                    return redirect()->back()->with('message','Role was Successfull Detached with Permission(s)');
                }
            }
        }//Download Excel
    public function getpermissionsExcel($type)
    {
        //dd($type);
        $str_var = $_POST['tadas'];
        $data  = unserialize(base64_decode($str_var));
        //dd($data);
        //$data = $data1->toArray();
        return Excel::create('user-permissions', function($excel) use ($data) {
                // Chain the setters
            $excel->setCreator(\Auth::user()->first_name." ".\Auth::user()->last_name)
                      ->setCompany('UmojaSwitch Co. Ltd');

                // Call them separately
            $excel->setDescription('A file with User Permission.');
            $excel->setManager('Eng. Frank Mbwilo');
            $excel->setLastModifiedBy('');
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->cell('A1',function($cell){ $cell->setValue('S/N');});
                $sheet->cell('B1',function($cell){ $cell->setValue('Full Name');});
                $sheet->cell('C1',function($cell){ $cell->setValue('Permission Name');});
                $sheet->cell('D1',function($cell){ $cell->setValue('Date Created');});

                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                            $i = $key + 2;
                            $sheet->cell('A'.$i, $key + 1);
                            $sheet->cell('B'.$i, $value->first_name.' '.$value->last_name);
                            
                                // if(count($value->permissions)>0){
                                //     foreach($value->permissions as $permit){
                                //             $sheet->cell('C'.$i,$permit->permission_name); 
                                //         }
                                // }else{
                                //             $sheet->cell('C'.$i,'Has no permission');   
                                // }
                            $sheet->cell('D'.$i, $value->created_at);
                    }
                    $sheet->setTitle('UmojaSwitch Co. Ltd');
                }
            });
        })->download($type);
    }

    public function getAllPermissionsExcel($type)
    {
        //dd($type);
        $str_var = $_POST['tadas'];
        $data  = unserialize(base64_decode($str_var));
        //dd($data);
        //$data = $data1->toArray();
        return Excel::create('All Permissions', function($excel) use ($data) {
                // Chain the setters
            $excel->setCreator(\Auth::user()->first_name." ".\Auth::user()->last_name)
                      ->setCompany('UmojaSwitch Co. Ltd');

                // Call them separately
            $excel->setDescription('A file with all Permissions.');
            $excel->setManager('Eng. Frank Mbwilo');
            $excel->setLastModifiedBy('');
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->cell('A1',function($cell){ $cell->setValue('S/N');});
                $sheet->cell('B1',function($cell){ $cell->setValue('Permission Name');});
                $sheet->cell('C1',function($cell){ $cell->setValue('Date Created');});

                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                            $i = $key + 2;
                            $sheet->cell('A'.$i, $key + 1);
                            $sheet->cell('B'.$i, $value->permission_name);
                            $sheet->cell('C'.$i, $value->created_at);
                    }
                    $sheet->setTitle('UmojaSwitch Co. Ltd');
                }
            });
        })->download($type);
    }
}
