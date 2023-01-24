<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'FindPetsitter') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        

    </head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
            
        <header aria-label="Site Header" class="bg-white">
            <div
              class="mx-auto flex h-16 max-w-screen-xl items-center gap-8 px-4 sm:px-6 lg:px-8"
            >
              <a class="block text-emerald-700" href="/">
                <span class="sr-only">Home</span>
                <svg
                  class="h-8"
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
          
              <div class="flex flex-1 items-center justify-end md:justify-between">
                <nav aria-label="Site Nav" class="hidden md:block">
                  <ul class="flex items-center gap-6 text-sm">
                    <li>
                      <a class="text-gray-500 transition hover:text-gray-500/75" href="/">
                        Strona główna
                      </a>
                    </li>
                  </ul>
                </nav>
          
                <div class="flex items-center gap-4">
                  @if(Auth::user())
                  <div class="sm:flex sm:gap-4">
                    <a
                      class="block rounded-md bg-emerald-700 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-emerald-600"
                      href="/dashboard"
                    >
                      {{ __('Panel') }}
                    </a>
                  </div>
                  
                  @else 

                  <div class="sm:flex sm:gap-4">
                    <a
                      class="block rounded-md bg-emerald-700 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-emerald-600"
                      href="/login"
                    >
                      {{ __('Login') }}
                    </a>
          
                    <a
                      class="hidden rounded-md bg-gray-100 px-5 py-2.5 text-sm font-medium text-emerald-700 transition hover:text-emerald-800/75 sm:block"
                      href="/register"
                    >
                    {{ __('Register') }}
                    </a>
                  </div>
                  
                  @endif

                </div>
              </div>
            </div>
        </header>
        
        @yield('content')

    </div>

    {{-- <footer aria-label="Site Footer" class="bg-gray-50">
      <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center sm:justify-between">
          <div class="flex justify-center text-teal-600 sm:justify-start">
              <svg
                  class="h-8"
                  viewBox="0 0 512 512"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
              >
                  <path
                  d="M269.4 2.9C265.2 1 260.7 0 256 0s-9.2 1-13.4 2.9L54.3 82.8c-22 9.3-38.4 31-38.3 57.2c.5 99.2 41.3 280.7 213.6 363.2c16.7 8 36.1 8 52.8 0C454.7 420.7 495.5 239.2 496 140c.1-26.2-16.3-47.9-38.3-57.2L269.4 2.9zM160.9 286.2c4.8 1.2 9.9 1.8 15.1 1.8c35.3 0 64-28.7 64-64V160h44.2c12.1 0 23.2 6.8 28.6 17.7L320 192h64c8.8 0 16 7.2 16 16v32c0 44.2-35.8 80-80 80H272v50.7c0 7.3-5.9 13.3-13.3 13.3c-1.8 0-3.6-.4-5.2-1.1l-98.7-42.3c-6.6-2.8-10.8-9.3-10.8-16.4c0-2.8 .6-5.5 1.9-8l15-30zM160 160h40 8v32 32c0 17.7-14.3 32-32 32s-32-14.3-32-32V176c0-8.8 7.2-16 16-16zm128 48c0-8.8-7.2-16-16-16s-16 7.2-16 16s7.2 16 16 16s16-7.2 16-16z"
                  fill="currentColor"
                  />
              </svg>
          </div>
    
          <p class="mt-4 text-center text-sm text-gray-500 lg:mt-0 lg:text-right">
            Copyright &copy; 2022. Wszystkie prawa zastrzerzone.
          </p>
        </div>
      </div>
    </footer> --}}

</body>
</html>