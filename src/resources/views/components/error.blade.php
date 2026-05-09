@props(['field'])

@error($field)
    <p class="error-message">{{ $message }}</p>
@enderror