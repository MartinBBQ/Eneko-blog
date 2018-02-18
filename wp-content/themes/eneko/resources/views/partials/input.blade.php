@php
    $value = $value ?? '';
    $placeholder = $placeholder ?? '';
    $type = $type ?? '';
    $name = $name ?? '';
@endphp
<div class="input">
    <div class="input__head">
        <div class="input__label">
            {{$label}}
        </div>
    </div>
    <input
        value="{{$value}}"
        type="{{$type}}"
        placeholder="{{$placeholder}}"
        required="{{$required ?? false}}"
        name="{{$name}}"
    />
</div>