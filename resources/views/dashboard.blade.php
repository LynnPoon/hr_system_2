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
                
                <h1>Welcome {{ Auth::user()->name }}!</h1><br>

                @if(Auth::user()->role === 'admin')
                <form action="{{route('add')}}" method="get">
                  <button class="btn btn-link">Register Employee</button>
                </form>              
                  
                <form action="{{ route('employee.search') }}" method="get">
                  <label for="search_id">Search by Employee ID:</label>
                    <input type="text" id="search_id" name="id" style="width: 200px;">
                    <button type="submit" class="btn btn-light">Search</button>
                </form>                  
                
                @else
                <p>Here is your employee record.</p><br>
                @endif
           
                <div>
                  <table class="table-auto">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Position</th>
                        <th>Department</th>
                        <th>Date of Employment</th>
                        <th>Salary</th>
                        <th>Phone Number</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      @if(Auth::user()->role === 'admin' && isset($employees))
                        @foreach($employees as $employee)
                        <tr onclick="window.location='{{ route('employee.edit', $employee->id) }}'" style="cursor: pointer;">
                          <td>{{ $employee->id }}</td>
                          <td>{{ $employee->first_name }}</td>
                          <td>{{ $employee->last_name }}</td>
                          <td>{{ $employee->position }}</td>
                          <td>{{ $employee->department->name }}</td>
                          <td>{{ $employee->date_of_employment }}</td>
                          <td>{{ $employee->salary }}</td>
                          <td>{{ $employee->phone_num }}</td>
                          <td>
                            <form action="{{ route('employee.destroy', $employee->id) }}" method="post" style="display: inline;" id="delete-form-{{ $employee->id }}">
                              @csrf
                              @method('DELETE') 
                              <button type="button" onclick="confirmDelete(event, {{ $employee->id }})">Delete</button>
                            </form>
                          </td>
                        </tr>
                        @endforeach

                      @elseif(Auth::user()->role === 'admin' && isset($employee))
                      <tr onclick="window.location='{{ route('employee.edit', $employee->id) }}'" style="cursor: pointer;">
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->first_name }}</td>
                        <td>{{ $employee->last_name }}</td>
                        <td>{{ $employee->position }}</td>
                        <td>{{ $employee->department->name }}</td>
                        <td>{{ $employee->date_of_employment }}</td>
                        <td>{{ $employee->salary }}</td>
                        <td>{{ $employee->phone_num }}</td>
                      </tr>
                      
                      @elseif(Auth::user()->role === 'employee' && isset($employee))
                      <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->first_name }}</td>
                        <td>{{ $employee->last_name }}</td>
                        <td>{{ $employee->position }}</td>
                        <td>{{ $employee->department->name }}</td>
                        <td>{{ $employee->date_of_employment }}</td>
                        <td>{{ $employee->salary }}</td>
                        <td>{{ $employee->phone_num }}</td>
                      </tr>  
                      
                      @if(session('message'))
                      <p class="text-red-500">{{ session('message') }}</p>
                      @endif

                      @endif
                    </tbody>
                  </table>
                </div>                
              </div>
                  
              @if (session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
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
