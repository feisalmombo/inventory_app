<?php

use Illuminate\Database\Seeder;
use App\Permissions\HasPermissionsTrait;
use App\Role;
use App\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fin_role = Role::where('role_slug','finance')->first();
        $manager_role = Role::where('role_slug', 'stock_manager')->first();
        $admin_role = Role::where('role_slug', 'administrator')->first();
        $eng_role = Role::where('role_slug', 'engineer')->first();

        $createUser = new Permission();
        $createUser->permission_slug = 'create_user';
        $createUser->permission_name = 'Create User';
        $createUser->save();
        $createUser->roles()->attach($admin_role);

        $createStore = new Permission();
        $createStore->permission_slug = 'create_store';
        $createStore->permission_name = 'Create Store';
        $createStore->save();
        $createStore->roles()->attach($manager_role);
        $createStore->roles()->attach($admin_role);

        $createCategory = new Permission();
        $createCategory->permission_slug = 'create_category';
        $createCategory->permission_name = 'Create Category';
        $createCategory->save();
        $createCategory->roles()->attach($manager_role);
        $createCategory->roles()->attach($admin_role);

        $createProduct = new Permission();
        $createProduct->permission_slug = 'create_product';
        $createProduct->permission_name = 'Create Product';
        $createProduct->save();
        $createProduct->roles()->attach($manager_role);
        $createProduct->roles()->attach($admin_role);

        $createPrice = new Permission();
        $createPrice->permission_slug = 'create_price';
        $createPrice->permission_name = 'Create Price';
        $createPrice->save();
        $createPrice->roles()->attach($fin_role);

        $editUsers = new Permission();
        $editUsers->permission_slug = 'edit_user';
        $editUsers->permission_name = 'Edit User';
        $editUsers->save();
        $editUsers->roles()->attach($admin_role);

        $editStore = new Permission();
        $editStore->permission_slug = 'edit_store';
        $editStore->permission_name = 'Edit Store';
        $editStore->save();
        $editStore->roles()->attach($manager_role);
        $editStore->roles()->attach($admin_role);

        $editCategory = new Permission();
        $editCategory->permission_slug = 'edit_category';
        $editCategory->permission_name = 'Edit Category';
        $editCategory->save();
        $editCategory->roles()->attach($manager_role);
        $editCategory->roles()->attach($admin_role);

        $editProduct = new Permission();
        $editProduct->permission_slug = 'edit_product';
        $editProduct->permission_name = 'Edit Product';
        $editProduct->save();
        $editProduct->roles()->attach($manager_role);
        $editProduct->roles()->attach($admin_role);

        $editPrice = new Permission();
        $editPrice->permission_slug = 'edit_price';
        $editPrice->permission_name = 'Edit Price';
        $editPrice->save();
        $editPrice->roles()->attach($fin_role);
        
        $deleteUsers = new Permission();
        $deleteUsers->permission_slug = 'delete_user';
        $deleteUsers->permission_name = 'Delete User';
        $deleteUsers->save();
        $deleteUsers->roles()->attach($admin_role);

        $deleteStore = new Permission();
        $deleteStore->permission_slug = 'delete_store';
        $deleteStore->permission_name = 'Delete Store';
        $deleteStore->save();
        $deleteStore->roles()->attach($admin_role);
        $deleteStore->roles()->attach($manager_role);

        $deleteCategory = new Permission();
        $deleteCategory->permission_slug = 'delete_category';
        $deleteCategory->permission_name = 'Delete Category';
        $deleteCategory->save();
        $deleteCategory->roles()->attach($manager_role);
        $deleteCategory->roles()->attach($admin_role);

        $deleteProduct = new Permission();
        $deleteProduct->permission_slug = 'delete_product';
        $deleteProduct->permission_name = 'Delete Product';
        $deleteProduct->save();
        $deleteProduct->roles()->attach($manager_role);
        $deleteProduct->roles()->attach($admin_role);

        $deletePrice = new Permission();
        $deletePrice->permission_slug = 'delete_price';
        $deletePrice->permission_name = 'Delete Price';
        $deletePrice->save();
        $deletePrice->roles()->attach($fin_role);
        $deletePrice->roles()->attach($admin_role);

        
        $viewUser = new Permission();
        $viewUser->permission_slug = 'view_user';
        $viewUser->permission_name = 'View User';
        $viewUser->save();
        $viewUser->roles()->attach($admin_role);

        $viewStore = new Permission();
        $viewStore->permission_slug = 'view_store';
        $viewStore->permission_name = 'View Store';
        $viewStore->save();
        $viewStore->roles()->attach($manager_role);
        $viewStore->roles()->attach($admin_role);
        $viewStore->roles()->attach($eng_role);

        $viewCategory = new Permission();
        $viewCategory->permission_slug = 'view_category';
        $viewCategory->permission_name = 'View Category';
        $viewCategory->save();
        $viewCategory->roles()->attach($manager_role);
        $viewCategory->roles()->attach($admin_role);
        $viewCategory->roles()->attach($eng_role);

        $viewProduct = new Permission();
        $viewProduct->permission_slug = 'view_product';
        $viewProduct->permission_name = 'View Product';
        $viewProduct->save();
        $viewProduct->roles()->attach($manager_role);
        $viewProduct->roles()->attach($admin_role);
        $viewProduct->roles()->attach($eng_role);

        $viewPrice = new Permission();
        $viewPrice->permission_slug = 'view_price';
        $viewPrice->permission_name = 'View Price';
        $viewPrice->save();
        $viewPrice->roles()->attach($fin_role);
        $viewPrice->roles()->attach($admin_role);
        $viewPrice->roles()->attach($manager_role);

        $needProduct = new Permission();
        $needProduct->permission_slug = 'request_product';
        $needProduct->permission_name = 'Request Product';
        $needProduct->save();
        $needProduct->roles()->attach($eng_role);

        $reqConfirm = new Permission();
        $reqConfirm->permission_slug = 'confirm_request';
        $reqConfirm->permission_name = 'Confirm Request';
        $reqConfirm->save();
        $reqConfirm->roles()->attach($manager_role);
        $reqConfirm->roles()->attach($admin_role);

    }
}
