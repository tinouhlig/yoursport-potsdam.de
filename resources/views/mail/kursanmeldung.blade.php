<em style="padding-left: 100px;">Diese Mail wurde über das Kontaktformular geschrieben.</em>

<h1 style="margin-top: 50px; padding-left: 100px; font-size: 24px">Kursanfrage</h1>

<table style="margin-top: 50px; max-width: 800px; padding-left: 100px;">
    <tr><td style="font-weight: 700; padding-bottom: 20px;">Kurs:</td></tr>
    <tr>
        <td>Kursname:</td>
        <td>{{ $data['course']->coursetype->name }}</td>
    </tr>
    <tr>
        <td>Wochentag:</td>
        <td>{{ $data['course']->day }}</td>
    </tr>
    <tr>
        <td>Uhrzeit:</td>
        <td>{{ $data['course']->time }}</td>
    </tr>
    <tr>
        <td>Art:</td>
        <td>{{ $data['course']->type_name }}</td>
    </tr>
</table>

<table style="margin-top: 50px; max-width: 800px; padding-left: 100px;">
    <tr><td style="font-weight: 700; padding-bottom: 20px;">Nachricht:</td></tr>
    <tr>
        <td>
            {{ $data['message'] }}
        </td>
    </tr>
</table>

