<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    
        <div class="p-4 my-12 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="flex flex-col">

                <div
                    class="p-12 text-center relative overflow-hidden bg-no-repeat bg-cover rounded-lg"
                    style="
                        @if(Auth::user()->role == "Admin")
                            background-image: url('https://images.unsplash.com/photo-1501854140801-50d01698950b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');
                        @elseif(Auth::user()->role == "Customer")
                            background-image: url('https://images.unsplash.com/photo-1545121436-87364761152c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80');
                        @else
                            background-image: url('https://images.unsplash.com/photo-1560211653-55f9fb833a8e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80');
                        @endif
                        height: 200px;"
                    >
                    <div
                        class="absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden bg-fixed"
                        style="background-color: rgba(0, 0, 0, 0.6)"
                    >
                        <div class="flex justify-center items-center h-full">
                        <div class="text-white">
                            <h2 class="font-normal text-4xl mb-4">{{ __('Welcome') }}, {{ Auth::user()->name }}</h2>
                            <h4 class="font-normal text-xl mb-6">{{ __('Type of your account') }} - {{ __(Auth::user()->role) }}</h4>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">

                        @if(Auth::user()->role == 'Admin')
                        <section class="text-gray-600 body-font">
                            <div class="container px-5 py-12 mx-auto">
                              <div class="flex flex-wrap -m-4 text-center">
                                <div class="p-4 sm:w-1/4 w-1/2">
                                  <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">{{ count($users) }}</h2>
                                  <p class="leading-relaxed">{{ __('Users') }}</p>
                                </div>
                                <div class="p-4 sm:w-1/4 w-1/2">
                                  <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">{{ count($inquiries) }}</h2>
                                  <p class="leading-relaxed">{{ __('Inquiries') }}</p>
                                </div>
                                <div class="p-4 sm:w-1/4 w-1/2">
                                  <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">35</h2>
                                  <p class="leading-relaxed">{{ __('Cities') }}</p>
                                </div>
                                <div class="p-4 sm:w-1/4 w-1/2">
                                  <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">4</h2>
                                  <p class="leading-relaxed">{{ __('Services') }}</p>
                                </div>
                              </div>
                            </div>
                        </section>

                          <section>
                            <div class="mb-4">
                                <h5 class="text-xl font-normal leading-normal mt-0 mb-2 text-gray-800">
                                    {{ __('Newest account') }} 
                                </h5>
                                <p>
                                    <a 
                                        class="hover:text-emerald-700 cursor-pointer transition ease-in-out duration-150 text-neutral-500"
                                        href="/users/{{ $latestUser->id }}">{{ $latestUser->email }}
                                    </a>
                                </p>
                            </div>
    
                            <div class="mb-4">
                                <h5 class="text-xl font-normal leading-normal mt-0 mb-2 text-gray-800">
                                    {{ __('Newest inquiries') }}
                                </h5>
                                <p>
                                    @unless(count($latestInquiries) == 0)
                                        @foreach($latestInquiries as $latestInquiry)
                                        <a 
                                            class="hover:text-emerald-700 cursor-pointer transition ease-in-out duration-150 text-neutral-500"
                                            href="/inquiries/{{ $latestInquiry->id }}">{{ $latestInquiryUser->name }}
                                        </a>
                                        <br/>
                                        @endforeach
        
                                    @else 
        
                                        <p class="text-neutral-400 italic">
                                            {{ __('Not found') }}
                                        </p>
    
                                    @endunless
                                </p>
                            </div> 

                            <div class="mb-4">
                                <h5 class="text-xl font-normal leading-normal mt-0 mb-2 text-gray-800">
                                    {{ __('Newest opinions') }}
                                </h5>
                                <p>
                                    @unless(count($latestOpinions) == 0)
                                        @foreach($latestOpinions as $latestOpinion)
                                        <a 
                                            class="hover:text-emerald-700 cursor-pointer transition ease-in-out duration-150 text-neutral-500"
                                            href="/opinions/{{ $latestOpinion->id }}">{{ $latestOpinionUser->name }}
                                        </a>
                                        <br/>
                                        @endforeach
        
                                    @else 
        
                                        <p class="text-neutral-400 italic">
                                            {{ __('Not found') }}
                                        </p>
    
                                    @endunless
                                </p>
                            </div> 
                          </section>
                        @endif

                        @if(Auth::user()->role == 'Petsitter')

                            @if(Auth::user()->status == 'Draft')
                            <div class="bg-gray-100 border-l-4 border-gray-500 text-gray-700 p-4 mt-6" role="alert">
                                <p class="font-bold">{{ __('Your account is awaiting Admin approval.') }}</p>
                                <p>{{ __('When your account is approved we will inform you in an email and your account will appear in the search engine.') }}</p>
                            </div>
                            @endif

                            @if(Auth::user()->city_id == null || Auth::user()->profile_description == null)
                            <div class="bg-yellow-100 border-t-4 border-yellow-500 rounded-b text-yellow-900 px-4 py-3 shadow-md mt-6" role="alert">
                                <div class="flex">
                                  <div class="py-1"><svg class="fill-current h-6 w-6 text-yellow-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                                  <div>
                                    <p class="font-bold">{{ __('Complete the details in your profile.') }}</p>
                                    <p class="text-sm">{{ __('To create a better petsitter profile add the services performed, profile photo and profile description.') }}</p>
                                    <p class="text-sm">
                                        {{ __('You can edit the data') }} 
                                        <a href="{{ url('/profile') }}" class="font-bold hover:opacity-75 transition ease-in-out duration-150">
                                            {{ __('at this link.') }}
                                        </a>
                                    </p>
                                  </div>
                                </div>
                            </div>
                            @endif
                        @endif

                        @if(Auth::user()->role == 'Customer' && $customerInquiriesNumber === 0)
                            <div class="bg-gray-100 border-l-4 border-gray-500 text-gray-700 p-4 mt-6" role="alert">
                                <p class="font-bold">{{ __("It looks like you don't have any queries yet") }}</p>
                                <p>{{ __("Go to") }} <a href="/search" class="font-bold hover:opacity-75 transition ease-in-out duration-150">{{ __("search engine") }}</a> {{ __("to find the right petsitter")}}.</p>
                            </div>
                        @elseif(Auth::user()->role == 'Customer')
                            <section class="text-gray-600 body-font">
                                <div class="container px-5 py-12 mx-auto">
                                    <div class="flex flex-wrap -m-4 text-center">
                                        <div class="p-4 w-1/2">
                                            <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">{{ $customerInquiriesNumber }}</h2>
                                            <p class="leading-relaxed">{{ __('Your inquiries') }}</p>
                                        </div>
                                        <div class="p-4 w-1/2">
                                            <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">{{ $customerOpinionsNumber }}</h2>
                                            <p class="leading-relaxed">{{ __('Your opinions') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        @elseif(Auth::user()->role == 'Petsitter')
                            <section class="text-gray-600 body-font">
                                <div class="container px-5 py-12 mx-auto">
                                    <div class="flex flex-wrap -m-4 text-center">
                                        <div class="p-4 w-1/2">
                                            <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">{{ $petsitterInquiriesNumber }}</h2>
                                            <p class="leading-relaxed">{{ __('Your inquiries') }}</p>
                                        </div>
                                        <div class="p-4 w-1/2">
                                            <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">{{ $petsitterOpinionsNumber }}</h2>
                                            <p class="leading-relaxed">{{ __('Your opinions') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        @endif
                    </div>
                </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
