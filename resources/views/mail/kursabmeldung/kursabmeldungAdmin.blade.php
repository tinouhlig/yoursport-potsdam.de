<!DOCTYPE html>
<html>
	<head>
		<title>Kursabmeldung</title>
	</head>
	<body>

		<h1 style="margin-top: 50px;font-size: 24px">Kursabmeldung von {{ $user->fullname }}</h1>

		<p>
		{{ $user->fullname }} hat sich aus dem Kurs <strong>{{ $coursedate->course()->first()->name_with_details_public }} am {{ $coursedate->date_formated }}</strong> ausgetragen.
		</p>

		@if ($gueltige_abmeldung)
			<p>
				Die Abmeldung war fristgerecht.<br><br>
				Der/Die Teilnehmer/in kann sich bis zum {{ $actualSignedOutCourse->gueltig_bis_formated }} in einen Kurs eintragen.
			</p>
		@else
			<p>Die Abmeldung war nicht fristgerecht. Es wurde kein Kurs gutgeschrieben.</p>
		@endif

		<em>Diese Mail wurde automatisch generiert und bedarf keiner Antwort.</em>

	</body>
</html>