<label for="{{ $name }}" class="block font-medium text-sm text-gray-700 mb-1">{{ __($label) }}</label>
<textarea
    class="
        form-control
        block
        w-full
        px-3
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-emerald-700 focus:outline-none
    "
    name="{{ $name }}"
    id="{{ $name }}"
    rows="3"
    required="required"
    placeholder="{{__($placeholder)}}"
></textarea>