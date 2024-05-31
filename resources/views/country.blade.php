@extends('layouts.app')

@section('content')
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
        <br>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach ($data as $country)
        

            <div class="card w-full bg-base-100 shadow-xl">
                    <figure>
                        <img src="{{ asset('obrazky/' . $country->image) }}" alt="{{ $country->countryName }}" class="w-64 h-64 object-cover">
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">
                            {{ $country->countryName }}
                        </h2>
                        <p>ID: {{ $country->id_country }}</p>

                                <div class="card-actions justify-end">
                                
                                    <button class="btn btn-outline btn-error" data-id="{{ $country->id_country }}" onclick="setFormAction('{{ $country->id_country }}')">Smazat</button>
                                </div>
                    </div>
                </div>
 

            @endforeach
        </div>

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
    <button class="btn btn-outline btn-error" type="submit">Smazat</button>
</form>




        &nbsp;&nbsp;&nbsp;
        <button type="button" class="btn btn-outline btn-primary" id="cancelButton">
  Zrušit
</button>
      </div>
    </div>
  </div>
</div>
    <br>
    <br>
    <br>
    
    {{ $data->links() }}
@endsection