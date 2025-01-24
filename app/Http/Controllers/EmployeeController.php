<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('search');
        $sortBy = $request->input('sortBy', 'emp_no');
        $sortDirection = $request->input('sortDirection', 'asc');

        $employees = DB::table("employees")
            ->where('first_name', 'like', '%' . $query . '%')
            ->orwhere('emp_no', $query)
            ->orWhere('last_name', 'like', '%' . $query . '%')
            ->paginate(10);
        return Inertia::render('Employee/Index', [
            'employees' => $employees,
            'query' => $query,
            'sortBy' => $sortBy,
            'sortDirection' => $sortDirection,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // ดึงรายชื่อแผนกจากฐานข้อมูล
        $departments = DB::table('departments')->select('dept_no', 'dept_name')->get();
        // ส่งข้อมูลไปยังหน้า Inertia
        return inertia('Employee/Create', ['departments' => $departments]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'hire_date' => 'required|date',
            'dept_no' => 'required|string|exists:departments,dept_no',
            'gender' => 'required|string|in:Male,Female,Other',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // บันทึกข้อมูลแต่ละช่องใน Laravel Log
        Log::info("Employee Data");
        Log::info('"First Name": "' . $validated['first_name'] . '"');
        Log::info('"Last Name": "' . $validated['last_name'] . '"');
        Log::info('"Birth Date": "' . $validated['birth_date'] . '"');
        Log::info('"Hire Date": "' . $validated['hire_date'] . '"');
        Log::info('"Department No": "' . $validated['dept_no'] . '"');

        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        }
        DB::transaction(function () use ($validated, $profilePicturePath, &$newEmpNo) {
            $newEmpNo = DB::table('employees')->lockForUpdate()->max('emp_no') + 1;

            // เพิ่มข้อมูลลงในตาราง employees
            DB::table('employees')->insert([
                'emp_no' => $newEmpNo,
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'birth_date' => $validated['birth_date'],
                'hire_date' => $validated['hire_date'],
                'gender' => $validated['gender'] === 'Male' ? 'M' : ($validated['gender'] === 'Female' ? 'F' : 'O'),
                'profile_picture' => $profilePicturePath,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // เพิ่มข้อมูลลงในตาราง dept_emp
            DB::table('dept_emp')->insert([
                'emp_no' => $newEmpNo,
                'dept_no' => $validated['dept_no'],
                'from_date' => now(),
                'to_date' => now()->addYears(5)->format('Y-m-d'),
            ]);
        });
try {
            // ส่งกลับไปหน้ารายการพนักงานพร้อมข้อความแจ้งเตือน
            return redirect()->route('employees.index')
                ->with('success', 'Employee created successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to create employee. Please try again.');


        }
        // เพิ่มข้อมูลพนักงานใหม่


        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
