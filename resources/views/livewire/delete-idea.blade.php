<x-modal-confirm
    event-to-open-modal="custom-show-delete-modal"
    event-to-close-modal="ideaWasDeleted"
    modal-title="Usuń pomysł"
    modal-description="Napewno chcesz usunąć ten pomysł?"
    modal-confirm-button-text="Usuń"
    wire-click="deleteIdea"
/>