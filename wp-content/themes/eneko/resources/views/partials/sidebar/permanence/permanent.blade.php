@php($found = false)
<div class="modal__group">
    <p class="modal__nextLabel">Horaires d’ouverture de la permanence</p>
    <ul class="modal__list">
        @foreach($days as $day)
            @php
                $dayString = reset($day['day']);
                $isToday = \App\isToday($dayString, $found);
                if ($isToday) {
                    $found = true;
                }
            @endphp
            <li class="modal__listItem {{$isToday ? 'is-today' : ''}}">
                <span>{{$dayString}} •</span>
                {{$day['morning_start_hour']}} - {{$day['morning_end_hour']}},
                {{$day['afternoon_start_hour']}} - {{$day['afternoon_end_hour']}}
                @if($isToday)
                    (aujourd'hui)
                @endif
            </li>
        @endforeach
    </ul>
</div>