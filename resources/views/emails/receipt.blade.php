
@extends('emails.template')

@section('emails.main')

<br>

Hi  {{ $booking->users->full_name }},

<br>
I just wanted to drop you a quick note to let you know that we have received your recent payment in respect of invoice # {{ $booking->id }}. Thank you very much. We really appreciate it.

<br>
Thanks

@stop