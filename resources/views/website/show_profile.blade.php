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
            <div class="flex justify-self-start bg-white w-9/12 pt-3">
                @foreach ($user->petsitter_services as $petsitter_service)
                  <p class="rounded-full bg-emerald-100 px-2.5 py-0.5 text-emerald-700 mr-4">
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
              <a href="#" class="font-bold hover:opacity-75 transition ease-in-out duration-150">link.</a>
            </p>
          </div>

        @else 

          @if (Auth::check() && Auth::user()->role == 'Customer')
            <form method="POST" action="{{ route("website.create_inquiry", ["id" => $user->id]) }}"> 
                @csrf

                <div class="mt-2">
                  <label for="city_id" class="block font-medium text-sm text-gray-700">{{ __('City') }}</label>
                  <select id="city_id" class="
                      bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-700 focus:border-emerald-700 block w-full p-2.5"
                      aria-label="city_id" name="city_id" id="city_id" required="required" autofocus="autofocus" autocomplete="city_id"    
                  >
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                  </select>
                  <x-input-error :messages="$errors->get('city_id')" class="mt-2" />
                </div>
        
                <div class="mt-2">
                    <p class="block my-2 text-sm font-medium text-gray-900">Waga psa</p>
                    <fieldset class="flex flex-wrap gap-3">
                        <legend class="sr-only">Waga</legend>
                        <div>
                          <input
                            type="radio"
                            name="weight"
                            value="5"
                            id="5"
                            class="peer hidden"
                            checked
                          />
                      
                          <label
                            for="5"
                            class="flex cursor-pointer items-center justify-center rounded-md border border-gray-100 py-2 px-3 text-gray-900 hover:border-gray-200 peer-checked:border-emerald-700 peer-checked:bg-emerald-700 peer-checked:text-white"
                          >
                            <p class="text-sm font-medium">do 5 kg</p>
                          </label>
                        </div>
                      
                        <div>
                          <input
                            type="radio"
                            name="weight"
                            value="20"
                            id="20"
                            class="peer hidden"
                          />
                      
                          <label
                            for="20"
                            class="flex cursor-pointer items-center justify-center rounded-md border border-gray-100 py-2 px-3 text-gray-900 hover:border-gray-200 peer-checked:border-emerald-700 peer-checked:bg-emerald-700 peer-checked:text-white"
                          >
                            <p class="text-sm font-medium">do 20 kg</p>
                          </label>
                        </div>
                      
                        <div>
                          <input
                            type="radio"
                            name="weight"
                            value="40"
                            id="40"
                            class="peer hidden"
                          />
                      
                          <label
                            for="40"
                            class="flex cursor-pointer items-center justify-center rounded-md border border-gray-100 py-2 px-3 text-gray-900 hover:border-gray-200 peer-checked:border-emerald-700 peer-checked:bg-emerald-700 peer-checked:text-white"
                          >
                            <p class="text-sm font-medium">do 40 kg</p>
                          </label>
                        </div>
                      
                        <div>
                          <input
                            type="radio"
                            name="weight"
                            value="40+"
                            id="40+"
                            class="peer hidden"
                          />
                      
                          <label
                            for="40+"
                            class="flex cursor-pointer items-center justify-center rounded-md border border-gray-100 py-2 px-3 text-gray-900 hover:border-gray-200 peer-checked:border-emerald-700 peer-checked:bg-emerald-700 peer-checked:text-white"
                          >
                            <p class="text-sm font-medium">40kg+</p>
                          </label>
                        </div>
                      </fieldset>
                </div>

                <div class="mt-2">
                  <label for="service_id" class="block font-medium text-sm text-gray-700">{{ __('Service') }}</label>
                  <select id="service_id" class="
                      bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-700 focus:border-emerald-700 block w-full p-2.5"
                      aria-label="service_id" name="service_id" id="service_id" required="required" autofocus="autofocus" autocomplete="service_id"
                  >
                      @foreach ($user->petsitter_services as $petsitter_service)
                          <option value="{{ $petsitter_service->service->id }}">{{ $petsitter_service->service->name }}</option>
                      @endforeach
                  </select>
                  <x-input-error :messages="$errors->get('service_id')" class="mt-2" />
                </div>
        
                <div class="my-2">
                    <p class="block my-2 text-sm font-medium text-gray-900">Wiek psa</p>
                    <fieldset class="flex flex-wrap gap-3">
                        <legend class="sr-only">Wiek</legend>
                      
                        <div>
                          <input
                            type="radio"
                            name="age"
                            value=">1"
                            id=">1"
                            class="peer hidden"
                            checked
                          />
                      
                          <label
                            for=">1"
                            class="flex cursor-pointer items-center justify-center rounded-md border border-gray-100 py-2 px-3 text-gray-900 hover:border-gray-200 peer-checked:border-emerald-700 peer-checked:bg-emerald-700 peer-checked:text-white"
                          >
                            <p class="text-sm font-medium">do roku</p>
                          </label>
                        </div>
                      
                        <div>
                          <input
                            type="radio"
                            name="age"
                            value="1-5"
                            id="1-5"
                            class="peer hidden"
                          />
                      
                          <label
                            for="1-5"
                            class="flex cursor-pointer items-center justify-center rounded-md border border-gray-100 py-2 px-3 text-gray-900 hover:border-gray-200 peer-checked:border-emerald-700 peer-checked:bg-emerald-700 peer-checked:text-white"
                          >
                            <p class="text-sm font-medium">1-5</p>
                          </label>
                        </div>
                      
                        <div>
                          <input
                            type="radio"
                            name="age"
                            value="5-8"
                            id="5-8"
                            class="peer hidden"
                          />
                      
                          <label
                            for="5-8"
                            class="flex cursor-pointer items-center justify-center rounded-md border border-gray-100 py-2 px-3 text-gray-900 hover:border-gray-200 peer-checked:border-emerald-700 peer-checked:bg-emerald-700 peer-checked:text-white"
                          >
                            <p class="text-sm font-medium">5-8</p>
                          </label>
                        </div>
                      
                        <div>
                          <input
                            type="radio"
                            name="age"
                            value="<8"
                            id="<8"
                            class="peer hidden"
                          />
                      
                          <label
                            for="<8"
                            class="flex cursor-pointer items-center justify-center rounded-md border border-gray-100 py-2 px-3 text-gray-900 hover:border-gray-200 peer-checked:border-emerald-700 peer-checked:bg-emerald-700 peer-checked:text-white"
                          >
                            <p class="text-sm font-medium">ponad 8</p>
                          </label>
                        </div>
                      </fieldset>
                      
                </div>

                <div class="my-2">
                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900">Wiadomość do opiekuna</label>
                    <textarea id="message" name="message" required rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-emerald-700 focus:border-emerald-700" placeholder="Napisz jakieś szczegółowe informacje, których nie ma w formularzu..."></textarea>
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

    </div>
</div>

@endsection