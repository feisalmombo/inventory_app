<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Role;
use App\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$manager_permission = Permission::where('permission_slug','create_product')->first();
        $finance_permission = Permission::where('permission_slug', 'edit_price')->first();
        $admin_permission = Permission::where('permission_slug', 'create_users')->first();
        $eng_permission = Permission::where('permission_slug', 'request_product')->first();

        //RoleTableSeeder.php

        $finance_role = new Role();
        $finance_role->role_slug = 'finance';
        $finance_role->role_name = 'Finance';
        $finance_role->save();
		$finance_role->permissions()->attach($finance_permission);
		
        $admin=new Role();
    	$admin->role_slug = 'administrator';
    	$admin->role_name = 'Administrator';
    	$admin->save();
		$admin->permissions()->attach($admin_permission);

		$admin=new Role();
    	$admin->role_slug = 'stock_manager';
    	$admin->role_name = 'Stock Manager';
    	$admin->save();
		$admin->permissions()->attach($manager_permission);

		$admin=new Role();
    	$admin->role_slug = 'engineer';
    	$admin->role_name = 'Engineer';
    	$admin->save();
		$admin->permissions()->attach($eng_permission);

		
    	
    }
}
