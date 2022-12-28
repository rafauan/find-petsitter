@if(Auth::user()->role == 'Admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    
        <div class="p-4 my-6 sm:p-8 bg-white shadow sm:rounded-lg">
        
            @if(session()->get('success'))
            <div 
                class="bg-green-100 rounded-lg py-5 px-6 mb-4 text-base text-green-700" 
                x-data="{ show: true }" 
                x-show="show" 
                x-init="setTimeout(() => show = false, 2000)"
                role="alert"
                x-transition.duration.500ms
            >
                {{ session()->get('success') }}  
            </div>
            @endif

            <div class="mb-4 flow-root">
                <a href="{{ route('users.edit', $user->id)}}" class="float-left inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-700 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Edit') }}
                </a>

                <x-danger-button
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                    class="float-right"
                >{{ __('Delete Account') }}</x-danger-button>
            
                <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                    <form method="post" action="{{ route('users.destroy', $user->id) }}" class="p-6">
                        @csrf
                        @method('delete')
            
                        <h1 class="text-lg font-medium text-gray-900">{{ __('Are you sure your want to delete this account?') }}</h1>
            
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                        </p>
            
                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Cancel') }}
                            </x-secondary-button>
            
                            <x-danger-button class="ml-3">
                                {{ __('Delete Account') }}
                            </x-danger-button>
                        </div>
                    </form>
                </x-modal>
            </div>

            <div class="mb-4">
                <h5 class="text-2xl font-semibold leading-normal mt-0 mb-2 text-gray-800">
                    {{ __('Profile picture') }}
                </h5>
                @if($profile_image_url != null) 
                    <img 
                        class="w-24 h-24 rounded-full" 
                        style="object-fit:cover;" 
                        src="{{ Storage::url($profile_image_url) }}" 
                        alt="Profile picture"
                    >
                @else
                    <img 
                        class="w-24 h-24 rounded-full" 
                        style="object-fit:cover;" 
                        src="{{ Storage::url('public/profile_images/blank_profile_picture.png') }}"  
                        alt="Profile picture"
                    >
                @endif
            </div>

            <div class="mb-4">
                <h5 class="text-2xl font-semibold leading-normal mt-0 mb-2 text-gray-800">
                    {{ __('Name') }}
                </h5>
                <p>
                    {{ $user->name }}
                </p>
            </div>

            <div class="mb-4">
                <h5 class="text-2xl font-semibold leading-normal mt-0 mb-2 text-gray-800">
                    {{ __('E-mail') }}
                </h5>
                <p>
                    {{ $user->email }}
                </p>
            </div>

            <div class="mb-4">
                <h5 class="text-2xl font-semibold leading-normal mt-0 mb-2 text-gray-800">
                    {{ __('Role') }}
                </h5>
                <p>
                    @if ($user->role != null)
                        {{ __($user->role) }}
                    @else 
                        {{ __('Not found') }}
                    @endif
                </p>
            </div>

            <div class="mb-4">
                <h5 class="text-2xl font-semibold leading-normal mt-0 mb-2 text-gray-800">
                    {{ __('Status') }}
                </h5>
                <p>
                    @if ($user->status != null)
                        {{ __($user->status) }}
                    @else 
                        {{ __('Not found') }}
                    @endif
                </p>
            </div>

            <div class="mb-4">
                <h5 class="text-2xl font-semibold leading-normal mt-0 mb-2 text-gray-800">
                    {{ __('City') }}
                </h5>

                @if($city !== null)
                <a 
                    class="text-emerald-700 hover:text-gray-800 cursor-pointer transition ease-in-out duration-150"
                    href="/cities/{{ $city->id }}">{{ $city->name }}
                </a>

                @else 

                    <p class="text-neutral-400 italic">
                        {{ __('City not selected') }}
                    </p>

                @endif
            </div>

            <div class="mb-4">
                <h5 class="text-2xl font-semibold leading-normal mt-0 mb-2 text-gray-800">
                    {{ __('Creation date') }}
                </h5>
                <p>
                    {{ $user->created_at }}
                </p>
            </div>

            @if($user->role == 'Petsitter')
            <div class="mb-4">
                <h5 class="text-2xl font-semibold leading-normal mt-0 mb-2 text-gray-800">
                    {{ __('Services') }}
                </h5>
                @unless(count($services) == 0)
                    @foreach($services as $service)
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                            {{ $service->name }}
                        </span>
                    @endforeach

                    @else
                    <p class="text-neutral-400 italic">
                        {{ __('The user does not have services') }}
                    </p>
                @endunless
            </div>
            @endif

            <div class="mb-4">
                <h5 class="text-2xl font-semibold leading-normal mt-0 mb-2 text-gray-800">
                    {{ __('Profile description') }}
                </h5>
                <p>
                    {{ $user->profile_description }}
                </p>
            </div>

        </div>

    </div>
</x-app-layout>
@else 
<script type="text/javascript">
    window.location.href = "{{ url('/dashboard') }}";
</script>
@endif