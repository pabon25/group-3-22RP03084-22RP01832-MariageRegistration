<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->string('registrar_name')->nullable()->change();
            $table->string('registrar_designation')->nullable()->change();
            $table->string('registration_office')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->string('registrar_name')->nullable(false)->change();
            $table->string('registrar_designation')->nullable(false)->change();
            $table->string('registration_office')->nullable(false)->change();
        });
    }
};
