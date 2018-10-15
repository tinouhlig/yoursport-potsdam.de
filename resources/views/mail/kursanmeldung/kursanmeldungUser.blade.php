<h1 style="margin-top: 50px;font-size: 24px">Deine Kursanmeldung wurde bestätigt</h1>


<p>
    Hallo {{ $user->first_name }}, <br>
    du hast dich soeben in den Kurs <strong>{{ $coursedate->course()->first()->name_with_details_public }} am {{ $coursedate->date_formated }}</strong> eingetragen.<br>
</p>

Weiterhin viel Spaß im Studio wünscht dir
dein Yours-Team
