<div
                    class="relative"
                    x-data="{ isOpen: false }"
                    x-init="
                        window.livewire.on('statusWasUpdated', () => {
                            isOpen = false
                        })
                        window.livewire.on('statusWasUpdatedError', () => {
                            isOpen = false
                        })
                    "
                >
                    <button
                        @click="isOpen = !isOpen"
                        type="button"
                        class="flex items-center justify-center h-11 w-42 text-sm bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3 mt-2 md:mt-0"
                        >
                        <span>Zmień status</span>
                        <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div
                        x-cloak
                        x-show.transition.origin.top.left="isOpen"
                        @click.away="isOpen = false"
                        @keydown.escape.window="isOpen = false"
                        class="absolute z-20 w-64 md:w-76 text-left font-semibold text-sm bg-white shadow-dialog rounded-xl mt-2"
                    >
                        <form wire:submit.prevent="setStatus" action="#" class="space-y-4 px-4 py-6">
                            <div class="space-y-2">
                                <div>
                                    <label class="inline-flex items-center">
                                        <input wire:model="status" type="radio" class="bg-gray-200 text-gray-600 border-none" name="status" value="1" checked>
                                        <span class="ml-2">Otwarte</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex items-center">
                                        <input wire:model="status" type="radio" class="bg-gray-200 text-yellow border-none" name="status" value="2">
                                        <span class="ml-2">W trakcie</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex items-center">
                                        <input wire:model="status" type="radio" class="bg-gray-200 text-green border-none" name="status" value="3">
                                        <span class="ml-2">Ukończone</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="inline-flex items-center">
                                        <input wire:model="status" type="radio" class="bg-gray-200 text-red border-none" name="status" value="4">
                                        <span class="ml-2">Porzucone</span>
                                    </label>
                                </div>
                            </div>
                            <div>
                                <textarea wire:model="comment" name="update_comment" id="update_comment" cols="30" rows="3" class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 border-none px-4 py-2" placeholder="Dodaj komentarz (opcjonalne)"></textarea>
                            </div>

                            <div class="flex items-center justify-between space-x-3">
                                <button 
                                type="submit"
                                class="flex items-center justify-center w-1/2 h-11 text-xs bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3 disabled:opacity-50"
                                
                                >
                                    <span class="ml-1">Zaktualizuj</span>
                                </button>
                            </div>
                            <div>
                                <label class="font-normal inline-flex items-center">
                                    <input wire:model="notifyAllVoters" type="checkbox" name="notify_voters" class="rounded bg-gray-200">
                                    <span class="ml-2">Powiadom głosujących</span>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>