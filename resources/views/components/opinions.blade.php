@props(['user'])

@if(count($user->opinions) === 0 || $user->opinions->every->status === 'Pending')
  <p class="text-neutral-400 italic">
    {{ __('The user does not have opinions') }}
  </p>
@else

  @foreach($user->opinions as $opinion)
    <div class="mb-8">
      <div class="flex justify-between">
        <p class="text-gray-500">{{ $opinion->customer->name }}</p>
        <x-star-rating :numberOfStars="$opinion->score" />
      </div>
      <div class="mt-1">{{ $opinion->text }}</div>
    </div>
  @endforeach

@endif