<h1 style="margin-top: 50px;font-size: 24px">Deine Kursanmeldung wurde bestätigt</h1>


<p>
    Hallo {{ $user->first_name }}, <br>
    herzlich Willkommen in deinem YOURS - Account. Hier kannst du alle deine Kurse und persönlichen Daten verwalten, sowie deine Vertragsdaten einsehen. Bitte ändere als allererstes dein Passwort indem du dich auf unsere Homepage einloggst: <a href="{{ route('home') }}">Yours Homepage</a>.
    <br><br>
    <strong>Deine Zugangsdaten:</strong><br>
    E-Mailadresse: {{ $user->email }}<br>
    Passwort: {{ $password }}
    
    <br><br>
    Alle Infos zum Ab- und Anmelden und den Fristen für Kursgutschriften findest du in den AGBs unter den Punkten Abmeldung und Kursgutschriften. Die AGBs findest du im Anhang.
</p>

Viel Spaß bei den Kursen und bis bald im Studio wünscht dir
dein Yours-Team