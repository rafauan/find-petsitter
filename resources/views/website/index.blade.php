@extends('website.layouts.main')

@section('content')

    <section
        {{-- class="relative bg-[url(https://images.unsplash.com/photo-1576201836106-db1758fd1c97?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80)] bg-cover bg-center bg-no-repeat" --}}
        class="relative bg-[url(https://images.unsplash.com/photo-1568393691622-c7ba131d63b4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2062&q=80)] bg-cover bg-center bg-no-repeat"
    >
    <div class="absolute inset-0 bg-white/75 sm:bg-transparent sm:bg-gradient-to-r sm:from-white/95 sm:to-white/25"></div>
  
    <div class="relative mx-auto max-w-screen-xl px-4 py-32 sm:px-6 lg:flex lg:h-screen lg:items-center lg:px-8">
      <div class="max-w-xl text-center sm:text-left">
        <h1 class="text-3xl font-extrabold sm:text-5xl">
          Szukasz opiekuna
  
          <strong class="block font-extrabold text-emerald-700">
            dla swojego psa?
          </strong>
        </h1>
  
        <p class="mt-4 max-w-lg sm:text-xl sm:leading-relaxed">
            Nic prostszego!
            Solidnego i sprawdzonego psiego opiekuna znajdziesz u nas.
        </p>
  
        <div class="mt-8 flex flex-wrap gap-4 text-center">
          <a
            href="/search"
            class="block rounded-md bg-emerald-700 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-emerald-600"
          >
            Przejdź do wyszukiwarki
          </a>
        </div>
      </div>
    </div>
  </section>

</div>

@endsection