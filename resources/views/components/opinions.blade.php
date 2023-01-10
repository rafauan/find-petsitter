@props(['user'])

@foreach($user->opinions as $opinion) 
<div class="mb-8">
  <div class="flex justify-between">
    <p class="text-gray-500">
      {{ $opinion->customer->name }}
    </p>
    <x-star-rating :numberOfStars="$opinion->score" />
  </div>
  <div class="mt-1">
    {{ $opinion->text }}
  </div>
</div>
@endforeach