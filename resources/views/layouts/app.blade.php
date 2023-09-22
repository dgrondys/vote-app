<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Team-work</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <livewire:styles />

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans bg-gray-background text-gray-900 text-sm">
        <header class="flex flex-col md:flex-row items-center justify-between px-8 py-4">
            <a href="/"><img src="{{ asset('img/loggo1.png') }}" alt="logo"></a>
            <div class="flex items-center mt-2 md:mt-0">
                @if (Route::has('login'))
                <div class="px-6 py-4">
                    @auth
                    <div class="flex items-center space-x-4">
                        <form method="POST" action="{{ route('logout') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            @csrf
    
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                                        class="w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3 mt-4">
                                        
                        {{ __('Wyloguj się') }}
                        </a>
                        </form>     
                        <livewire:comment-notifications />
                    </div>
                    @else
                        <a href="{{ route('login') }}" class="w-1/2 h-11 text-xxs bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3"
                        >Zaloguj</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="w-1/2 h-11 text-xxs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3 mt-4"
                            >Zarejestruj</a>
                        @endif
                    @endauth
                </div>
                @endif
                @auth
                <a href="{{ route('profile') }}">
                    @auth
                        <img src="/uploads/avatars/{{ Auth::user()->avatar }}"
                        alt="avatar" class="w-10 h-10 rounded-full">
                    @else
                        <img src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp"
                        alt="avatar" class="w-10 h-10 rounded-full">
                    @endauth
                @endauth
                </a>
            </div>
        </header>
        @if (Route::currentRouteName() == 'updateAvatar' || (Route::currentRouteName() == 'profile')|| (Route::currentRouteName() == 'change.password'))
        <main class="container mx-auto max-w-max flex flex-col md:flex-row">
            
            <livewire:profile-index />
        </main>
            @if (session('success_message'))
                <x-notification-success
                    :redirect="true"
                    message-to-display="{{ (session('success_message')) }}"
                />
            @endif
        @else
            <main class="container mx-auto max-w-custom flex flex-col md:flex-row">
                <div class="w-70 mx-auto md:mx-0 md:mr-5">
                    <div class="bg-white md:sticky md:top-8 border-2 border-blue rounded-xl mt-16">
                    <div class="text-center px-6 py-2 pt-6">
                        <h3 class="font-semibold text-base">Dodaj swój pomysł</h3>
                        <p class="text-xs mt-4">
                            @auth
                                    Podziel się z innymi swoim pomysłem i śledź jego rozwój!</p>
                                @else
                                    Zaloguj się aby dodać swój pomysł.
                            @endauth
                    </div>

                    @auth
                            <livewire:create-idea />
                        @else
                            <div class="my-6 text-center">
                                <a 
                                    href="{{ route('login') }}"
                                    class="inline-block justify-center w-1/2 h-11 text-xs bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3"
                                    >
                                        Zaloguj
                                </a>
                                <a
                                    href="{{ route('register') }}"
                                    class="inline-block justify-center w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3 mt-4"
                                    >
                                        Zarejestuj
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
                <div class="w-full md:w-175 px-2 md:px-0">
                    <livewire:status-filters />
                    <div class="mt-8">
                        {{ $slot }}
                    </div>

                </div>
            </main>
            @if (session('success_message'))
                <x-notification-success
                    :redirect="true"
                    message-to-display="{{ (session('success_message')) }}"
                />
            @endif
        @endif
        @if (session('error_message'))
            <x-notification-success
                type="error"
                :redirect="true"
                message-to-display="{{ (session('error_message')) }}"
            />
        @endif
        <livewire:scripts />
    </body>
</html>
