<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $normalRole = Role::create(['name' => 'normal']);
        $adminRole = Role::create(['name' => 'admin']);
        $confirmPaymentPermission = Permission::create(['name' => 'confirmPayment']);
        $seeScreenAuditPendentsPermission = Permission::create(['name' => 'seeScreenAuditPendents']);
        $seeScreenAuditConfirmedPermission = Permission::create(['name' => 'seeScreenAuditConfirmed']);

        $registerUserPermission = Permission::create(['name' => 'registerUser']);

        $normalRole->givePermissionTo($seeScreenAuditPendentsPermission);
        $normalRole->givePermissionTo($registerUserPermission);
        $seeScreenAuditPendentsPermission->assignRole($normalRole);
        $registerUserPermission->assignRole($normalRole);

        $adminRole->givePermissionTo($seeScreenAuditPendentsPermission);
        $adminRole->givePermissionTo($confirmPaymentPermission);
        $adminRole->givePermissionTo($seeScreenAuditConfirmedPermission);
        $adminRole->givePermissionTo($registerUserPermission);
        
        $seeScreenAuditPendentsPermission->assignRole($adminRole);
        $confirmPaymentPermission->assignRole($adminRole);
        $seeScreenAuditConfirmedPermission->assignRole($adminRole);
        $registerUserPermission->assignRole($adminRole);
    }
}
