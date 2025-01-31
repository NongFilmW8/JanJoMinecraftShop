<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1. ลบเฉพาะ Foreign Key ในตาราง employees (ไม่ต้องดรอปจาก dept_emp)
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['dept_no']);
        });

        // 2. ดรอป Primary Key และคอลัมน์ emp_no เดิม
        Schema::table('employees', function (Blueprint $table) {
            $table->dropPrimary();
            $table->dropColumn('emp_no');
        });

        // 3. สร้างคอลัมน์ emp_no ใหม่เป็น integer
        Schema::table('employees', function (Blueprint $table) {
            $table->integer('emp_no')->unsigned()->primary();
        });

        // 4. สร้าง Foreign Key ใหม่
        Schema::table('employees', function (Blueprint $table) {
            $table->foreign('dept_no')->references('dept_no')->on('departments');
        });
    }

    public function down()
    {
        // ย้อนกลับ
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['dept_no']);
            $table->dropColumn('emp_no');
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->string('emp_no')->primary();
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->foreign('dept_no')->references('dept_no')->on('departments');
        });
    }
};
