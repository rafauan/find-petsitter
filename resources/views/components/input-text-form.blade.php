<label 
    for="{{ $name }}" 
    class="block font-medium text-sm text-gray-700"
>{{ __($label) }}</label>

<input 
    type="text" 
    class="border-gray-300 focus:border-emerald-700 focus:ring-emerald-700 rounded-md shadow-sm mt-1 block w-full" 
    name="{{ $name }}"
    value="{{ old($name, $value) }}"
/>