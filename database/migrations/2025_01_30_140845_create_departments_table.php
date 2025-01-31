<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('departments', function (Blueprint $table) {
        $table->string('dept_no', 4)->primary(); // ✅ ต้องเป็น dept_no
        $table->string('dept_name');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('departments'); // แก้จาก employees เป็น departments
}
};
