<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$roles=[
			'admin',
			'user'
		];
		$permissions=[
			'dashboard'=>['admin'],
			'file-manager'=>['admin'],
			'langfile-manager'=>['admin'],
			'backup-manager'=>['admin'],
			'log-manager'=>['admin'],
			'settings'=>['admin'],
			'page-manager'=>['admin'],
			'permission-manager'=>['admin'],
			'menu-crud'=>['admin'],
			'news-crud '=>['admin'],
		];
		//create roles
		foreach ($roles as $role) {
			$rolesArray[$role]=Role::create(['name' => $role]);
		}
		//create permissions
		foreach ($permissions as $permission=>$authorized_roles) {
			//create permission
			Permission::create(['name' => $permission]);
			
			//authorize roles to those permissions
			foreach ($authorized_roles as $role) {
				$rolesArray[$role]->givePermissionTo($permission);
			}
		}
		
    }
}