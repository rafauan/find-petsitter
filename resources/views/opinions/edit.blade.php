@if(Auth::user()->role == 'Admin')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inquiry') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    
    <div class="p-4 my-6 sm:p-8 bg-white shadow sm:rounded-lg">
    
        <div class="mb-4">
        </div>

    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Inquiry Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update inquiry information.") }}
        </p>
    </header>

    <form method="post" action="{{ route('opinions.update', $opinion->id) }}">
        @method('PATCH') 
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
            >{{ $opinion->text }}</textarea>
            <x-input-error :messages="$errors->get('text')" class="mt-2" />
        </div>

        <div class="mt-2">
            <label for="score" class="block font-medium text-sm text-gray-700">{{ __('Score') }}</label>
            <select id="score" class="
                bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-700 focus:border-emerald-700 block w-full p-2.5"
                aria-label="score" name="score" id="score" required="required" autofocus="autofocus" autocomplete="score"    
            >
                <option value="{{ $score }}" selected>{{ $score }}</option>
                @foreach ($scores as $score)
                    <option value="{{ $score }}">{{ $score }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('score')" class="mt-2" />
        </div>

        <div class="mt-2">
            <label class="block font-medium text-sm text-gray-700" for="status">{{ __('Status') }}</label>            
            <div class="flex justify-left" style="margin-top: 0 !important">
                <div class="w-full">
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
                    
                    @if($opinion->status == 'Pending') {
                        <option selected value="Pending">{{ __('Pending') }}</option>
                        <option value="Published">{{ __('Published') }}</option>
                    }
    
                    @elseif($opinion->status == 'Published') {
                        <option selected value="Published">{{ __('Published') }}</option>
                        <option value="Pending">{{ __('Pending') }}</option>
                    }
                    
                    @endif
                
                </select>
                </div>
            </div>
        </div>

        <div class="mt-2">
            {{-- @php
                $customers = App\Models\User::where('role', 'Customer')->where('status', 'Published')->get();
            @endphp --}}
            <label for="customer_id" class="block font-medium text-sm text-gray-700">{{ __('Customer') }}</label>
            <select id="customer_id" class="
                bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-700 focus:border-emerald-700 block w-full p-2.5"
                aria-label="customer_id" name="customer_id" id="customer_id" required="required" autofocus="autofocus" autocomplete="customer_id"  
            >
                <option value="{{ $customer->id }}" selected>{{ $customer->name }}</option>
                @foreach ($other_customers as $other_customer)
                    <option value="{{ $other_customer->id }}">{{ $other_customer->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('customer_id')" class="mt-2" />
        </div>

        <div class="mt-2">
            {{-- @php
                $petsitters = App\Models\User::where('role', 'Petsitter')->where('status', 'Published')->get();
            @endphp --}}
            <label for="petsitter_id" class="block font-medium text-sm text-gray-700">{{ __('Petsitter') }}</label>
            <select id="petsitter_id" class="
                bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-700 focus:border-emerald-700 block w-full p-2.5"
                aria-label="petsitter_id" name="petsitter_id" id="petsitter_id" required="required" autofocus="autofocus" autocomplete="petsitter_id"  
            >
                <option value="{{ $petsitter->id }}" selected>{{ $petsitter->name }}</option>
                @foreach ($other_petsitters as $other_petsitter)
                    <option value="{{ $other_petsitter->id }}">{{ $other_petsitter->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('petsitter_id')" class="mt-2" />
        </div>

        <div class="mt-4">
            <a href="/opinions/{{ $opinion->id }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-emerald-700 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
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