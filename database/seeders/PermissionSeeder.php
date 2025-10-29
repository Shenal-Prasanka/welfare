<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Optional: Clear old cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            "role-list",
            "role-create",
            "role-edit",
            "role-delete",
            "product-list",
            "product-create",
            "product-edit",
            "product-delete",
            "product-approve",
            "product-reject",
            "welfare-create",
            "welfare-list",
            "welfare-edit",
            "welfare-delete",
            "welfare-approve",
            "welfare-reject",
            "supplier-list",
            "supplier-create",
            "supplier-edit",
            "supplier-delete",
            "supplier-approve",
            "supplier-reject",
            "item-list",
            "item-create",
            "item-approve",
            "item-reject",
            "priceList-list",
            "priceList-create",
            "priceList-edit",
            "order-list",
            "order-create",
            "order-edit",
            "order-approve",
            "order-reject"
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $shopcoordoc = Role::firstOrCreate(['name' => 'Shop Coord OC']);
        $shopcoordclerk = Role::firstOrCreate(['name' => 'Shop Coord Clerk']);
        $welfareshopclerk = Role::firstOrCreate(['name' => 'Welfare Shop Clerk']);
        $welfareshopoc = Role::firstOrCreate(['name' => 'Welfare Shop OC']);


        // Assign permissions to roles
        $admin->givePermissionTo(Permission::all());
        $shopcoordoc->givePermissionTo(['product-list', 'product-edit','product-approve','welfare-list','welfare-edit','welfare-approve','supplier-list','supplier-edit','supplier-approve','order-list','order-reject','order-approve','order-edit']);
        $shopcoordclerk->givePermissionTo(['product-list', 'product-create','product-delete','welfare-list','welfare-create','welfare-delete','supplier-list','supplier-create','supplier-delete','order-list','order-reject','order-approve','order-edit']);
        $welfareshopclerk ->givePermissionTo(['order-list','order-create','order-edit']);
        $welfareshopoc ->givePermissionTo(['order-list','order-approve','order-reject','order-edit']);
    }
}
