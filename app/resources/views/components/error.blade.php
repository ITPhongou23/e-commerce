@props([
    'name' => 'required'
])

@error($name)

    <p class="text-xs text-error mt-1">{{ $message }}</p>

@enderror