
<label class="block font-medium text-sm text-gray-700 mb-2" for="{{ $name }}">{{ __($label) }}</label>
<input type="file" class="text-sm text-grey-500 outline-none
    file:mr-5 file:py-2 file:px-6
    file:rounded-full file:border-0
    file:text-sm file:font-medium
    file:bg-emerald-700 file:text-white
    hover:file:cursor-pointer hover:file:bg-emerald-600
    hover:file:text-white file:transition file:ease-in-out file:duration-150
    "
    type="{{ $type }}"
    name="{{ $name }}"
    id="{{ $name }}"
/>