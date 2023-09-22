<div>
    <div class="idea-and-buttons container">
        <div class="idea-container bg-white rounded-xl flex mt-4">
            <div class="flex flex-col md:flex-row flex-1 px-4 py-6">
            <div class="flex-none mx-2">
                <a href="#">
                    <img src="/uploads/avatars/{{ $idea->user->avatar }}" alt="avatar" class="w-14 h-14 rounded-xl">
                </a>
                @if ($idea->user->isAdmin())
                    <div class="text-left ml-2 md:ml-0 md:text-center uppercase text-blue text-xxs font-bold mt-1">Admin</div>
                @endif
            </div>
                <div class="w-full mx-2 md:mx-4">
                    <h4 class="text-xl font-semibold mt-2 md:mt-0">
                        {{ wordwrap($idea->title, 45, "\n", true) }}
                    </h4>
                    <div class="text-gray-600 mt-3">
                        {{ wordwrap($idea->description, 70, "\n", true) }}
                    </div>

                    <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                        <div class="flex items-center text-xxs text-gray-400 font-semibold space-x-1">
                            <div class="hidden md:block font-bold text-gray-900">{{ $idea->user->name }}</div>
                            <div class="hidden md:block">&bull;</div>
                            <div>{{ $idea->created_at->diffForHumans() }}</div>
                            <div>&bull;</div>
                            <div>{{ $idea->category->name }}</div>
                            <div>&bull;</div>
                            <div class="text-gray-900">{{ $idea->comments()->count() }} Komentarzy</div>
                        </div>
                        <div
                            x-data="{ isOpen: false }"
                            class="flex items-center space-x-2 mt-4 md:mt-0"
                        >
                            <div class="{{ 'status-'.Str::kebab($idea->status->name) }} text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">{{ $idea->status->name }}</div>
                            <div class="relative">
                                <button
                                    @click="isOpen = !isOpen"
                                    class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in py-2 px-3"
                                >
                                    <svg fill="currentColor" width="24" height="6"><path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)"></svg>
                                </button>
                                <ul
                                        x-cloak
                                        x-show.transition.origin.top.left="isOpen"
                                        @click.away="isOpen = false"
                                        @keydown.escape.window="isOpen = false"
                                        class="absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl z-10 py-3 md:ml-8 top-8 md:top-6 right-0 md:left-0"
                                    >
                                        @can('update', $idea)
                                        <li>
                                            <a
                                                @click.prevent="
                                                    isOpen = false
                                                    $dispatch('custom-show-edit-modal')
                                                "
                                                href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3"
                                            >
                                                Edytuj
                                            </a>
                                        </li>
                                        @endcan
                                        
                                        @can('delete', $idea)
                                        <li>
                                            <a
                                                @click.prevent="
                                                    isOpen = false
                                                    $dispatch('custom-show-delete-modal')
                                                "
                                                href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3"
                                            >
                                                Usuń
                                            </a>
                                        </li>
                                        @endcan
                                </ul>
                            </div>
                        </div>
                        <div class="flex items-center md:hidden mt-4 md:mt-0">
                        <div class="bg-gray-100 text-center rounded-xl h-10 px-4 py-2 pr-8">
                            <div class="text-sm font-bold leading-none @if ($hasVoted) text-blue @endif">{{ $votesCount }}</div>
                            <div class="text-xxs font-semibold leading-none text-gray-400">Votes</div>
                        </div>
                            @if ($hasVoted)
                                <button
                                wire:click.prevent="vote"
                                class="w-20 bg-blue border text-white border-blue font-bold text-xxs uppercase rounded-xl hover:bg-blue-hover transition duration-150 ease-in px-4 py-3 -mx-5"
                            >
                                Głos oddany
                        </button>
                            @else
                                <button
                                wire:click.prevent="vote"
                                class="w-20 bg-gray-200 border border-gray-200 font-bold text-xxs uppercase rounded-xl hover:border-gray-400 transition duration-150 ease-in px-4 py-3 -mx-5"
                            >
                                Głosuj
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="buttons-container flex items-center justify-between mt-6">
            <div class="flex flex-col md:flex-row items-center space-x-4 md:ml-6">
                <livewire:create-comment :idea="$idea" />
                @can('updateStatus', $idea)
                    <livewire:set-status :idea="$idea">
                @endcan
            </div>

            <div class="hidden md:flex items-center space-x-3">
                <div class="bg-white font-semibold text-center rounded-xl px-3 py-2">
                    <div class="text-xl leading-snug @if($hasVoted) text-blue @endif">{{ $votesCount }}</div>
                    <div class="text-gray-400 text-xs leading-none">Głosów</div>
                </div>
                @if ($hasVoted)
                    <button
                    wire:click.prevent="vote"
                    type="button"
                    
                    class="w-20 bg-blue border text-white border-blue font-bold text-xxs uppercase rounded-xl hover:bg-blue-hover transition duration-150 ease-in px-4 py-3 -mx-5"
                    >
                    <span>Głos oddany</span>
            </button>
                @else
                    <button
                        wire:click.prevent="vote"
                        type="button"
                        class="h-11 w-32 text-xs bg-gray-200 font-semibold uppercase rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3"
                        >
                        <span>Głosuj</span>
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
