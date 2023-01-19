@props(['user'])

{{-- @unless(count($user->opinions) == 0) --}}
@foreach($user->opinions as $opinion)
@if($opinion->status === 'Published') 
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
@else 
<p class="text-neutral-400 italic">
  {{ __('The user does not have opinions') }}
</p>
@endif

@endforeach