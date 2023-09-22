@props([
    'type' => 'success',
    'redirect' => false,
    'messageToDisplay' => '',
])

<div 
    x-data="{ isOpen: false, messageToDisplay: '{{ $messageToDisplay }}', showNotification(message) {
            this.isOpen = true
            this.messageToDisplay = message
            setTimeout(() => {
                this.isOpen = false;
            }, 5000)
        } 
    }"
    x-init="
    @if ($redirect)
        setTimeout(() => {
            showNotification(messageToDisplay)
        }, 400)
    @else
        Livewire.on('ideaWasUpdated', message => {
            showNotification(message)
        })
        Livewire.on('statusWasUpdated', message => {
            showNotification(message)
        })
        Livewire.on('statusWasUpdatedError', message => {
            showNotification(message)
        })
        Livewire.on('commentWasCreated', message => {
            showNotification(message)
        })
        Livewire.on('commentWasUpdated', message => {
            showNotification(message)
        })
        Livewire.on('commentWasDeleted', message => {
            showNotification(message)
        })
    @endif
    
    "
    x-cloak x-show.transition.opacity.duration.400ms="isOpen" @keydown.escape.window="isOpen = false"
    class="flex justify-between max-w-xs sm:max-w-sm w-full z-20 fixed bottom-0 right-0 bg-white rounded-xl shadow-lg border px-6 py-5 mx-2 sm:mx-6 my-8">
    <div class="flex items-center">
        @if ($type === 'success')
            <svg class="text-green h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        @endif

        @if ($type === 'error')
            <svg class="text-red h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        @endif
        <span class="ml-2 font-semibold text-gray-500 text-sm sm:text-base" x-text="messageToDisplay"></span>
    </div>
    <button @click="isOpen = false" class="text-gray-400 hover:text-gray-500">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>
