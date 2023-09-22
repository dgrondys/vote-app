<x-modal-confirm
    livewire-event-to-open-modal="deleteCommentWasSet"
    event-to-close-modal="commentWasDeleted"
    modal-title="Usuń komentarz"
    modal-description="Napewno chcesz usunąć ten komentarz?"
    modal-confirm-button-text="Usuń"
    wire-click="deleteComment"
/>