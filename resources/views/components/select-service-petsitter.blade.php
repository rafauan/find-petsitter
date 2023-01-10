@props(['petsitter_services'])

<label for="service_id" class="block font-medium text-sm text-gray-700">{{ __('Service') }}</label>
<select 
    id="service_id" 
    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-700 focus:border-emerald-700 block w-full p-2.5"
    aria-label="service_id" 
    name="service_id" 
    id="service_id" 
    required="required" 
    autofocus="autofocus" 
    autocomplete="service_id"
>
    @foreach ($petsitter_services as $petsitter_service)
        <option value="{{ $petsitter_service->service->id }}">{{ $petsitter_service->service->name }}</option>
    @endforeach
</select>
<x-input-error :messages="$errors->get('service_id')" class="mt-2" />