<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
  <!-- First Name -->
  <div>
    <label for="fname" class="block text-sm font-medium text-gray-700 mb-1">First Name:</label>
    <input type="text" id="fname" name="fname" value="{{ old('fname', $employee->first_name ?? '') }}" required
      class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
  </div>
  
  <!-- Last Name -->
  <div>
    <label for="lname" class="block text-sm font-medium text-gray-700 mb-1">Last Name:</label>
    <input type="text" id="lname" name="lname" value="{{ old('lname', $employee->last_name ?? '') }}" required
      class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
  </div>

  <!-- Position -->
  <div>
    <label for="position" class="block text-sm font-medium text-gray-700 mb-1">Position:</label>
    <input type="text" id="position" name="position" value="{{ old('position', $employee->position ?? '') }}" required
      class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
  </div>

  <!-- Department -->
  <div>
    <label for="department" class="block text-sm font-medium text-gray-700 mb-1">Department:</label>
    <select id="department" name="department" required
      class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
      <option value="" selected>Please select</option>
      @foreach ($departments as $department)
          <option value="{{ $department->id }}" {{ isset($employee) && $employee->department_id == $department->id ? 'selected' : '' }}>
            {{ $department->name }}
          </option>
      @endforeach
    </select>
  </div>

  <!-- Date of Employment -->
  <div>
    <label for="date_of_employment" class="block text-sm font-medium text-gray-700 mb-1">Date of Employment:</label>
    <input type="date" id="date_of_employment" name="date_of_employment" value="{{ old('date_of_employment', $employee->date_of_employment ?? '') }}" required
      class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
  </div>

  <!-- Salary -->
  <div>
    <label for="salary" class="block text-sm font-medium text-gray-700 mb-1">Salary:</label>
    <input type="number" id="salary" name="salary" value="{{ old('salary', $employee->salary ?? '') }}" step="0.01" min="0" required
      class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
  </div>

  <!-- Phone Number -->
  <div class="md:col-span-2">
    <label for="phone_num" class="block text-sm font-medium text-gray-700 mb-1">Phone Number:</label>
    <input type="text" id="phone_num" name="phone_num" value="{{ old('phone_num', $employee->phone_num ?? '') }}" required
      class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
  </div>
</div>

<div class="flex justify-start space-x-4">
  <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
    Submit
  </button>
  <a href="/dashboard" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
    Cancel
  </a>
</div>

{{-- Notes: 
{{ }}: This is Blade's syntax for echoing PHP data. It automatically escapes the data to prevent XSS (cross-site scripting) attacks by converting special characters (like <, >, and &) into their HTML entity equivalents. --}}