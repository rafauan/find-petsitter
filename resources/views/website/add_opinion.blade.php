@extends('website.layouts.main')

@section('content')

<header>
  <div class="relative overflow-hidden bg-no-repeat bg-cover" style="
    background-position: 50%;
    background-image: url('https://images.unsplash.com/photo-1581888227599-779811939961?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1674&q=80');
    height: 300px;
  ">
    <div class="absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden bg-fixed"
      style="background-color: rgba(37, 37, 37, 0.75)">
      <div class="flex justify-center items-center h-full">
        <div class="text-center text-white px-6 md:px-12">
          <h1 class="text-5xl font-semibold mt-0 mb-3">Dodaj opinie</h1>
        </div>
      </div>
    </div>
  </div>
</header>

<div class="flex flex-col items-center h-full bg-white py-6">
  <div class="w-9/12 py-4">
    <div class="pb-4">
      <p class="text-2xl font-bold">Dodaj opinie</p>
      <form method="POST" action="{{ route('website.create_opinion', ['id' => 77]) }}">
        @csrf

        <div class="mt-2">
          <x-select-score />
        </div>

        <div class="mt-2">
          <x-opinion-text />
        </div>

        <button type="submit" class="w-full block rounded-md mt-4 bg-emerald-700 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-emerald-600">
          Dodaj opinie
        </button>
      </form>


      @if (session('success'))
      <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 mt-6" role="alert">
        <p>
          Zapytanie zostało wysłane, aby przejrzeć szczegóły zapytania wejdź pod ten 
          <a href="#" class="font-bold hover:opacity-75 transition ease-in-out duration-150">link.</a>
        </p>
      </div>
      @endif 

    </div>




  </div>
</div>



@endsection