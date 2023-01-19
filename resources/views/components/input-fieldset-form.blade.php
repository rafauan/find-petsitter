<p class="block my-2 text-sm font-medium text-gray-900">{{ __($label) }}</p>
<fieldset class="flex flex-wrap gap-3">
    @foreach($options as $option) 
    <div>
        <input
            type="checkbox"
            name="{{ $name }}"
            value="{{ $option->id }}"
            id="{{ $option->id }}"
            class="peer hidden"
        />
        <label
            for="{{ $option->id }}"
            class="flex cursor-pointer items-center justify-center rounded-md border border-gray-300 py-2 px-3 text-gray-900 hover:border-gray-200 peer-checked:border-emerald-700 peer-checked:bg-emerald-700 peer-checked:text-white"
        >
            <p class="text-sm font-medium">{{ $option->name }}</p>
        </label>
    </div>
    @endforeach
</fieldset>