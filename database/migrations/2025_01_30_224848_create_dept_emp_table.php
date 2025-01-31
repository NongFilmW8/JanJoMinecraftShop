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
        Schema::create('dept_emp', function (Blueprint $table) {
            // 1. กำหนดคอลัมน์หลัก (Composite Primary Key)
            $table->integer('emp_no')->unsigned();
            $table->string('dept_no', 4);

            // 2. กำหนดคอลัมน์เพิ่มเติม
            $table->date('from_date');
            $table->date('to_date');

            // 3. ตั้งค่า Primary Key
            $table->primary(['emp_no', 'dept_no']);

            // 4. กำหนด Foreign Key
            $table->foreign('emp_no')
                  ->references('emp_no')
                  ->on('employees')
                  ->onDelete('cascade'); // หากลบข้อมูลใน employees ให้ลบข้อมูลที่นี่ด้วย

            $table->foreign('dept_no')
                  ->references('dept_no')
                  ->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dept_emp');
    }
};
