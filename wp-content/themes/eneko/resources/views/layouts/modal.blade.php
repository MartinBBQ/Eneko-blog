@php
    $innerModifier = !empty($innerModifier) ? 'modal__inner--'.$innerModifier : '';
@endphp
<div class="modal {{$isMarginless}}">
    <div class="modal__main">
        <div class="modal__inner {{$innerModifier}}">
            <div class="cross"></div>
            <div class="modal__content">
                @yield('modal-content')
            </div>
        </div>
    </div>
</div>