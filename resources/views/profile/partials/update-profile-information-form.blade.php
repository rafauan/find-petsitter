<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        @if(Auth::user()->status == 'Draft')
        <div class="bg-gray-100 border-l-4 border-gray-500 text-gray-700 p-4 mt-6" role="alert">
            <p class="font-bold">{{ __('Your account is awaiting Admin approval.') }}</p>
            <p>{{ __("Your account is in 'Draft' status, we will inform you when the administrator approves your data.") }}</p>
        </div>
        @endif

        <div>
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
                    src="{{ Storage::url('public/profile_images/blank_profile_picture.png') }}" 
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

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-700">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <label for="city_id" class="block font-medium text-sm text-gray-700">{{ __('City') }}</label>
            <select id="city_id" class="
                bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-700 focus:border-emerald-700 block w-full p-2.5"
                aria-label="city_id" name="city_id" id="city_id" required="required" autofocus="autofocus" autocomplete="city_id"    
            >
                <option value="{{ $city->id }}" selected>{{ $city->name }}</option>
                @foreach ($other_cities as $other_city)
                    <option value="{{ $other_city->id }}">{{ $other_city->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('city_id')" class="mt-2" />
        </div>

        @if(Auth::user()->role == 'Petsitter')
        <div>
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
        @endif

        <div>
            <label for="profile_description" class="block font-medium text-sm text-gray-700">{{ __('Profile description') }}</label>
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
            >{{ old('profile_description', $user->profile_description) }}</textarea>
            <x-input-error :messages="$errors->get('profile_description')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
