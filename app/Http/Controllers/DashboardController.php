<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Pressence;
use App\Models\Task;
use Illuminate\Http\Request;
use PDO;

class DashboardController extends Controller
{
    public function index()
    {
        $employees = Employee::count();
        $department = Department::count();
        $payroll = Payroll::count();
        $pressence = Pressence::count();

        $tasks = Task::all();

        return view('dashboard.index', compact('employees', 'department', 'payroll', 'pressence', 'tasks'));
    }

    public function pressence()
    {
        $data = Pressence::where('status', 'present')
            ->selectRaw('MONTH(date) as month, YEAR(date) as year, COUNT(*) as total_present')
            ->groupBy('year', 'month')
            ->orderBy('month', 'asc')
            ->get();

        $temp = [];
        $i = 0;

        foreach ($data as $item) {
            $temp[$i] = $item->total_present;
            $i++;
        }

        return response()->json($temp);
    }
}
