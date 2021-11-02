<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <a href="employees/add">{{ __('ADD') }}</a>
        <form method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @if (isset($employee))
                {{ method_field('PATCH') }}
            @else
                {{ method_field('PUT') }}
            @endif
            {{ csrf_field() }}
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Name
                </label>
                <input value="{{ (isset($employee) ? $employee->user->name : '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="name" type="text" placeholder="Username">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    E-mail
                </label>
                <input value="{{ (isset($employee) ? $employee->user->email : '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="email" type="text" placeholder="Email">
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    {{ __('SAVE') }}
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
