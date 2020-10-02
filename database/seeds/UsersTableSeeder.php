<?php

use Illuminate\Database\Seeder;
//use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;
use App\Role;
use App\Status;
use App\UsersStatus;
use App\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $admin_role = Role::where('role_slug','administrator')->first();
        $finance_role = Role::where('role_slug', 'finance')->first();
        $dev_perm = Permission::where('permission_slug','create')->first();
        $finance_perm = Permission::where('permission_slug','edit')->first();
        $status=Status::where('status_slug',false)->first();

        $admin = new User();
        $admin->first_name = 'Edwin';
        $admin->last_name = 'Exaud';
        $admin->email = 'edwin.exaud@umojaswitch.co.tz';
        $admin->userStatus = 1;
        $admin->password = bcrypt('123456');
        $admin->created_at = Carbon::now();
        $admin->updated_at = Carbon::now();
        $admin->save();
        $admin->roles()->attach($admin_role);
        $admin->permissions()->attach($dev_perm);
        if ($admin) {
            $users_status=new UsersStatus();
            $users_status->status_id=$status->id;
            $users_status->user_id=$admin->id;
            $users_status->save();

        }       


        $finance = new User();
        $finance->first_name = 'Michael';
        $finance->last_name = 'Peter';
        $finance->email = 'michael.peter@umojaswitch.co.tz';
        $finance->userStatus = 0;
        $finance->password = bcrypt('123456');
        $finance->created_at = Carbon::now();
        $finance->updated_at = Carbon::now();
        $finance->save();
        $finance->roles()->attach($finance_role);
        $finance->permissions()->attach($finance_perm);
        if ($finance) {
            $users_status=new UsersStatus();
            $users_status->status_id=$status->id;
            $users_status->user_id=$finance->id;
            $users_status->save();

        }
        
        
    }
}
