<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Units') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <a href="/units/add">{{ __('ADD') }}</a>
        <form method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @if (isset($unit))
                {{ method_field('PATCH') }}
            @else
                {{ method_field('PUT') }}
            @endif
            {{ csrf_field() }}
            @if (isset($unit)) 
                <a href="/units/pdf/{{ $unit->id }}">
                {{ QrCode::generate($unit->uid) }}
                </a>
            @endif
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Name
                </label>
                <input value="{{ (isset($unit) ? $unit->name : '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="name" type="text" placeholder="Name">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="address">
                    Address
                </label>
                <input value="{{ (isset($unit) ? $unit->address : '') }}" class="shadow appearance-none border rounded w-60 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="address" type="text" placeholder="Address">
                <input value="{{ (isset($unit) ? $unit->postalcode : '') }}" class="shadow appearance-none border rounded w-40 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="postalcode" type="text" placeholder="Postal code">
                <input value="{{ (isset($unit) ? $unit->city : '') }}" class="shadow appearance-none border rounded w-50 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="city" type="text" placeholder="City">
                <input value="{{ (isset($unit) ? $unit->region : '') }}" class="shadow appearance-none border rounded w-70 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="region" type="text" placeholder="Region">
                <select class="shadow appearance-none border rounded w-70 py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="country">
                    @foreach ($countries as $country) 
                        <option {{ (isset($unit) && $unit->country === $country->Iso3 ? 'selected' : '') }} value="{{ $country->Iso3 }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="location">
                    Location (GPS)
                </label>
                <input value="{{ (isset($unit) ? $unit->location : '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="location" type="text" placeholder="Coordinates">
            </div>
            <div class="mb-4">
                <div id="map" class="container mx-auto" style="height: 350px;">
                </div>
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    {{ __('SAVE') }}
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
