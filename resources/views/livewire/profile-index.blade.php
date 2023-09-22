{{-- <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width:150px; height:150px; float: left; border-radius:50%; margin-right:25px;">
                {{ Auth::user()->name }} Profil
                <form enctype="multipart/form-data" action="/profile" method="POST">
                    <label>Update Profile Image</label>
                    <input type="file" name="avatar">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit">
                </form>
            </div>
        </div>
    </div>
</div> --}}
<div class="flex flex-col items-center mt-10 md:mt-24">
    <div class="">
        <h3 class="font-bold text-blue text-base md:text-3xl">Szczegóły Twojego profilu</h3>
    </div>
    <div class="idea-container hover:shadow-card transition duration-150 ease-in bg-white rounded-xl flex flex-col md:flex-row mt-4 px-2">
        <div class="flex flex-col border-r-0 md:border-r-2 md:border-gray-100 px-5 md:px-20 py-8">
            <div>
                <h1 class="flex items-center justify-center mb-8 font-bold text-blue text-xs">Wybierz swój avatar</h1>
            </div>
            <div class="flex items-center justify-center">
                <img src="/uploads/avatars/{{ Auth::user()->avatar }}" class="w-36 h-36 float-left rounded-full" >
            </div>
            <div>
                <form enctype="multipart/form-data" action="{{url('avatar')}}" method="POST" class="mt-4 px-0 md:px-2 py-2 md:py-0 flex flex-col md:flex-row items-center">
                    {{ csrf_field() }}
                    <label for="form-file" class="w-full h-9 text-xxs text-center bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-3 py-3 cursor-pointer md:mr-2 mb-2 md:mb-0">Wybierz zdjęcie</label>
                    <input type="file" name="avatar" id="form-file" class="hidden">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input 
                    type="submit"
                    value="Zapisz"
                    class="flex items-center justify-center w-1/2 h-9 text-xxs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-3 py-3 cursor-pointer">
                    </input>
                </form>
            </div>
        </div>

        <div class="flex flex-col px-5 md:px-20 py-8">
            <div>
                <h1 class="flex items-center justify-center mb-4 font-bold text-blue text-xs">Zmień swoje hasło</h1>
            </div>
            <div>
                <div class="flex flex-col">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form class="flex flex-col" method="POST" action="{{url('profile')}}">
                        @csrf
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <!-- Password -->
                        <div class="mt-4">
                            <x-label for="hasło" :value="__('Obecne hasło')" class="text-blue" />

                            <x-input id="hasło" class="block mt-1 w-full"
                                            type="password"
                                            name="hasło" 
                                            autocomplete="hasło" />
                        </div>

                        <div class="mt-4">
                            <x-label for="nowe_hasło" :value="__('Nowe hasło')" class="text-blue" />

                            <x-input id="nowe_hasło" class="block mt-1 w-full"
                                            type="password"
                                            name="nowe_hasło" 
                                            autocomplete="hasło" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mt-4 mb-2">
                            <x-label for="nowe_hasło_confirmation" :value="__('Powtórz hasło')" class="text-blue" />

                            <x-input id="nowe_hasło_confirmation" 
                                            type="password" 
                                            name="nowe_hasło_confirmation" 
                                            autocomplete="hasło" required />
                        </div>
                        

                            <x-button class="flex items-center justify-center h-8 text-xxs bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in mt-2 px-6 py-3">
                                {{ __('Zmień hasło') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="flex flex-row">
            <div>
                <form enctype="multipart/form-data" action="{{url('delete')}}" method="POST" class="mt-4 px-0 md:px-2 py-2 md:py-0 flex flex-col md:flex-row items-center">
                    {{ csrf_field() }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input 
                    type="submit"
                    value="Usuń swoje konto"
                    class="w-full h-9 text-xxs bg-red font-semibold rounded-xl border border-transparent shadow-sm hover:border-gray-900 transition duration-150 ease-in px-3 py-3 cursor-pointer">
                    </input>
                </form>
            </div>
            <div>
                <form enctype="multipart/form-data" action="{{url('avatarDel')}}" method="POST" class="mt-4 px-0 md:px-2 py-2 md:py-0 flex flex-col md:flex-row items-center">
                    {{ csrf_field() }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input 
                    type="submit"
                    value="Usuń avatar"
                    class="flex items-center justify-center w-1/2 h-9 text-xxs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-10 py-3 cursor-pointer">
                    </input>
                </form>
            </div>
        </div>
    </div>
</div>