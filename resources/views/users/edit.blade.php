@if(Auth::user()->role == 'Admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    
    <div class="p-4 my-6 sm:p-8 bg-white shadow sm:rounded-lg">
    
        <div class="mb-4">
        </div>

    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('User Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update user information.") }}
        </p>
    </header>

    <form method="post" action="{{ route('users.update', $user->id) }}">
        @method('PATCH') 
        @csrf
        <div class="mt-2">
            <label class="block font-medium text-sm text-gray-700" for="name">{{ __('Name') }}</label>            
            <input class="border-gray-300 focus:border-emerald-700 focus:ring-emerald-700 rounded-md shadow-sm mt-1 block w-full" id="name" name="name" type="text" value="{{ $user->name }}" required="required" autofocus="autofocus" autocomplete="name">
        </div>

        <div class="mt-2">
            <label class="block font-medium text-sm text-gray-700" for="email">{{ __('E-mail') }}</label>            
            <input class="border-gray-300 focus:border-emerald-700 focus:ring-emerald-700 rounded-md shadow-sm mt-1 block w-full" id="email" name="email" type="text" value="{{ old('email', $user->email) }}" required="required" autofocus="autofocus" autocomplete="email">
            @foreach($errors->all() as $error)
                <p class="text-red-600 text-sm">{{ __($error) }}</p>
            @endforeach
        </div>

        <div class="mt-2">
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
                        <option value="Moderator">{{ __('Moderator') }}</option>
                    }
    
                    @elseif($user->role == 'Petsitter') {
                        <option selected value="Petsitter">{{ __('Petsitter') }}</option>
                        <option value="Admin">{{ __('Admin') }}</option>
                        <option value="Moderator">{{ __('Moderator') }}</option>
                    }
    
                    @elseif($user->role == 'Moderator') {
                        <option selected value="Moderator">{{ __('Moderator') }}</option>
                        <option value="Admin">{{ __('Admin') }}</option>
                        <option value="Petsitter">{{ __('Petsitter') }}</option>
                    }
                    
                    @endif
                
                </select>
                </div>
            </div>
        </div>

        <div class="mt-2">
            <label class="block font-medium text-sm text-gray-700" for="status">{{ __('Status') }}</label>            
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
                    focus:text-gray-700 focus:bg-white focus:ring-emerald-700 focus:outline-none" aria-label="status" name="status" id="status" required="required" autofocus="autofocus" autocomplete="status">
                    
                    @if($user->status == 'Published') {
                        <option selected value="Published">{{ __('Published') }}</option>
                        <option value="Blocked">{{ __('Blocked') }}</option>
                        <option value="Draft">{{ __('Draft') }}</option>
                    }
    
                    @elseif($user->status == 'Draft') {
                        <option selected value="Draft">{{ __('Draft') }}</option>
                        <option value="Blocked">{{ __('Blocked') }}</option>
                        <option value="Published">{{ __('Published') }}</option>
                    }
    
                    @elseif($user->status == 'Blocked') {
                        <option selected value="Blocked">{{ __('Blocked') }}</option>
                        <option value="Published">{{ __('Published') }}</option>
                        <option value="Draft">{{ __('Draft') }}</option>
                    }
                    
                    @endif
                
                </select>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-700 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Save') }}
            </button>
        </div>
    </form>

    </div>

    </div>
</x-app-layout>
@else 
<script type="text/javascript">
    window.location.href = "{{ url('/dashboard') }}";
</script>
@endif