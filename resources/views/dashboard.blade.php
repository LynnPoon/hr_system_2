<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Dashboard') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">                
                <h1 class="text-2xl font-bold mb-4">Welcome {{ Auth::user()->name }}!</h1>

                @if(Auth::user()->role === 'admin')
                <form action="{{route('add')}}" method="get" class="mb-4">
                  <button class="text-blue-600 hover:underline font-semibold">Register Employee</button>
                </form>              
                  
                <form action="{{ route('employee.search') }}" method="get" class="flex items-center space-x-2 mb-6">
                  <label for="search_id" class="font-medium text-gray-700">Search by Employee ID:</label>
                  <input type="text" id="search_id" name="id" class="border border-gray-300 rounded px-2 py-1 focus:outline-none focus:ring focus:border-blue-300">
                  <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Search</button>
                </form>                  
                
                @else
                <p class="mb-4">Here is your employee record.</p>
                @endif
           
                <div>
                <table class="min-w-full border-collapse border border-gray-300 shadow-lg">
                    <thead>
                      <tr class="bg-gray-50 text-gray-800">
                        <th class="border border-gray-300 px-4 py-2 text-left font-semibold">ID</th>
                        <th class="border border-gray-300 px-4 py-2 text-left font-semibold">First Name</th>
                        <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Last Name</th>
                        <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Position</th>
                        <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Department</th>
                        <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Date of Employment</th>
                        <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Salary</th>
                        <th class="border border-gray-300 px-4 py-2 text-left font-semibold">Phone Number</th>
                        @if(Auth::user()->role === 'admin')
                        <th class="border border-gray-300 px-4 py-2"></th>
                        @endif
                      </tr>
                    </thead>
                    <tbody class="bg-white">
                      @if(Auth::user()->role === 'admin' && isset($employees))
                        @foreach($employees as $employee)
                        <tr onclick="window.location='{{ route('employee.edit', $employee->id) }}'" class="hover:bg-gray-100 cursor-pointer">
                          <td class="border px-4 py-2">{{ $employee->id }}</td>
                          <td class="border px-4 py-2">{{ $employee->first_name }}</td>
                          <td class="border px-4 py-2">{{ $employee->last_name }}</td>
                          <td class="border px-4 py-2">{{ $employee->position }}</td>
                          <td class="border px-4 py-2">{{ $employee->department->name }}</td>
                          <td class="border px-4 py-2">{{ $employee->date_of_employment }}</td>
                          <td class="border px-4 py-2">{{ $employee->salary }}</td>
                          <td class="border px-4 py-2">{{ $employee->phone_num }}</td>
                          <td class="border px-4 py-2">
                            <form action="{{ route('employee.destroy', $employee->id) }}" method="post" id="delete-form-{{ $employee->id }}">
                              @csrf
                              @method('DELETE')
                              <button type="button" onclick="confirmDelete(event, {{ $employee->id }})" class="text-red-600 hover:underline">
                                Delete
                              </button>
                            </form>
                          </td>
                        </tr>
                        @endforeach
                      @elseif(Auth::user()->role === 'employee' && isset($employee))
                      <tr>
                        <td class="border px-4 py-2">{{ $employee->id }}</td>
                        <td class="border px-4 py-2">{{ $employee->first_name }}</td>
                        <td class="border px-4 py-2">{{ $employee->last_name }}</td>
                        <td class="border px-4 py-2">{{ $employee->position }}</td>
                        <td class="border px-4 py-2">{{ $employee->department->name }}</td>
                        <td class="border px-4 py-2">{{ $employee->date_of_employment }}</td>
                        <td class="border px-4 py-2">{{ $employee->salary }}</td>
                        <td class="border px-4 py-2">{{ $employee->phone_num }}</td>
                      </tr>  
                      @endif
                    </tbody>
                  </table>
                </div>                
              </div>
                  
              @if (session('success'))
              <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                {{ session('success') }}
              </div>
              @endif
            
              @if (session('message'))
              <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                {{ session('message') }}
              </div>
              @endif
            
            </div>
          </div>
        </div>
        
        <script>
        function confirmDelete(e, employeeId) {
          e.preventDefault();
          e.stopPropagation(); // Prevent the click event from propagating to the row

          if (confirm('Are you sure you want to delete this employee?')) {
            document.getElementById('delete-form-' + employeeId).submit();
          }
        }
        </script>
</x-app-layout>

