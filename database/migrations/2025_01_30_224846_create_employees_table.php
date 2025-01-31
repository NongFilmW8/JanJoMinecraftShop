<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->string('emp_no')->primary(); // ✅ ต้องเป็น emp_no (ไม่ใช่ dept_no)
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birth_date');
            $table->enum('gender', ['M', 'F', 'O']);
            $table->date('hire_date');
            $table->string('dept_no', 4);
            $table->foreign('dept_no')->references('dept_no')->on('departments');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
