<h1 style="margin-top: 50px;font-size: 24px">Du wurdest ausgetragen.</h1>


<p>
    Hallo {{ $user->first_name }}, <br>
    du wurdest aus dem Kurs <strong>{{ $coursedate->course()->first()->name_with_details_public }} am {{ $coursedate->date_formated }}</strong> ausgetragen.<br>
    Der Kurs wird dir gutgeschrieben. Du kannst dich bis zum {{ $actualSignedOutCourse->gueltig_bis_formated }} in einen anderen Kurs eintragen.
</p>

@if ($allNachholkurse->count() > 1)
    <p style="color: red">Achte bitte darauf, dass du noch weitere Kurse nachholen kannst</p>


    <h3>Alle offenen Kurse</h3>
    <ul>
        @for ($i = 1; $i <= count($allNachholkurse); $i++)
            <li>{{ $i }}. Eintragung muss bis zum {{ $allNachholkurse[$i-1]->gueltig_bis_formated }} erfolgen</li>
        @endfor
    </ul>
@endif

Weiterhin viel Spaß im Studio wünscht dir<br>
dein Yours-Team