<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('results', function (Blueprint $table) {
            $table->string('gender')->nullable();
            $table->string('age')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('patient_name')->nullable();
            $table->string('bill_id')->nullable();
            $table->string('lab_patient_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('results', function (Blueprint $table) {
            $table->dropColumn('gender');
            $table->dropColumn('age');
            $table->dropColumn('contact_no');
            $table->dropColumn('patient_name');
            $table->dropColumn('bill_id');
            $table->dropColumn('lab_patient_id');
        });
    }
};
