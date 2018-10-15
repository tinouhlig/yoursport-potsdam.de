<h1 style="margin-top: 50px;font-size: 24px">Kursanmeldung von {{ $user->fullname }}</h1>


<p>
    {{ $user->fullname }} hat sich soeben in den Kurs <strong>{{ $coursedate->course()->first()->name_with_details_public }} am {{ $coursedate->date_formated }}</strong> eingetragen.<br>
</p>

Beste Grüße,
dein Liebling :)