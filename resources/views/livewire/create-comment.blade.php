<div 
    x-data="{ isOpen: false }" 
    x-init="
            Livewire.on('commentWasCreated', () => {
                isOpen = false
            })

            Livewire.hook('message.processed', (message, component) => {
                if ((message.updateQueue[0].payload.event == 'commentWasCreated' || message.updateQueue[0].payload.event == 'statusWasUpdated') && message.component.fingerprint.name == 'idea-comments') {
                    const lastComment = document.querySelector('.comment-container:last-child')
                    lastComment.scrollIntoView({ behavior: 'smooth' })
                }
            })

    @if (session('scrollToComment'))
    const commentToScrollTo = document.querySelector('#comment-{{ session('scrollToComment') }}')
    commentToScrollTo.scrollIntoView({ behavior: 'smooth'})
    
    @endif
    "
    class="relative"
>
    <button @click="isOpen = !isOpen" type="button"
        class="flex items-center justify-center h-11 w-32 text-sm bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
        Odpowiedz
    </button>
    <div x-cloak x-show.transition.origin.top.left="isOpen" @click.away="isOpen = false"
        @keydown.escape.window="isOpen = false"
        class="absolute z-10 w-64 md:w-104 text-left font-semibold text-sm bg-white shadow-dialog rounded-xl mt-2">
        @auth
            <form wire:submit.prevent="createComment" action="#" class="space-y-4 px-4 py-6">
                <div>
                    <textarea wire:model="comment" name="post_comment" id="post_comment" cols="30" rows="4"
                    class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 border-none px-4 py-2"
                    placeholder="Podziel się z innymi co sądzisz o tym pomyśle..." required></textarea>

                    @error('comment')
                        <p class="text-red text-xs mt-1">{{ $message }}</p>
                    @enderror

                </div>

                <div class="flex flex-col md:flex-row items-center md:space-x-3">
                    <button type="submit"
                        class="flex items-center justify-center h-11 w-full md:w-1/2 text-sm bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
                        Wyślij
                    </button>
                </div>
            </form>
        @else
            <div class="px-4 py-6">
                <p class="font-normal">Zaloguj się aby napisać komentarz.</p>
                <div class="flex items-center space-x-3 mt-8">
                    <a 
                        href="{{ route('login') }}"
                        class="w-1/2 h-11 text-sm text-center bg-blue text-white font-semibold rounded-xl hover:bg-blue-hover transition duration-150 ease-in px-6 py-3"
                    >
                        Zaloguj
                    </a>
                    <a 
                        href="{{ route('register') }}"
                        class="flex items-center justify-center w-1/2 h-11 text-sm bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3"
                    >
                        Zarejestruj
                </a>
                </div>
            </div>
        @endauth
    </div>
</div>
