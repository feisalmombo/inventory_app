<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;
use App\User;
use App\Role;
use App\Permission;
use App\UsersStatus;
use App\Status;
use Barryvdh\DomPDF\Facade as PDF;

class ManageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userData =DB::select(
            "SELECT users.first_name, users.id, users.last_name,users.userStatus, users.email,users.created_at, roles.role_slug, roles.role_name  FROM users, roles, users_roles  WHERE
            users_roles.role_id = roles.id AND users_roles.user_id = users.id
        ORDER BY users.created_at"
        );

     //dd($userData);
     // return $userData;
        return view('manageUser.viewUser')->with('userData',$userData);
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

        $roles = DB::select("SELECT roles.id, roles.role_slug, roles.role_name  FROM roles");
    // return $roles;
        return view('manageUser.addUser')->with('roles',$roles);
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
            'fname'=> 'required',
            'lname'=> 'required',
            'privilege'=> 'required',
        ]);

        $dev_role = Role::where('id',$request->privilege)->first();
        $dev_perm = Permission::where('permission_slug','create')->first();
        $status = Status::where('status_slug',false)->first();
       // $user = $request->user(); //getting the current logged in user
       //  dd($user->hasRole('administrator','Administrator')); // and so on

       $users = new User();
        $users->first_name = $request->fname;
        $users->last_name = $request->lname;
        $user_email = $users->email = strtolower($request->fname).".".strtolower($request->lname)."@umojaswitch.co.tz";
        $users->userStatus = 1;
        $users->password = bcrypt(strtoupper($request->lname).'1234');
        $st = $users->save();
        $users->roles()->attach($dev_role);
        $users->permissions()->attach($dev_perm);

        $user_status = new UsersStatus();
        $user_status->user_id=$users->id;
        $user_status->status_id= $status->id;
        $user_status->save();
        if (!$st) {
          return redirect()->back()->with('message', 'Failed to insert User data');
      }
      return redirect()->back()->with('message', 'User is successfully added with username:'.strtolower($user_email).'  Password: '.strtoupper($request->lname).'1234');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user=DB::select(
            "SELECT users.first_name, users.id, users.last_name, users.email, roles.role_name,users.created_at FROM users, roles, users_roles WHERE
            users_roles.role_id = roles.id AND users_roles.user_id = users.id AND users.id= $id");

       return view('manageUser.showUser')->with('userInfo',$user);
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
       $user = User::findOrFail($id);

       $leve = Role::all();

       return view('manageUser.editUser')->with('userInfo',$user)->with('leve',$leve) ;
        /*$userinfo =DB::select(
            "SELECT * FROM users WHERE
            users.id = $id");

        //dd( $userinfo);
        return view('manageUser.editUser')->with('userInfo',$userinfo);*/
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

         $user = User::findOrFail($id);
         $this->validate(request(), [
            'fname'=> 'required',
            'lname'=> 'required',
            'useremail'=> 'required',
        ]);

         $user->first_name = $request->fname;
         $user->last_name = $request->lname;
         $user->email = $request->useremail;
         $st = $user->save();
         if (!$st) {
            return redirect()->back()->with('message', 'Failed to Update User data');
        }

        return redirect('/manage-users')->with('message', 'User is successfully updated');
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
            if(\Auth::user()->can('delete_user')){
                return $next($request);
            }
            return redirect()->back();
        });
        $uid=\Auth::id();
        $user = User::findOrFail($id);
        $user->delete();
        $request->session()->flash('message', 'User is successfully deleted');
        return back();
    }

    //change user to active or inactive
    public function change_status_json(Request $request){
        $val = $request->get('value');
        $data = explode(":",$val);
        $userId = (int) $data[0];
        $statusUser = (boolean) $data[1];

        $user = User::findOrFail($userId);

        if ($statusUser) {
            $user->userStatus = 0;
            $st = $user->save();
        } else {
            $user->userStatus = 1;
            $st = $user->save();
        }

        return json_encode($st);
    }

    // Reset password for users
    public function resetpassword($id){
        $this->middleware(function($request,$next){
            if(\Auth::user()->can('edit_user')){
                return $next($request);
            }
            return redirect()->back();
        });
        // dd($id);

        $user = User::findOrFail($id);
         $st = User::findOrFail($id)->update(['password'=>bcrypt('123456')]);
         if (!$st) {
            return redirect()->back()->with('message', 'Failed to reset User Password For'.$user->first_name);
        }

        return redirect('/manage-users')->with('message', 'Password is Successfully reseted For User '.$user->first_name);
    }

    public function pdf(Request $request)
    {
       $str_var = $_POST['tad'];
       $userData = unserialize(base64_decode($str_var));

       if($request->view_type === 'downloadPdf'){
        $pdf = PDF::loadView('manageUser.pdf-user', ['userData' => $userData]);
        return $pdf->download('users.pdf');
        }

    }

    //Download Excel
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
                $sheet->cell('B1',function($cell){ $cell->setValue('First Name');});
                $sheet->cell('C1',function($cell){ $cell->setValue('Last Name');});
                $sheet->cell('D1',function($cell){ $cell->setValue('Email');});
                $sheet->cell('E1',function($cell){ $cell->setValue('Privilege');});
                $sheet->cell('F1',function($cell){ $cell->setValue('Date Created');});

                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                            $i = $key + 2;
                            //dd($value);
                            $sheet->cell('A'.$i, $key + 1);
                            $sheet->cell('B'.$i, $value->first_name);
                            $sheet->cell('C'.$i, $value->last_name);
                            $sheet->cell('D'.$i, $value->email);
                            $sheet->cell('E'.$i, $value->role_name);
                            $sheet->cell('F'.$i, $value->created_at);
                    }
                    //$sheet->mergeCells('A5:B5');
                    $sheet->setTitle('UmojaSwitch Co. Ltd');
                }
            });
        })->download($type);
    }
}
