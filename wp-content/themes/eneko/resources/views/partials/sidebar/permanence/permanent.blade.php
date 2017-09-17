<div class="modal__group">
    <p class="modal__nextLabel">Horaires</p>
    <ul class="modal__list">
        @foreach($days as $day)
            <li class="modal__listItem">
                <span>{{reset($day['day'])}}</span> {{$day['starting_hour']}} - {{$day['ending_hour']}}
            </li>
        @endforeach
    </ul>
</div>