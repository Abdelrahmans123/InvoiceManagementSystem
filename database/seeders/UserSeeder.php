<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Abdelrahman Salah',
            'email' => 'sabdelrahman110@gmail.com',
            'password' => bcrypt('12345678'),
            'roles_name' => json_encode(["owner"]),
            'Status' => 'مفعل',
            ]);
            $role = Role::create(['name' => 'owner']);
            $permissions = Permission::pluck('id','id')->all();
            $role->syncPermissions($permissions);
            $user->assignRole([$role->id]);
    }
}
