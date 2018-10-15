<h1 style="margin-top: 50px;font-size: 24px">Deine Kursabmeldung wurde bestätigt</h1>


<p>
    Hallo {{ $user->first_name }}, <br>
	du hast dich soeben aus dem Kurs <strong>{{ $coursedate->course()->first()->name_with_details_public }} am {{ $coursedate->date_formated }}</strong> ausgetragen.<br>
	@if ( $gueltige_abmeldung )
		Der Kurs wird dir gutgeschrieben. Du kannst dich bis zum {{ $actualSignedOutCourse->gueltig_bis_formated }} in einen anderen Kurs eintragen.
		Ist der ausgetragene Kurstermin bereits ein Nachholkurs behält dieser nur die ursprüngliche Gültigkeit.
	@else
		Leider hast du dich zu spät abgemeldet und dir wird kein Kurs gutgeschrieben. <br>
		Ein Kurs wird nur dann gutgeschrieben, wenn du dich bis <strong>spätestens 18:00 Uhr am Vortag<strong> des Kurses abgemeldet hast<br>
		oder<br>
		der ausgetragene Kurstermin war bereits ein Nachholkurs. Dieser behält nur die ursprüngliche Gültigkeit, welche bereits abgelaufen ist.
	@endif
</p>

@if ($allNachholkurse->count() > 1)
    <p style="color: red">Achten Sie bitte darauf, dass Sie noch weitere Kurse nachholen können</p>


    <h3>Alle offenen Kurse</h3>
    <ul>
    	@for ($i = 1; $i <= count($allNachholkurse); $i++)
    	   	<li>{{ $i }}. Eintragung muss bis zum {{ $allNachholkurse[$i-1]->gueltig_bis_formated }} erfolgen</li>
    	@endfor
    </ul>
@endif

Weiterhin viel Spaß im Studio wünscht dir<br>
dein Yours-Team