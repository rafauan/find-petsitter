@if(Auth::user()->role == 'Customer' && $opinion->customer_id == Auth::user()->id)
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Opinion') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    
        <div class="p-4 my-6 sm:p-8 bg-white shadow sm:rounded-lg">
        
            <div class="mb-4 flow-root">
                <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                    <form method="post" action="{{ route('opinions.destroy', $opinion->id) }}" class="p-6">
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
                                {{ __('Delete opinion') }}
                            </x-danger-button>
                        </div>
                    </form>
                </x-modal>
            </div>

            <div class="mb-4">
                <h5 class="text-2xl font-semibold leading-normal mt-0 mb-2 text-gray-800">
                    {{ __('Score') }}
                </h5>
                <p>
                    <x-star-rating :numberOfStars="$opinion->score" />
                </p>
            </div>

            <div class="mb-4">
                <h5 class="text-2xl font-semibold leading-normal mt-0 mb-2 text-gray-800">
                    {{ __('Message') }}
                </h5>
                <p>
                    {{ $opinion->text }}
                </p>
            </div>

            <div class="mb-4">
                <h5 class="text-2xl font-semibold leading-normal mt-0 mb-2 text-gray-800">
                    {{ __('Status') }}
                </h5>
                <p>
                    @if($opinion->status == 'Pending')
                        <span class="bg-neutral-400 text-white py-2 px-2 rounded">
                            {{ __($opinion->status) }}
                        </span>
                    @else
                        <span class="bg-emerald-600 text-white py-2 px-2 rounded">
                            {{ __($opinion->status) }}
                        </span>
                    @endif
                </p>
            </div>

            <div class="mb-4">
                <h5 class="text-2xl font-semibold leading-normal mt-0 mb-2 text-gray-800">
                    {{ __('Petsitter') }}
                </h5>
                <p>
                    <a 
                        class="text-emerald-700 hover:text-gray-800 cursor-pointer transition ease-in-out duration-150"
                        href="/show_profile/{{ $petsitter->id }}"
                        target="_blank"
                    >
                        {{ $petsitter->name }}
                    </a>     
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