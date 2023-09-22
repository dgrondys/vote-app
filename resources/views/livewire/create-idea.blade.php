<form wire:submit.prevent="createIdea" action="#" method="POST" class="space-y-4 px-4 py-6">
    <div>
        <input wire:model.defer="title" type="text" class="w-full text-sm bg-gray-100 border-none rounded-xl placeholder-gray-900 px-4 py-2" placeholder="Twój pomysł" required maxlength="100">
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
    <div>
        <button 
        type="submit"
        class="flex items-center justify-center w-1/2 h-11 text-xs bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3"
        >
            <span>Wyślij</span>
        </button>
    </div>
</form>