<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if the admin user exists
        $adminUser = DB::table('users')->where('email', 'admin@admin.com')->first();

        if ($adminUser) {
            // Update the admin user's is_admin attribute to true
            DB::table('users')
                ->where('email', 'admin@admin.com')
                ->update(['is_admin' => true]);

            echo "Admin user updated successfully.\n";
        } else {
            // Create the admin user if it doesn't exist
            DB::table('users')->insert([
                'full_name' => 'Admin User',
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
                'phone_number' => '0700000000',
                'address' => 'Admin Office',
                'dob' => '1990-01-01',
                'gender' => 'Male',
                'is_admin' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            echo "Admin user created successfully.\n";
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to reverse this migration
    }
};