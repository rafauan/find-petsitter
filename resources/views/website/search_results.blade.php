@extends('website.layouts.main')

@section('content')

<header>
    <!-- Background image -->
    <div class="relative overflow-hidden bg-no-repeat bg-cover" style="
      background-position: 50%;
      background-image: url('https://images.unsplash.com/photo-1581888227599-779811939961?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1674&q=80');
      height: 300px;
      
    ">
      <div class="absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden bg-fixed"
        style="background-color: rgba(37, 37, 37, 0.75)">
        <div class="flex justify-center items-center h-full">
          <div class="text-center text-white px-6 md:px-12">
            <h1 class="text-5xl font-semibold mt-0 mb-3">Znajdź opiekuna</h1>
            @if($users_count == 1)
              <p>Wyślij zapytanie wśród {{ $users_count }} opiekuna</p>
            @else 
              <p>Wyślij zapytanie wśród {{ $users_count }} opiekunów</p>
            @endif
          </div>
        </div>
      </div>
    </div>
    <!-- Background image -->
</header>

<div class="flex flex-col items-center h-full" x-data="show: true">

    <div class="flex justify-self-start flex-col bg-white w-9/12">
        <p class="text-3xl font-semibold pl-8 pt-8">Wybrane filtry:</p>    

        <form class="px-8" method="POST" action="{{ route('website.search_results') }}">
          @csrf
          
            <div class="mt-2">
                <label for="city_id" class="block mb-2 font-medium text-sm text-gray-700">{{ __('City') }}</label>
                <select id="city_id" class="
                    bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-700 focus:border-emerald-700 block w-full p-2.5"
                    aria-label="city_id" name="city_id" id="city_id" required="required" autofocus="autofocus" autocomplete="city_id"    
                >
                  <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
                  @foreach ($other_cities as $other_city)
                      <option value="{{ $other_city->id }}">{{ $other_city->name }}</option>
                  @endforeach
                </select>
                <x-input-error :messages="$errors->get('city_id')" class="mt-2" />
            </div>

            <div class="mt-2">
              <label for="service_id" class="block mb-2 font-medium text-sm text-gray-700">{{ __('City') }}</label>
              <select id="service_id" class="
                  bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-700 focus:border-emerald-700 block w-full p-2.5"
                  aria-label="service_id" name="service_id" id="service_id" required="required" autofocus="autofocus" autocomplete="service_id"    
              >
                <option value="{{ $service->id }}" selected>{{ $service->name }}</option>
                @foreach ($other_services as $other_service)
                    <option value="{{ $other_service->id }}">{{ $other_service->name }}</option>
                @endforeach
              </select>
              <x-input-error :messages="$errors->get('service_id')" class="mt-2" />
            </div>
    
            <div class="my-4">
                <button class="w-full block rounded-md bg-emerald-700 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-emerald-600">
                    Wyszukaj
                </button>
            </div>
    
        </form>

    </div>

    <x-search-items :users="$users" :city="$city" />
</div>

@endsection