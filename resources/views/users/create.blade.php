
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
            <label class="block font-medium text-sm text-gray-700 mb-2" for="profile_image">{{ __('Profile picture') }}</label>
            <input type="file" class="text-sm text-grey-500 outline-none
                file:mr-5 file:py-2 file:px-6
                file:rounded-full file:border-0
                file:text-sm file:font-medium
                file:bg-emerald-700 file:text-white
                hover:file:cursor-pointer hover:file:bg-emerald-600
                hover:file:text-white file:transition file:ease-in-out file:duration-150
                "
                type="file"
                name="profile_image"
                id="profile_image"
            />
    </div>

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

        <!-- City -->
        <div class="mt-2">
            <label for="city_id" class="block font-medium text-sm text-gray-700">{{ __('City') }}</label>
            <select id="city_id" class="
                bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-700 focus:border-emerald-700 block w-full p-2.5"
                aria-label="city_id" name="city_id" id="city_id" required="required" autofocus="autofocus" autocomplete="city_id"    
            >
                {{-- <option value="{{ $city->id }}" selected>{{ $city->name }}</option> --}}
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('city_id')" class="mt-2" />
        </div>

        <!-- Profile description -->
        <div class="mt-2">
            <label for="profile_description" class="block font-medium text-sm text-gray-700 mb-1">{{ __('Message') }}</label>
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
                name="profile_description"
                id="profile_description"
                rows="3"
                required="required"
                placeholder="{{__('Profile description')}}"
            >{{ __('Your account description') }}</textarea>
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
