<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
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
      if (Auth::user()->role === 'admin') {
        $employees = Employee::with('department')->get(); // Admin sees all employees
        return view('dashboard', compact('employees'));
      } else {        
        $employee = Auth::user()->employee;
        return view('dashboard', compact('employee'));
      }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $departments = Department::all(); // Fetch all departments
      return view('add', compact('departments')); // Pass departments to the view
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      // Validate data based on customised rules
      $validated = $request->validate([
        'fname' => 'required|string|max:100',
        'lname' => 'required|string|max:100',
        'position' => 'required|string|max:100',
        'department' => 'required|exists:departments,id',
        'date_of_employment' => 'required|date',
        'salary' => 'required|numeric|min:0',
        'phone_num' => 'required|string|max:15',
      ]);

      // Sanitize input to prevent XSS and trim unnecessary spaces
      $validated['fname'] = htmlspecialchars(trim($validated['fname']), ENT_QUOTES, 'UTF-8');
      $validated['lname'] = htmlspecialchars(trim($validated['lname']), ENT_QUOTES, 'UTF-8');
      $validated['position'] = htmlspecialchars(trim($validated['position']), ENT_QUOTES, 'UTF-8');
      $validated['phone_num'] = htmlspecialchars(trim($validated['phone_num']), ENT_QUOTES, 'UTF-8');
      
      // Create the User account first
      $user = User::create([
        'name' => $validated['fname'] . ' ' . $validated['lname'],
        'email' => strtolower($validated['fname']) . $validated['lname'] . '@example.com',
        'password' => bcrypt('password'), // Default password
        'role' => 'employee', // Assign 'employee' role
        ]);
        
      // Now create the Employee, including the user_id in the creation
      $employee = Employee::create([
        'first_name' => $validated['fname'],
        'last_name' => $validated['lname'],
        'position' => $validated['position'],
        'department_id' => $validated['department'],
        'date_of_employment' => $validated['date_of_employment'],
        'salary' => $validated['salary'],
        'phone_num' => $validated['phone_num'],
        'user_id' => $user->id, // Associate the created user with the employee
        ]);

      // After the Employee is created, update the email to include employee ID
      $user->update([
        'email' => strtolower($validated['fname']) . $employee->id . '@example.com', 
        ]);

      return redirect()->route('dashboard')->with('success', 'Employee created successfully and user account created.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
      // Check if an 'id' is provided in the request
      if ($request->has('id') && !empty($request->input('id'))) {
        // Validate the 'id' input
        $validated = $request->validate([
          'id' => 'required|integer|exists:employees,id',
        ]);
                
        $employee = Employee::find($validated['id']);
        return view('dashboard', compact('employee'));
      }
      else {
      $employees = Employee::all();
      return view('dashboard', compact('employees'));
    }}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
      // Retrieve the employee by the ID
      $employee = Employee::findOrFail($id); // Use findOrFail to ensure the employee exists
      
      // Fetch all departments for the select field
      $departments = Department::all();
      
      // Return the edit view with the employee data and departments
      return view('edit', compact('employee', 'departments'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
      $validated = $request->validate([
        'fname' => 'required|string|max:100',
        'lname' => 'required|string|max:100',
        'position' => 'required|string|max:100',
        'department' => 'required|exists:departments,id',
        'date_of_employment' => 'required|date',
        'salary' => 'required|numeric|min:0',
        'phone_num' => 'required|string|max:15',
      ]);

      // Sanitize input to prevent XSS and trim unnecessary spaces
      $validated['fname'] = htmlspecialchars(trim($validated['fname']), ENT_QUOTES, 'UTF-8');
      $validated['lname'] = htmlspecialchars(trim($validated['lname']), ENT_QUOTES, 'UTF-8');
      $validated['position'] = htmlspecialchars(trim($validated['position']), ENT_QUOTES, 'UTF-8');
      $validated['phone_num'] = htmlspecialchars(trim($validated['phone_num']), ENT_QUOTES, 'UTF-8');
      
      // Find the employee
      $employee = Employee::findOrFail($id);
      
      // Update the employee details
      $employee->update([
        'first_name' => $validated['fname'],
        'last_name' => $validated['lname'],
        'position' => $validated['position'],
        'department_id' => $validated['department'],
        'date_of_employment' => $validated['date_of_employment'],
        'salary' => $validated['salary'],
        'phone_num' => $validated['phone_num'],
      ]);
      
      // Update the user associated with the employee
      $employee->user->update([
        'name' => $validated['fname'] . ' ' . $validated['lname'],
        'email' => strtolower($validated['fname']) . $employee->id . '@example.com',
      ]);
        
      return redirect()->route('dashboard')->with('success', 'Employee record updated successfully and user account updated.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
      if (Auth::user()->role !== 'admin') {
        return redirect()->route('dashboard')->with('error', 'Unauthorized action.');
      }

      // Delete the associated user account (if exists)
      if ($employee->user) {
        $employee->user->delete();  // This deletes the related User account
      }
      
      // Delete the employee record
      $employee->delete();
      
      return redirect()->route('dashboard')->with('success', 'Employee deleted successfully.');
    }
  }