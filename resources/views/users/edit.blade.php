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

        <p class="mt-1 mb-4 text-sm text-gray-600">
            {{ __("Update user information.") }}
        </p>
    </header>

        <form 
            method="post" 
            action="{{ route('users.update', $user->id) }}"
            enctype="multipart/form-data"
            @if($user->role == 'Petsitter')
                x-data="{ showService: true }" @change="if (event.target.id === 'role') { if (event.target.value === 'Petsitter') { showService = true } else { showService = false } }
            @else 
                x-data="{ showService: false }" @change="if (event.target.id === 'role') { if (event.target.value === 'Petsitter') { showService = true } else { showService = false } }
            @endif
        ">        
        @method('PATCH') 
        @csrf

        <div class="mt-2">
                @if($profile_image_url != null)
                    <img 
                        class="w-24 h-24 rounded-full mb-4" 
                        style="object-fit:cover;" 
                        src="{{ Storage::url($profile_image_url) }}" 
                        alt="Profile picture"
                    >

                    <label class="block font-medium text-sm text-gray-700 mb-2" for="profile_image_id">{{ __('Change image') }}</label>
                @else 
                    <label class="block font-medium text-sm text-gray-700 mb-2" for="profile_image_id">{{ __('Profile picture') }}</label>

                    <img 
                        class="w-24 h-24 rounded-full mb-4" 
                        style="object-fit:cover;" 
                        src="https://images.unsplash.com/photo-1558203728-00f45181dd84?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2674&q=80" 
                        alt="Profile picture"
                    >
                @endif

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

        <div class="mt-2" x-show="showService">
            <p class="block my-2 text-sm font-medium text-gray-900">{{ __('Services') }}</p>
            <fieldset class="flex flex-wrap gap-3">
                @foreach($user_services as $user_service) 
                <div>
                    <input
                      type="checkbox"
                      name="user_services[]"
                      value="{{ $user_service->id }}"
                      id="{{ $user_service->id }}"
                      class="peer hidden"
                    />
                    <label
                      for="{{ $user_service->id }}"
                      class="flex cursor-pointer items-center justify-center rounded-md border py-2 px-3 hover:border-gray-200 border-emerald-700 bg-emerald-700 text-white peer-checked:border-gray-300 peer-checked:bg-white peer-checked:text-gray-900"
                    >
                      <p class="text-sm font-medium">{{ $user_service->name }}</p>
                    </label>
                </div>
                @endforeach
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

        <div class="mt-2">
            <label for="profile_description" class="block font-medium text-sm text-gray-700">{{ __('Message') }}</label>
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
            >{{ $user->profile_description }}</textarea>
            <x-input-error :messages="$errors->get('profile_description')" class="mt-2" />
        </div>

        <div class="mt-4">
            <a href="/users/{{ $user->id }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-700 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                {{ __('Cancel') }}
            </a>

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