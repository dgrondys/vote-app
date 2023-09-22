@component('mail::message')
# Status pomysłu został zaktualizowany.

Pomysł: {{ $idea->title }}

otrzymał nowy status:

{{ $idea->status->name }}

@component('mail::button', ['url' => route('idea.show', $idea)])
Przejdź do pomysłu!
@endcomponent

Dziękujemy,<br>
{{ config('app.name') }}
@endcomponent
