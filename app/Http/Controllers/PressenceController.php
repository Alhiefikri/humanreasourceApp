<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Pressence;
use Carbon\Carbon;
use Illuminate\Http\Request;



class PressenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Pressence $pressence)
    {
        if (session('role') == 'HR') {
            $pressences = Pressence::all();
        } else {
            $pressences = Pressence::where('employee_id', session('employee_id'))->get();
        }
        return view('pressences.index', compact('pressences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Employee $employee)
    {
        $employees = Employee::all();
        return view('pressences.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (session('role') == 'HR') {
            $validated = $request->validate([
                'employee_id' => 'required|string',
                'check_in' => 'required',
                'check_out' => 'required',
                'date' => 'required|date',
                'status' => 'required|string',
            ]);
            Pressence::create($validated);
        } else {
            Pressence::create([
                'employee_id' => session('employee_id'),
                'check_in' => Carbon::now()->format('Y-m-d H:i:s'),
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'date' => Carbon::now()->format('Y-m-d'),
                'status' => 'present',
            ]);
        }



        return redirect()->route('pressences.index')->with('success', 'Pressence Recorded successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pressence $pressence, Employee $employee)
    {
        $employees = Employee::all();
        return view('pressences.edit', compact('pressence', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pressence $pressence)
    {
        $validated = $request->validate([
            'employee_id' => 'required|string',
            'check_in' => 'required',
            'check_out' => 'required',
            'date' => 'required|date',
            'status' => 'required|string',
        ]);

        $pressence->update($validated);

        return redirect()->route('pressences.index')->with('success', 'Pressence updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pressence $pressence)
    {
        $pressence->delete();
        return redirect()->route('pressences.index')->with('success', 'Pressence deleted successfully');
    }
}
