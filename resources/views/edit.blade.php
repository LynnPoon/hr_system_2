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
                 <h1 class="text-center font-bold">Employee Record</h1>
 
                 <form action="{{ route('employee.update', $employee->id)}}" method="post" class="row g-3 mb-4">
                   @csrf
                   @method('PUT')
                   @include('employee_form', ['departments' => $departments, 'employee' => $employee])
                 </form>
               </body>
               
             </div>
           </div>
         </div>
       </div>
 </x-app-layout>