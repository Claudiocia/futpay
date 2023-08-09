<x-mail::message>
#  Data: {{ \Carbon\Carbon::parse($mailData['date'])->format('d/m/Y')}}
# {!! $mailData['title'] !!}

# {!! $mailData['sub-title'] !!}

{!! $mailData['mensagem']!!}

<x-mail::button :url="$url">
    {{$mailData['title-button']}}
</x-mail::button>

Obrigado,<br>
{{ config('app.name') }}
</x-mail::message>
