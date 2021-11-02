<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <a href="employees/add">{{ __('ADD') }}</a>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <table>
                @foreach ($employees as $employee)
                <tr>    
                    <td>{{ $employee->user->name }}</td>
                    <td><a href="/employees/edit/{{ $employee->id }}">{{ __('EDIT') }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</x-app-layout>
