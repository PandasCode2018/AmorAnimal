@props(['property'])

@error($property)
    <div class="mt-2 login__input-error text-left text-danger">
        {!! ucfirst($message) !!}
    </div>
@enderror
