<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller; //make middleware available in this file



class EmployeeController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth'); // Ensures that only authenticated users can access this controller's methods
    }

    public function index()
    {
    //   if (Auth::user()->role === 'admin') {
    //     // Fetch all employees for admin
    //     $employees = Employee::all();
    //     return view('dashboard', compact('employees'));
    // } else {
    //     // Fetch only the current logged-in employee's record
    //     $employee = Auth::user()->employee; // Ensure the relationship exists in the User model
    //     return view('dashboard', compact('employee'));
    // }

    $employees = Employee::all();
    return view('welcome', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
