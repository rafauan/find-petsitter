@props(['users', 'city'])

<div class="flex flex-wrap justify-between w-9/12 bg-white p-8 gap-x-2 gap-y-8">  
    <div class="grid gap-4 xl:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 w-full">
      @unless(count($users) == 0)
      @foreach($users as $user)
      <div class="col shadow-lg">
        <a href="/show_profile/{{ $user->id }}" class="hover:opacity-60 transition">
          @if($user->profile_image)
            <img class="w-full aspect-square" style="object-fit: cover;" src="{{ Storage::url($user->profile_image->path) }}" alt="Profile picture">
          @else
            <img class="w-full aspect-square" style="object-fit: cover;" src="{{ asset('storage/profile_images/blank_profile_picture.png') }}" alt="Profile picture">
          @endif
          <div class="px-6 py-4">
          <div class="font-bold text-xl mb-2">
            {{ $user->name }}
          </div>
          <p class="text-gray-700 text-base">
            {{ $city->name }}
          </p>
          </div>
          <div class="px-6 pt-4 pb-2">
            @foreach ($user->petsitter_services as $petsitter_service)
              <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                {{ $petsitter_service->service->name }}
              </span>
            @endforeach
          </div>
        </a>
      </div>
      @endforeach
    </div>
    @else
</div>

<div class="flex flex-col items-center justify-center w-full">
  <p class="mb-2 text-2xl font-bold text-center text-gray-800 md:text-3xl">
    <span class="text-emerald-700">Ups!</span> Nie znaleziono opiekunów
  </p>
  <p class="mb-8 text-center text-gray-500 md:text-lg">
    Niestety nie znaleziono opiekunów przy użyciu podanych filtrów, spróbuj poszukać innymi kryteriami.
  </p>
</div>

@endunless