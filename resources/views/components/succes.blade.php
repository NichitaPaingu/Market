@props(['message'])

@if(session('success'))
    <h2 style="color: green; margin-top: 0.25rem;">{{ session('success') }}</h2>
@endif