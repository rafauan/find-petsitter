@props(['user'])

<label class="block font-medium text-sm text-gray-700" for="role">{{ __('Role') }}</label>            
<div class="flex justify-left" style="margin-top: 0 !important">
    <div class="xl:w-96">
    <select class="form-select appearance-none
        block
        w-full
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding bg-no-repeat
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        focus:text-gray-700 focus:bg-white focus:ring-emerald-700 focus:outline-none" aria-label="role" name="role" id="role" required="required" autofocus="autofocus" autocomplete="role">

        @if($user->role == 'Admin') {
            <option selected value="Admin">{{ __('Admin') }}</option>
            <option value="Petsitter">{{ __('Petsitter') }}</option>
            <option value="Customer">{{ __('Customer') }}</option>
        }

        @elseif($user->role == 'Petsitter') {
            <option selected value="Petsitter">{{ __('Petsitter') }}</option>
            <option value="Admin">{{ __('Admin') }}</option>
            <option value="Customer">{{ __('Customer') }}</option>
        }

        @elseif($user->role == 'Customer') {
            <option selected value="Customer">{{ __('Customer') }}</option>
            <option value="Admin">{{ __('Admin') }}</option>
            <option value="Petsitter">{{ __('Petsitter') }}</option>
        }
        
        @endif
    
    </select>
    </div>
</div>