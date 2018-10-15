<em >Diese Mail wurde über das Kontaktformular geschrieben.</em>

<p>Vorname: {{ $data['first_name'] }}</p>
<p>Nachname: {{ $data['last_name'] }}</p>
<p>E-Mailadresse: {{ $data['email_kontakt'] }}</p>
<hr style="width: 50%; margin: 0">
<h3>Nachricht:</h3>

<p>{!! nl2br(e($data['message'])) !!}</p>

