<div class="modal__group">
    <p class="modal__nextLabel">Horaires</p>
    <ul class="modal__list">
        @foreach($days as $day)
            <li class="modal__listItem">
                <span>{{reset($day['day'])}}</span>
                {{$day['morning_start_hour']}} - {{$day['morning_end_hour']}},
                {{$day['afternoon_start_hour']}} - {{$day['afternoon_end_hour']}}
            </li>
        @endforeach
    </ul>
</div>