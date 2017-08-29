@isset($options)
    <div class="dropdown">
        <div class="dropdown__label">
            <span>{{$label}}</span>
        </div>
        <div class="dropdown__wrapper">
            <ul class="dropdown__options">
                @foreach($options as $option)
                    <li data-slug="{{$option->slug}}" class="dropdown__option">
                        {{$option->label}}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endisset