@props(['city'])

<label for="city_id" class="block font-medium text-sm text-gray-700">{{ __('City') }}</label>
<select id="city_id" class="
    bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-700 focus:border-emerald-700 block w-full p-2.5"
    aria-label="city_id" name="city_id" id="city_id" required="required" autofocus="autofocus" autocomplete="city_id"    
>
  <option value="{{ $city->id }}">{{ $city->name }}</option>
</select>
<x-input-error :messages="$errors->get('city_id')" class="mt-2" />