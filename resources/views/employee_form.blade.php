<div class="row align-items-center mb-3">
  <label for="fname" class="col-sm-2 col-form-label">First Name:</label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="fname" name="fname" value="{{ old('fname', $employee->first_name ?? '') }}" required>
  </div>
  
  <label for="lname" class="col-sm-2 col-form-label">Last Name:</label>
  <div class="col-sm-4">    
    <input type="text" class="form-control" id="lname" name="lname" value="{{ old('lname', $employee->last_name ?? '') }}" required>
  </div>
</div>

<div class="row align-items-center mb-3">
  <label for="position" class="col-sm-2 col-form-label">Position:</label>
  <div class="col-sm-4">    
    <input type="text" class="form-control" id="position" name="position" value="{{ old('position', $employee->position ?? '') }}" required>
  </div>

  <label for="department" class="col-sm-2 col-form-label">Department:</label>
  <div class="col-sm-4">

    <select id="department" name="department" class="form-select" required>
      <option value="" selected>Please select</option>
      @foreach ($departments as $department)         
          <option value="{{ $department->id }}" {{ isset($employee) && $employee->department_id == $department->id ? 'selected' : '' }}>
            {{ $department->name }}
          </option>
      @endforeach
    </select>

  </div>
</div>

<div class="row align-items-center mb-3">
  <label for="date_of_employment" class="col-sm-2 col-form-label">Date of Employment:</label>
  <div class="col-sm-4">    
    <input type="date" class="form-control" id="date_of_employment" name="date_of_employment" value="{{ old('date_of_employment', $employee->date_of_employment ?? '') }}" required>
  </div>

  <label for="salary" class="col-sm-2 col-form-label">Salary:</label>
  <div class="col-sm-4">    
    <input type="number" class="form-control" id="salary" name="salary" value="{{ old('salary', $employee->salary ?? '') }}" step="0.01" min="0" required>
  </div>
</div>

<div class="row align-items-center mb-3">
  <label for="phone_num" class="col-sm-2 col-form-label">Phone Number:</label>
  <div class="col-sm-4">   
    <input type="text" class="form-control" id="phone_num" name="phone_num" value="{{ old('phone_num', $employee->phone_num ?? '') }}" required>
  </div>
</div>

<div class="d-flex justify-content-start">
  <button type="submit" class="btn btn-primary">Submit</button>
  <a href="/dashboard" class="btn btn-light ms-2">Cancel</a>
</div>


{{-- Notes: 
{{ }}: This is Blade's syntax for echoing PHP data. It automatically escapes the data to prevent XSS (cross-site scripting) attacks by converting special characters (like <, >, and &) into their HTML entity equivalents. --}}