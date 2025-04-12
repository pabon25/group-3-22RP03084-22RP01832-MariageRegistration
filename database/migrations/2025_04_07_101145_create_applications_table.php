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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Spouse details
            $table->string('spouse_name');
            $table->enum('spouse_gender', ['Male', 'Female']);
            $table->date('spouse_dob');
            $table->string('spouse_email')->unique();
            $table->string('spouse_phone');
            $table->text('spouse_address');

            // Witness details
            $table->string('witness_name');
            $table->string('witness_contact');

            // Marriage details
            $table->date('marriage_date');
            $table->text('marriage_location');

            // Document uploads
            $table->string('groom_id_card');
            $table->string('groom_passport_photo');
            $table->string('bride_id_card');
            $table->string('bride_passport_photo');

            // Application status
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->text('admin_remarks')->nullable();
            $table->timestamp('approval_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};