@extends('layouts.app2')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-3xl py-4 border-b mb-10">Přidání země</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
<br>
<br>
        <form method="POST" action="/country/add" class="bg-white input-accent-md rounded px-8 pt-6 pb-8 mb-4" enctype="multipart/form-data">
            @csrf

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Název země:
                </label>
                <input class="input-primary border rounded w-full py-2 px-3  leading-tight focus:outline-none focus:input-primary-outline" id="name" name="name" type="text" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                    Obrázek vlajky:
                </label>
                <input class="input-primary appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:input-primary-outline" id="image" name="image" type="file" required accept="image/png, image/jpeg">
            </div>

            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:input-primary-outline" type="submit">
                    Potvrdit
                </button>
            </div>
        </form>
    </div>
@endsection