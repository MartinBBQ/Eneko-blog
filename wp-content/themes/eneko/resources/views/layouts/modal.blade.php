@php
    $modifier = !empty($innerModifier) ? 'modal--'.$innerModifier : '';
    $innerModifier = !empty($innerModifier) ? 'modal__inner--'.$innerModifier : '';
    $isSmall = !empty($isSmall) ? 'is-small' : '';
    $content = $content ?? 'modal-content';
@endphp
<div class="modal {{$isMarginless}} {{$isSmall}} {{$modifier}}">
    <div class="modal__main">
        <div class="modal__inner {{$innerModifier}}">
            <div class="cross"></div>
            <div class="modal__content">
                @yield($content)
            </div>
        </div>
    </div>
</div>