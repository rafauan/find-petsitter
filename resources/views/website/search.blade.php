@extends('website.layouts.main')

@section('content')

<section class="bg-white">
    <div class="lg:grid lg:min-h-screen lg:grid-cols-12">
      <aside
        class="relative block h-16 lg:order-last lg:col-span-5 lg:h-full xl:col-span-6"
      >
        <img
          alt="Pattern"
          src="https://images.unsplash.com/photo-1581888227599-779811939961?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1674&q=80"
          class="absolute inset-0 h-full w-full object-cover"
        />
      </aside>
  
      <main
        aria-label="Main"
        class="flex items-center justify-center px-8 py-8 sm:px-12 lg:col-span-7 lg:py-12 lg:px-16 xl:col-span-6"
      >
        <div class="max-w-xl lg:max-w-3xl">
          <a class="block text-emerald-700" href="/">
            <span class="sr-only">Home</span>
            <svg
              class="h-8 sm:h-10"
              viewBox="0 0 512 512"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M269.4 2.9C265.2 1 260.7 0 256 0s-9.2 1-13.4 2.9L54.3 82.8c-22 9.3-38.4 31-38.3 57.2c.5 99.2 41.3 280.7 213.6 363.2c16.7 8 36.1 8 52.8 0C454.7 420.7 495.5 239.2 496 140c.1-26.2-16.3-47.9-38.3-57.2L269.4 2.9zM160.9 286.2c4.8 1.2 9.9 1.8 15.1 1.8c35.3 0 64-28.7 64-64V160h44.2c12.1 0 23.2 6.8 28.6 17.7L320 192h64c8.8 0 16 7.2 16 16v32c0 44.2-35.8 80-80 80H272v50.7c0 7.3-5.9 13.3-13.3 13.3c-1.8 0-3.6-.4-5.2-1.1l-98.7-42.3c-6.6-2.8-10.8-9.3-10.8-16.4c0-2.8 .6-5.5 1.9-8l15-30zM160 160h40 8v32 32c0 17.7-14.3 32-32 32s-32-14.3-32-32V176c0-8.8 7.2-16 16-16zm128 48c0-8.8-7.2-16-16-16s-16 7.2-16 16s7.2 16 16 16s16-7.2 16-16z"
                fill="currentColor"
              />
            </svg>
          </a>
  
          <h1
            class="mt-6 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl"
          >
            Witaj na FindPetsitter
          </h1>
  
          <p class="mt-4 leading-relaxed text-gray-500">
            Skorzystaj z naszej wyszukiwarki, aby znaleźć najbardziej dopasowanego
            opiekuna.
          </p>
  
          <form method="POST" action="{{ route('website.search_results') }}" >
            @csrf
            
            <div class="mt-2">
                <label for="city_id" class="block mb-2 font-medium text-sm text-gray-700">{{ __('City') }}</label>
                <select id="city_id" class="
                    bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-700 focus:border-emerald-700 block w-full p-2.5"
                    aria-label="city_id" name="city_id" id="city_id" required="required" autofocus="autofocus" autocomplete="city_id"    
                >
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
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
                  @foreach ($services as $service)
                      <option value="{{ $service->id }}">{{ $service->name }}</option>
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
      </main>
    </div>
  </section>

@endsection