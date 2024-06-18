@props(['name'])
@error($name)
    <p style="color: red; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
@enderror