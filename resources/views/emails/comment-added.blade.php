@component('mail::message')
# Ktoś napisał komentarz do twojego pomysłu

{{ $comment->user->name }} skomentował twój pomysł:

**{{ $comment->idea->title }}**

Komentarz: {{ $comment->body }}

@component('mail::button', ['url' => route('idea.show', $comment->idea)])
Przejdź do pomysłu
@endcomponent

Dziękujemy,<br>
{{ config('app.name') }}
@endcomponent