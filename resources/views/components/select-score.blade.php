<label for="score" class="block font-medium text-sm text-gray-700">{{ __('Score') }}</label>
<select id="score" class="
    bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-700 focus:border-emerald-700 block w-full p-2.5"
    aria-label="score" name="score" id="score" required="required" autofocus="autofocus" autocomplete="score"    
>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
</select>
<x-input-error :messages="$errors->get('score')" class="mt-2" />