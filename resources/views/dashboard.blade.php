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
                    {{ __("You're logged in!!!!") }}
                </div>
{{-- 
                @if(Auth::user()->role === 'admin')
                    <h1>Welcome Admin!</h1>
                    <p>Here you can manage all employees.</p>
                    <h2>All Employees</h2>
                    <ul>
                        @foreach($employees as $employee)
                            <li>{{ $employee->first_name }} {{ $employee->last_name }} - {{ $employee->position }}</li>
                        @endforeach
                    </ul>
                @else
                    <h1>Welcome {{ Auth::user()->name }}</h1>
                    <p>View your employee record.</p>
                    <h2>Your Record</h2>
                    <p>{{ $employee->first_name }} {{ $employee->last_name }} - {{ $employee->position }}</p>
                @endif --}}
                

                @if(Auth::user()->role === 'admin' && isset($employees))
                    <h1>Welcome Admin!</h1>
                    <p>Here you can manage all employees.</p>
                    <h2>All Employees</h2>
                    <ul>
                        @foreach($employees as $employee)
                            <li>{{ $employee->first_name }} {{ $employee->last_name }} - {{ $employee->position }}</li>
                        @endforeach
                    </ul>
                @elseif(isset($employee))
                    <h1>Welcome {{ Auth::user()->name }}</h1>
                    <p>View your employee record.</p>
                    <h2>Your Record</h2>
                    <p>{{ $employee->first_name }} {{ $employee->last_name }} - {{ $employee->position }}</p>
                @else
                    <p>No records found.</p>
                @endif

                
            </div>
        </div>
    </div>
</x-app-layout>
