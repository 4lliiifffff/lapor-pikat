<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        $viewReports = Permission::firstOrCreate(['name' => 'view-reports']);
        $manageReports = Permission::firstOrCreate(['name' => 'manage-reports']);

        // Create Roles and assign permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions([$viewReports, $manageReports]);

        $officerRole = Role::firstOrCreate(['name' => 'officer']);
        $officerRole->syncPermissions([$viewReports, $manageReports]);

        // Create or update Admin User
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@pkbm.id'],
            [
                'name' => 'Admin PKBM Pintar Berbakat',
                'password' => Hash::make('password'),
            ]
        );
        $adminUser->syncRoles([$adminRole]);

        // Create or update Officer / Tutor User
        $tutorUser = User::firstOrCreate(
            ['email' => 'tutor@pkbm.id'],
            [
                'name' => 'Bu Siti (Tutor Bimbingan)',
                'password' => Hash::make('password'),
            ]
        );
        $tutorUser->syncRoles([$officerRole]);
    }
}
