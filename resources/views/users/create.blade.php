
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    
    <div class="p-4 my-6 sm:p-8 bg-white shadow sm:rounded-lg">
    
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('User - new') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Create a new user.") }}
        </p>
    </header>

    <form 
        method="post" 
        action="{{ route('users.store') }}" 
        x-data="{ showService: false }" @change="if (event.target.id === 'role') { if (event.target.value === 'Petsitter') { showService = true } else { showService = false } }"
    >
        @csrf
        <!-- Full name -->
        <div class="mt-2">    
            <label for="name" class="block font-medium text-sm text-gray-700">{{ __('Full name') }}</label>
            <input type="text" class="border-gray-300 focus:border-emerald-700 focus:ring-emerald-700 rounded-md shadow-sm mt-1 block w-full" name="name"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- E-mail -->
        <div class="mt-2">
            <label for="email" class="block font-medium text-sm text-gray-700">{{ __('E-mail') }}</label>
            <input type="text" class="border-gray-300 focus:border-emerald-700 focus:ring-emerald-700 rounded-md shadow-sm mt-1 block w-full" name="email"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role -->
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
    
                    <option>{{ __('Select role') }}</option>
                    <option value="Admin">{{ __('Admin') }}</option>
                    <option value="Petsitter">{{ __('Petsitter') }}</option>
                    <option value="Customer">{{ __('Customer') }}</option>
                    
                </select>
                </div>
            </div>
        </div>

        <!-- Status -->
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
                    
                    <option>{{ __('Select status') }}</option>
                    <option value="Published">{{ __('Published') }}</option>
                    <option value="Blocked">{{ __('Blocked') }}</option>
                    <option value="Draft">{{ __('Draft') }}</option>
                    
                </select>
                </div>
            </div>
        </div>

        <div class="mt-2" x-show="showService">
            <p class="block my-2 text-sm font-medium text-gray-900">{{ __('Services') }}</p>
            <fieldset class="flex flex-wrap gap-3">
                @foreach($services as $service) 
                <div>
                    <input
                      type="checkbox"
                      name="services[]"
                      value="{{ $service->id }}"
                      id="{{ $service->id }}"
                      class="peer hidden"
                    />
                    <label
                      for="{{ $service->id }}"
                      class="flex cursor-pointer items-center justify-center rounded-md border border-gray-300 py-2 px-3 text-gray-900 hover:border-gray-200 peer-checked:border-emerald-700 peer-checked:bg-emerald-700 peer-checked:text-white"
                    >
                      <p class="text-sm font-medium">{{ $service->name }}</p>
                    </label>
                </div>
                @endforeach
              </fieldset>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Buttons -->
        <div class="mt-4">
            <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-700 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                {{ __('Cancel') }}
            </a>

            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-700 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Create') }}
            </button>
        </div>

    </form>

    </div>

    </div>
</x-app-layout>
