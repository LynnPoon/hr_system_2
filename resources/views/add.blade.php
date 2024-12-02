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

              <body class="container py-4">
                <p class="text-center font-bold">Employee Record</p>

                <form action="{{ route('employee.store') }}" method="post" class="row g-3 mb-4">
                  @csrf
                  @include('employee_form', ['departments' => $departments])
                </form>
              </body>
              
            </div>
          </div>
        </div>
      </div>
</x-app-layout>