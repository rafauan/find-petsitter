@if(Auth::user()->role == 'Admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Opinion') }}
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
                <a href="{{ route('opinions.edit', $opinion->id)}}" class="float-left inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-emerald-700 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Edit') }}
                </a>

                <x-danger-button
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                    class="float-right"
                >{{ __('Delete opinion') }}</x-danger-button>
            
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
                                {{ __('Delete Account') }}
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
                    {{ $opinion->score }}
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
                    {{ __('Petsitter') }}
                </h5>
                <p>
                    @php 
                        $petsitter = App\Models\User::find($opinion->petsitter_id);
                    @endphp 
                    <a 
                        class="text-emerald-700 hover:text-gray-800 cursor-pointer transition ease-in-out duration-150"
                        href="/users/{{ $petsitter->id }}">{{ $petsitter->name }}
                    </a>    
                </p>
            </div>

            <div class="mb-4">
                <h5 class="text-2xl font-semibold leading-normal mt-0 mb-2 text-gray-800">
                    {{ __('Customer') }}
                </h5>
                <p>
                    @php 
                        $customer = App\Models\User::find($opinion->customer_id);
                    @endphp 
                    <a 
                        class="text-emerald-700 hover:text-gray-800 cursor-pointer transition ease-in-out duration-150"
                        href="/users/{{ $customer->id }}">{{ $customer->name }}
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