<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Units') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <a href="units/add">{{ __('ADD') }}</a>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <table>
                @foreach ($units as $unit)
                <tr>    
                    <td>{{ $unit->name }}</td>
                    <td><a href="/units/edit/{{ $unit->id }}">{{ __('EDIT') }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</x-app-layout>
