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
            <h1 class="text-5xl font-semibold mt-0 mb-3">Profil opiekuna</h1>
          </div>
        </div>
      </div>
    </div>
</header>

<div class="flex flex-col items-center h-full bg-white py-6" x-data="show: true">

    <div class="flex justify-self-start w-9/12">
        @if($profile_image_url != null) 
          <img class="w-24 h-24 rounded-full" style="object-fit:cover;" src="{{ Storage::url($profile_image_url) }}" alt="Rounded avatar">
        @else
          <img class="w-24 h-24 rounded-full" style="object-fit:cover;" src="{{ Storage::url('public/profile_images/blank_profile_picture.png') }}" alt="Rounded avatar">
        @endif

        <div class="flex flex-col justify-center pl-4">
            <h1 class="text-4xl font-bold">
              {{ $user->name }}  
            </h1>    
            <p>
              {{ $city->name }}
            </p>
        </div>
    </div>

    <div class="w-9/12 py-4">
        <div class="pb-4">
            <p class="text-2xl font-bold">Opis</p>
            <p>
              {{ $user->profile_description }}
            </p>
        </div>

        <div class="pt-4">
            <p class="text-2xl font-bold">Usługi</p>
            <div class="md:flex justify-self-start bg-white w-9/12">
                @foreach ($user->petsitter_services as $petsitter_service)
                  <p class="whitespace-nowrap rounded-full bg-emerald-100 px-2.5 py-0.5 text-emerald-700 mr-4 mt-3">
                    {{ $petsitter_service->service->name }}
                  </p>
                @endforeach
            </div>
        </div>

        <p class="text-2xl font-bold pt-12">Wyślij zapytanie</p>

        @if (session('success'))
          <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 mt-6" role="alert">
            <p>
              Zapytanie zostało wysłane, aby przejrzeć szczegóły zapytania wejdź pod ten 
              <a href="{{ url('/customer_inquiries/' . old('id')) }}" class="font-bold hover:opacity-75 transition ease-in-out duration-150">link.</a>
            </p>
          </div>
        @else 

          @if (Auth::check() && Auth::user()->role == 'Customer')
            <form method="POST" action="{{ route("website.create_inquiry", ["id" => $user->id]) }}"> 
                @csrf

                <div class="mt-2">
                  <x-select-city :city="$city" />
                </div>
        
                <div class="mt-2">
                  <x-select-dog-weight />
                </div>

                <div class="mt-2">
                  <x-select-service-petsitter :petsitter_services="$user->petsitter_services" />
                </div>
        
                <div class="my-2">
                  <x-select-dog-age />
                </div>

                <div class="my-2">
                  <x-message-form/>
                </div>
        
                <div class="my-4">
                    <button type="submit" class="w-full block rounded-md bg-emerald-700 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-emerald-600">
                        Poproś o wycenę
                    </button>
                </div>
            </form>
          @else
            <div class="bg-gray-100 border-l-4 border-gray-500 text-gray-700 p-4 mt-6" role="alert">
              <a href="{{ route('login') }}" class="font-bold hover:opacity-75 transition ease-in-out duration-150">Zaloguj się lub stwórz konto klienta</a>
              <p>Aby wysłać zapytanie do tego opiekuna musisz być zalogowany jako klient.</p>
            </div>
          @endif

        @endif

        <div class="flex justify-between align-middle mt-12 mb-6">
          <p class="text-2xl font-bold">Opinie</p>
          <a href="/add_opinion/{{ $user->id }}" class="rounded-md bg-emerald-700 px-5 py-3 text-sm font-medium text-white transition hover:bg-emerald-600">
            Dodaj opinię
          </a>
        </div>

        <x-opinions :user="$user" />
    </div>
</div>



@endsection