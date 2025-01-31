<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsTableSeeder extends Seeder
{
    public function run()
    {
        $departments = [
            ['dept_no' => 'D001', 'dept_name' => 'Software Development'],
            ['dept_no' => 'D002', 'dept_name' => 'Quality Assurance'],
            ['dept_no' => 'D003', 'dept_name' => 'User Experience (UX) Design'],
            ['dept_no' => 'D004', 'dept_name' => 'Data Science'],
            ['dept_no' => 'D005', 'dept_name' => 'DevOps'],
            ['dept_no' => 'D006', 'dept_name' => 'Project Management'],
            ['dept_no' => 'D007', 'dept_name' => 'Technical Support'],
            ['dept_no' => 'D008', 'dept_name' => 'System Administration'],
            ['dept_no' => 'D009', 'dept_name' => 'Web Development'],
            ['dept_no' => 'D010', 'dept_name' => 'Mobile Application Development'],
        ];

        DB::table('departments')->insert($departments);
    }
}
