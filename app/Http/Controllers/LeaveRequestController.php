<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LeaveRequest $leaveRequest, Employee $employee)
    {
        $leaveRequests = LeaveRequest::all();
        $employees = Employee::all();
        return view('leave-requests.index', compact('leaveRequests', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Employee $employee)
    {
        $employees = Employee::all();

        return view('leave-requests.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|string',
            'leave_type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        // default value pending
        $validated['status'] = 'pending';

        LeaveRequest::create($validated);

        return redirect()->route('leave-requests.index')->with('success', 'Leave request created successfully');
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
    public function edit(Employee $employee, LeaveRequest $leaveRequest)
    {
        $employees = Employee::all();
        return view('leave-requests.edit', compact('leaveRequest', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LeaveRequest $leaveRequest)
    {
        $validated = $request->validate([
            'employee_id' => 'required|string',
            'leave_type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $leaveRequest->update($validated);

        return redirect()->route('leave-requests.index')->with('success', 'Leave request updated successfully');
    }

    public function approve(int $id)
    {
        $leaveRequest = LeaveRequest::findorFail($id);
        $leaveRequest->update(['status' => 'approved']);
        return redirect()->route('leave-requests.index')->with('success', 'Leave request approved successfully');
    }

    public function reject(int $id)
    {
        $leaveRequest = LeaveRequest::findorFail($id);
        // Jika status sudah bukan pending, jangan kasih approve lagi!


        $leaveRequest->update(['status' => 'rejected']);
        return redirect()->route('leave-requests.index')->with('success', 'Leave request rejected successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeaveRequest $leaveRequest)
    {
        $leaveRequest->delete();

        return redirect()->route('leave-requests.index')->with('success', 'Leave request deleted successfully');
    }
}
