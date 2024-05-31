@extends('layouts.app2')
@section('content')
<br>
@if (session('success'))
    <br>
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    <br>
    <br>
@endif

@if (session('error'))
    <br>
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    <br>
    <br>
@endif
<br>
<title>Jezdci</title>
<h1>Celkový počet výher řidičů je {{ $winsum }}</h1>
<h1>Celkový počet vyhraných šampionátů řidičů je {{ $champsum }}</h1>
<br>
<table class="table" >
    <thead>
        <tr>
            <th>Jméno</th>
            <th>Datum narození</th>
            <th>Tituly mistra světa</th>
            <th>Výhry</th>
            <th>Podiums</th>
            <th>DNF</th>
            <th>Country</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->name}}</td>
                <td>{{ $item->dateOfBirth}}</td>
                <td>{{ $item->driverChampion}}</td>
                <td>{{ $item->wins}}</td>
                <td>{{ $item->podiums}}</td>
                <td>{{ $item->dnfs}}</td>
                <td>{{ $item->country_name}}</td>
                <td class="border px-4 py-2"><button class="btn btn-outline btn-error" data-id="{{ $item->id_driver }}" onclick="setFormAction('{{ $item->id_driver }}')">Smazat</button></td>
                <td class="border px-4 py-2"></td>
                <td class="border px-4 py-2"><a href="/{{ $item->name }}/{{ $item->id_driver }}/edit" class="btn btn-outline btn-warning">Editovat</a></td>
            </tr>
        @endforeach
    </tbody>
</table>
<div id="myModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="sm:flex sm:items-start">
          <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
              Tuto akci nebude možné vrátit!
            </h3>
          </div>
        </div>
      </div>
      <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
    

      <form id="deleteForm" method="POST">
    @csrf
    @method('DELETE')
    <button class="btn btn-outline btn-error" type="submit" id="deleteButton1">Smazat</button>
</form>
        &nbsp;&nbsp;&nbsp;
        <button type="button" class="btn btn-outline btn-primary" id="cancelButton">
  Zrušit
</button>
      </div>
    </div>
  </div>
</div>
@endsection
