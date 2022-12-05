@extends('website.layouts.main')

@section('content')
<header>
    <!-- Background image -->
    <div class="relative overflow-hidden bg-no-repeat bg-cover" style="
      background-position: 50%;
      background-image: url('https://images.unsplash.com/photo-1581888227599-779811939961?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1674&q=80');
      height: 300px;
    ">
      <div class="absolute top-0 right-0 bottom-0 left-0 w-full h-full overflow-hidden bg-fixed"
        style="background-color: rgba(37, 37, 37, 0.75)">
        <div class="flex justify-center items-center h-full">
          <div class="text-center text-white px-6 md:px-12">
            <h1 class="text-5xl font-semibold mt-0 mb-3">Znajdź opiekuna</h1>
            <p>Wyślij zapytanie wśród 134 opiekunów</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Background image -->
</header>


<div class="flex flex-col items-left">
    
</div>


<div class="flex flex-col items-center h-full" x-data="show: true">

    <div class="flex justify-self-start flex-col bg-white w-9/12">
        <p class="text-3xl font-semibold pl-8 pt-8">Wybrane filtry:</p>    

        <form class="px-8">   
            {{-- <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="search" id="default-search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search Mockups, Logos..." required>
                <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
            </div> --}}
    
            <div>
                <label for="countries" class="block mt-4 mb-2 text-sm font-medium text-gray-900">Wybierz miasto</label>
                <select id="countries" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-700 focus:border-emerald-700 block w-full p-2.5">
                  <option selected>Miasto</option>
                  <option value="US">Gdynia</option>
                  <option value="CA">Gdańsk</option>
                  <option value="FR">Warszawa</option>
                  <option value="DE">Wrocław</option>
                  <option value="DE">Łódź</option>
                  <option value="DE">Kraków</option>
                  <option value="DE">Białystok</option>
                  <option value="DE">Lublin</option>
                </select>
            </div>
    
            <div>
                <p class="block my-2 text-sm font-medium text-gray-900">Waga psa</p>
                <fieldset class="flex flex-wrap gap-3">
                    <legend class="sr-only">Waga</legend>
                  
                    <div>
                      <input
                        type="radio"
                        name="ColorOption"
                        value="ColorBlack"
                        id="ColorBlack"
                        class="peer hidden"
                        checked
                      />
                  
                      <label
                        for="ColorBlack"
                        class="flex cursor-pointer items-center justify-center rounded-md border border-gray-100 py-2 px-3 text-gray-900 hover:border-gray-200 peer-checked:border-emerald-700 peer-checked:bg-emerald-700 peer-checked:text-white"
                      >
                        <p class="text-sm font-medium">do 5 kg</p>
                      </label>
                    </div>
                  
                    <div>
                      <input
                        type="radio"
                        name="ColorOption"
                        value="ColorRed"
                        id="ColorRed"
                        class="peer hidden"
                      />
                  
                      <label
                        for="ColorRed"
                        class="flex cursor-pointer items-center justify-center rounded-md border border-gray-100 py-2 px-3 text-gray-900 hover:border-gray-200 peer-checked:border-emerald-700 peer-checked:bg-emerald-700 peer-checked:text-white"
                      >
                        <p class="text-sm font-medium">do 20 kg</p>
                      </label>
                    </div>
                  
                    <div>
                      <input
                        type="radio"
                        name="ColorOption"
                        value="ColorBlue"
                        id="ColorBlue"
                        class="peer hidden"
                      />
                  
                      <label
                        for="ColorBlue"
                        class="flex cursor-pointer items-center justify-center rounded-md border border-gray-100 py-2 px-3 text-gray-900 hover:border-gray-200 peer-checked:border-emerald-700 peer-checked:bg-emerald-700 peer-checked:text-white"
                      >
                        <p class="text-sm font-medium">do 40 kg</p>
                      </label>
                    </div>
                  
                    <div>
                      <input
                        type="radio"
                        name="ColorOption"
                        value="ColorGold"
                        id="ColorGold"
                        class="peer hidden"
                      />
                  
                      <label
                        for="ColorGold"
                        class="flex cursor-pointer items-center justify-center rounded-md border border-gray-100 py-2 px-3 text-gray-900 hover:border-gray-200 peer-checked:border-emerald-700 peer-checked:bg-emerald-700 peer-checked:text-white"
                      >
                        <p class="text-sm font-medium">40kg+</p>
                      </label>
                    </div>
                  </fieldset>
                  
            </div>
    
            <div class="my-2">
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900">Wybierz usługę</label>
                <select id="countries" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-700 focus:border-emerald-700 block w-full p-2.5">
                    <option selected>Usługa</option>
                    <option value="US">Szkolenie</option>
                    <option value="CA">Wyprowadzanie</option>
                    <option value="FR">Opieka dzienna</option>
                    <option value="DE">Konsultacja behawioralna</option>
                  </select>
            </div>
    
            <div class="my-2">
                <p class="block my-2 text-sm font-medium text-gray-900">Wiek psa</p>
                <fieldset class="flex flex-wrap gap-3">
                    <legend class="sr-only">Waga</legend>
                  
                    <div>
                      <input
                        type="radio"
                        name="DogAgeOption"
                        value="DogAgeYoung"
                        id="DogAgeYoung"
                        class="peer hidden"
                        checked
                      />
                  
                      <label
                        for="DogAgeYoung"
                        class="flex cursor-pointer items-center justify-center rounded-md border border-gray-100 py-2 px-3 text-gray-900 hover:border-gray-200 peer-checked:border-emerald-700 peer-checked:bg-emerald-700 peer-checked:text-white"
                      >
                        <p class="text-sm font-medium">do roku</p>
                      </label>
                    </div>
                  
                    <div>
                      <input
                        type="radio"
                        name="DogAgeOption"
                        value="DogAgeMedium"
                        id="DogAgeMedium"
                        class="peer hidden"
                      />
                  
                      <label
                        for="DogAgeMedium"
                        class="flex cursor-pointer items-center justify-center rounded-md border border-gray-100 py-2 px-3 text-gray-900 hover:border-gray-200 peer-checked:border-emerald-700 peer-checked:bg-emerald-700 peer-checked:text-white"
                      >
                        <p class="text-sm font-medium">1-5</p>
                      </label>
                    </div>
                  
                    <div>
                      <input
                        type="radio"
                        name="DogAgeOption"
                        value="DogAgeOld"
                        id="DogAgeOld"
                        class="peer hidden"
                      />
                  
                      <label
                        for="DogAgeOld"
                        class="flex cursor-pointer items-center justify-center rounded-md border border-gray-100 py-2 px-3 text-gray-900 hover:border-gray-200 peer-checked:border-emerald-700 peer-checked:bg-emerald-700 peer-checked:text-white"
                      >
                        <p class="text-sm font-medium">5-8</p>
                      </label>
                    </div>
                  
                    <div>
                      <input
                        type="radio"
                        name="DogAgeOption"
                        value="DogAgeVeryOld"
                        id="DogAgeVeryOld"
                        class="peer hidden"
                      />
                  
                      <label
                        for="DogAgeVeryOld"
                        class="flex cursor-pointer items-center justify-center rounded-md border border-gray-100 py-2 px-3 text-gray-900 hover:border-gray-200 peer-checked:border-emerald-700 peer-checked:bg-emerald-700 peer-checked:text-white"
                      >
                        <p class="text-sm font-medium">ponad 8</p>
                      </label>
                    </div>
                  </fieldset>
                  
            </div>
    
            <div class="my-4">
                <button class="w-full block rounded-md bg-emerald-700 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-emerald-600">
                    Wyszukaj
                </button>
            </div>
    
        </form>

    </div>



    {{-- <div class="flex justify-self-start bg-white w-9/12 pl-8 pt-3">


        <p 
            class="rounded-full bg-emerald-100 px-2.5 py-0.5 text-emerald-700"
            x-show="show: true" 
            @click="show != show"
        >
            Gdańsk
        </p>
        <p class="rounded-full bg-emerald-100 px-2.5 py-0.5 text-emerald-700 ml-4">do 20 kg</p>
        <p class="rounded-full bg-emerald-100 px-2.5 py-0.5 text-emerald-700 ml-4">Opieka dzienna</p>
        <p class="rounded-full bg-emerald-100 px-2.5 py-0.5 text-emerald-700 ml-4">1-5</p>
    </div> --}}
    

    <div class="flex flex-wrap justify-between w-9/12 bg-white p-8 gap-x-2 gap-y-8">

        <div class="rounded overflow-hidden shadow-lg w-[calc(33%-1rem)]">
            <a href="#" class="hover:opacity-60 transition">
                <img class="w-full" src="https://images.unsplash.com/photo-1581888227599-779811939961?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1674&q=80" alt="Sunset in the mountains">
                <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">Janusz Nowak</div>
                <p class="text-gray-700 text-base">
                    Gdańsk
                </p>
                </div>

                <div class="px-6 pt-4 pb-2">
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
                </div>
            </a>
        </div>        

        <div class="rounded overflow-hidden shadow-lg  w-[calc(33%-1rem)]">
            <a href="#" class="hover:opacity-60 transition">
                <img class="w-full" src="https://images.unsplash.com/photo-1581888227599-779811939961?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1674&q=80" alt="Sunset in the mountains">
                <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">Janusz Nowak</div>
                <p class="text-gray-700 text-base">
                    Gdańsk
                </p>
                </div>

                <div class="px-6 pt-4 pb-2">
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
                </div>
            </a>
        </div>

        <div class="rounded overflow-hidden shadow-lg  w-[calc(33%-1rem)]">
            <a href="#" class="hover:opacity-60 transition">
                <img class="w-full" src="https://images.unsplash.com/photo-1581888227599-779811939961?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1674&q=80" alt="Sunset in the mountains">
                <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">Janusz Nowak</div>
                <p class="text-gray-700 text-base">
                    Gdańsk
                </p>
                </div>

                <div class="px-6 pt-4 pb-2">
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
                </div>
            </a>
        </div>

        <div class="rounded overflow-hidden shadow-lg  w-[calc(33%-1rem)]">
            <a href="#" class="hover:opacity-60 transition">
                <img class="w-full" src="https://images.unsplash.com/photo-1581888227599-779811939961?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1674&q=80" alt="Sunset in the mountains">
                <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">Janusz Nowak</div>
                <p class="text-gray-700 text-base">
                    Gdańsk
                </p>
                </div>

                <div class="px-6 pt-4 pb-2">
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
                </div>
            </a>
        </div>
    </div>
</div>



{{-- <div class="grid grid-cols-4 gap-4 w-9/12 items-center justify-center border-solid border-2 border-sky-500">
    <div class="bg-emerald-600">01</div>
    <!-- ... -->
    <div class="bg-emerald-600">09</div>
    <div class="bg-emerald-600">09</div>
    <div class="bg-emerald-600">09</div>
</div> --}}

@endsection