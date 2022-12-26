@if(Auth::user()->role == 'Admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Opinion') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    
    <div class="p-4 my-6 sm:p-8 bg-white shadow sm:rounded-lg">
    
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Opinion - new') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Create a new opinion.") }}
        </p>
    </header>

    <form method="post" action="{{ route('opinions.store') }}" name="new_opinion">
        @csrf

        <div class="mt-2">
            <label for="text" class="block font-medium text-sm text-gray-700">{{ __('Text') }}</label>
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
                name="text"
                id="text"
                rows="3"
                required="required"
                placeholder="{{__('Your text')}}"
            ></textarea>
            <x-input-error :messages="$errors->get('text')" class="mt-2" />
        </div>

        <div class="mt-2">
            <label for="score" class="block font-medium text-sm text-gray-700">{{ __('Score') }}</label>
            <select id="score" class="
                bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-700 focus:border-emerald-700 block w-full p-2.5"
                aria-label="score" name="score" id="score" required="required" autofocus="autofocus" autocomplete="score"    
            >
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <x-input-error :messages="$errors->get('score')" class="mt-2" />
        </div>

        <div class="mt-2">
            @php
                $customers = App\Models\User::where('role', 'Customer')->where('status', 'Published')->get();
            @endphp
            <label for="customer_id" class="block font-medium text-sm text-gray-700">{{ __('Customer') }}</label>
            <select id="customer_id" class="
                bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-700 focus:border-emerald-700 block w-full p-2.5"
                aria-label="customer_id" name="customer_id" id="customer_id" required="required" autofocus="autofocus" autocomplete="customer_id"  
            >
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('customer_id')" class="mt-2" />
        </div>

        <div class="mt-2">
            @php
                $petsitters = App\Models\User::where('role', 'Petsitter')->where('status', 'Published')->get();
            @endphp
            <label for="petsitter_id" class="block font-medium text-sm text-gray-700">{{ __('Petsitter') }}</label>
            <select id="petsitter_id" class="
                bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-700 focus:border-emerald-700 block w-full p-2.5"
                aria-label="petsitter_id" name="petsitter_id" id="petsitter_id" required="required" autofocus="autofocus" autocomplete="petsitter_id"  
            >
                @foreach ($petsitters as $petsitter)
                    <option value="{{ $petsitter->id }}">{{ $petsitter->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('customer_id')" class="mt-2" />
        </div>

        <div class="mt-4">
            <a href="{{ route('inquiries.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-700 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
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
@else 
<script type="text/javascript">
    window.location.href = "{{ url('/dashboard') }}";
</script>
@endif