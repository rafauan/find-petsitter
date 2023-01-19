
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
        enctype="multipart/form-data"
        x-data="{ showService: false }" @change="if (event.target.id === 'role') { if (event.target.value === 'Petsitter') { showService = true } else { showService = false } }"
    >
        @csrf

        <!-- Profile image -->
        <div class="mt-4 mb-4">
            <x-input-file-form 
                label="Profile picture"
                name="profile_image"
                type="file"
            />
        </div>

        <!-- Full name -->
        <div class="mt-2">  
            <x-input-text-form 
                label="Full name"
                name="name" 
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- E-mail -->
        <div class="mt-2">  
            <x-input-text-form 
                label="E-mail"
                name="email" 
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-2">
            <x-input-option-form
                label="Role"
                name="role"
                :options="$roles"
                :extendedOption="false"
                :editUserRole="true"
            />
        </div>

        <!-- Status -->
        <div class="mt-2">
            <x-input-option-form
                label="Status"
                name="status"
                :options="$statuses"
                :extendedOption="false"
                :editUserRole="false"
            />
        </div>

        <!-- Services -->
        <div class="mt-2" x-show="showService">
            <x-input-fieldset-form 
                label="Services"
                name="Services[]"
                :options="$services"
            />
        </div>

        <!-- City -->
        <div class="mt-2">
            <x-input-option-form
                label="City"
                name="city_id"
                :options="$cities"
                :extendedOption="true"
                :editUserRole="false"
            />
        </div>

        <!-- Profile description -->
        <div class="mt-2">
            <x-input-textarea-form 
                label="Profile description"
                name="profile_description"
                placeholder="Profile description"
            />
            <x-input-error :messages="$errors->get('profile_description')" class="mt-2" />
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
