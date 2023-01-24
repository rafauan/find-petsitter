<label class="block font-medium text-sm text-gray-700" for="status">{{ __($label) }}</label>            
<div class="flex justify-left" style="margin-top: 0 !important">
    <div class="w-full">
    <select class="form-select appearance-none
        w-full
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding bg-no-repeat
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        focus:text-gray-700 focus:bg-white focus:ring-emerald-700 focus:outline-none" aria-label="{{ $name }}" name="{{ $name }}" id="{{ $name }}" required="required" autofocus="autofocus" autocomplete="{{ $name }}">
        @foreach($options as $option) 
            @if($extendedOption == true)
                <option value="{{ $option->id }}">{{ __($option->name) }}
            @else
                <option value="{{ $option }}">{{ __($option) }}
            @endif
        @endforeach    
    </select>
    </div>
</div>