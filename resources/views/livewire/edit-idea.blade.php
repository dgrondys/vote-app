<div
    x-cloak
    @custom-show-edit-modal.window="isOpen = true"
    x-data="{ isOpen: false }"
    x-show="isOpen"
    @keydown.escape.window="isOpen = false"
    x-init="
                        window.livewire.on('ideaWasUpdated', () => {
                            isOpen = false
                        })
    "
    class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen">
        <div
            x-show.transition.opacity="isOpen"
            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true">
        </div>
        <div
            x-show.transition.origin.bottom.duration.400ms="isOpen"
            class="modal inline-block align-bottom bg-white rounded-tl-lg rounded-tr-lg overflow-hidden transform transition-all sm:max-w-lg sm:w-full py-4">
            <div class="absolute top-0 right-0 pt-4 pr-4">
                <button 
                    @click="isOpen = false"
                    class="text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <h3 class="text-center text-lg font-medium text-gray-900">Edytuj pomysł</h3>
                <p class="text-xs text-center text-gray-500 mt-4 leading-5 px-6">Możesz edytować swój pomysł jedynie przez godzinę od utworzenia go.</p>
                <form wire:submit.prevent="updateIdea" action="#" method="POST" class="space-y-4 px-4 py-6">
                    <div>
                        <input wire:model.defer="title" type="text" class="w-full text-sm bg-gray-100 border-none rounded-xl placeholder-gray-900 px-4 py-2" placeholder="Twój pomysł" required>
                        @error('title')
                            <p class="text-red text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <select wire:model.defer="category" name="category_add" id="category_add" class="w-full bg-gray-100 text-sm rounded-xl border-none px-4 py-2">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                        @error('category')
                            <p class="text-red text-xs mt-1">{{ $message }}</p>
                        @enderror
                    <div>
                        <textarea wire:model.defer="description" name="idea" id="idea" cols="30" rows="4" class="w-full bg-gray-100 rounded-xl border-none placeholder-gray-900 text-sm px-4 py-2" placeholder="Opisz swój pomysł" required></textarea>
                        @error('description')
                            <p class="text-red text-xs mt-1">{{ $message }}</p>
                    @enderror
                    </div>
                    <div class="flex items-center justify-between space-x-3">
                        <button 
                        type="submit"
                        class="flex items-center justify-center w-1/2 h-11 text-xs bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3"
                        >
                            <span class="ml-1">Wyślij</span>
                        </button>
                    </div>         
                </form>
            </div>
        </div>
    </div>
</div>
  