@extends('layouts.app2')
@section('content')

<div class="container mx-auto px-4">
    <h1 class="text-3xl py-4 border-b mb-10">Editace řidiče {{ $driver->name }}</h1>
    <form method="POST" action="/drivers/{{ $driver->id_driver }}" class="bg-white bg-accent-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="dateOfBirth">
                Datum narození:
            </label>
            <input class="bg-accent appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:bg-accent-outline" id="dateOfBirth" name="dateOfBirth" type="date" value="{{ $driver->dateOfBirth }}">
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Jméno řidiče:
            </label>
            <input class="bg-accent appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:bg-accent-outline" id="name" name="name" type="text" value="{{ $driver->name }}" required>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="driverChampion">
                Počet titulů mistra světa:
            </label>
            <input class="bg-accent appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:bg-accent-outline" id="driverChampion" name="driverChampion" type="number" value="{{ $driver->driverChampion }}" required>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="wins">
                Počet výher:
            </label>
            <input class="bg-accent appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:bg-accent-outline" id="wins" name="wins" type="number" value="{{ $driver->wins }}" required>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="podiums">
                Počet podií:
            </label>
            <input class="bg-accent appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:bg-accent-outline" id="podiums" name="podiums" type="number" value="{{ $driver->podiums }}" required>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="dnfs">
                Počet DNF:
            </label>
            <input class="bg-accent appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:bg-accent-outline" id="dnfs" name="dnfs" type="number" value="{{ $driver->dnfs }}" required>
        </div>




        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="country">
                Země původu:
            </label>
            <select class="bg-accent appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:bg-accent-outline" id="country" name="country" required>
            <option selected disabled class="info-content">Vyberte zemi</option>
                @foreach ($data as $country)
                    <option value="{{ $country->id_country }}" {{ $driver->country_id_country == $country->id_country ? 'selected' : '' }}>{{ $country->countryName }}</option>
                @endforeach
            </select>
        </div>




        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:bg-accent-outline" type="submit">
                Uložit
            </button>
        </div>
    </form>
</div>
@endsection