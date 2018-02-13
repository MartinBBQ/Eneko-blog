<div class="modal__group">
    <p class="modal__nextLabel">Prochaine permanence</p>
    <p class="modal__nextDate">
        <span>{{$nextDay['day']}}</span> - {{$nextDay['hour']}}
    </p>
</div>
<div class="modal__group">
    <p class="modal__nextLabel">A venir</p>
    <ul class="modal__list">
        @foreach(\App\getPermanenceDates($dates) as $date)
            <li class="modal__listItem">
                <span>{{$date['day']}}</span> - {{$date['hour']}}
            </li>
        @endforeach
    </ul>
</div>