<div>
    <div
                x-data
                @click="
                    const target = $event.target.tagName.toLowerCase()
                    const ignores = ['button', 'svg', 'path', 'a']

                    if(! ignores.includes(target))
                    {
                        $event.target.closest('.idea-container').querySelector('.idea-link').click()
                    }
                "
                class="idea-container hover:shadow-card transition duration-150 ease-in bg-white rounded-xl flex cursor-pointer"
            >
                <div class="hidden md:block border-r border-gray-100 px-5 py-8">
                    <div class="text-center">
                        <div class="font-semibold text-2xl @if ($hasVoted) text-blue @endif">{{ $votesCount }}</div>
                        <div class="text-gray-500">Głosów</div>
                    </div>
                    <div class="mt-8">
                        @if ($hasVoted)
                            <button 
                            wire:click.prevent="vote"
                            class="w-20 bg-blue text-white border border-blue hover:bg-blue-hover font-bold text-xxs uppercase rounded-xl transition duration-150 ease-in px-4 py-3">Głos oddany</button>
                        @else
                            <button
                            wire:click.prevent="vote"
                            class="w-20 bg-gray-200 border border-gray-200 hover:border-gray-400 font-bold text-xxs uppercase rounded-xl transition duration-150 ease-in px-4 py-3">Głosuj</button>
                        @endif
                    </div>
                </div>
                <div class="flex flex-col md:flex-row flex-1 px-2 py-6">
                <div class="flex-none mx-2 md:mx-4">
                    <a href="#">
                        <img src="/uploads/avatars/{{ $idea->user->avatar }}" alt="avatar" class="w-14 h-14 rounded-xl">
                    </a>
                    @if ($idea->user->isAdmin())
                        <div class="text-left ml-2 md:ml-0 md:text-center uppercase text-blue text-xxs font-bold mt-1">Admin</div>
                    @endif
                </div>
                    <div class="w-full flex flex-col justify-between mx-2 md:mx-4">
                        <h4 class="text-xl font-semibold mt-2 md:mt-0">
                            <a href="{{ route('idea.show', $idea) }}" class="idea-link hover:underline">{{ wordwrap($idea->title, 35, "\n", true) }}</a>
                        </h4>
                        <div class="text-gray-600 mt-3 line-clamp-3">
                            {{ wordwrap($idea->description, 45, "\n", true) }}
                        </div>

                        <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                            <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                                <div>{{ $idea->created_at->diffForHumans() }}</div>
                                <div>&bull;</div>
                                <div>{{ $idea->category->name }}</div>
                                <div>&bull;</div>
                                <div wire:ignore class="text-gray-900">{{ $idea->comments_count }} Komentarzy</div>
                            </div>
                            <div 
                                x-data="{ isOpen: false }"
                                class="flex items-center space-x-2 mt-4 md:mt-0"

                            >
                                <div class="{{ 'status-'.Str::kebab($idea->status->name) }} text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">{{ $idea->status->name }}</div>
                            </div>
                            <div class="flex items-center md:hidden mt-4 md:mt-0">
                                <div class="bg-gray-100 text-center rounded-xl h-10 px-4 py-2 pr-8">
                                    <div class="text-sm font-bold leading-none @if ($hasVoted) text-blue @endif">{{ $votesCount }}</div>
                                    <div class="text-xxs font-semibold leading-none text-gray-400">Głosów</div>
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
</div>
