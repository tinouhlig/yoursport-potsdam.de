<em style="padding-left: 100px;">Diese Mail wurde über das Kontaktformular (Massageanfrage) geschrieben.</em>

<h1 style="margin-top: 50px; padding-left: 100px; font-size: 24px">{{ $data['subject'] }}</h1>

<table style="margin-top: 50px; max-width: 800px; padding-left: 100px;">
    <tr><td style="font-weight: 700; padding-bottom: 20px;">Massage:</td></tr>
    <tr>
        <td>Massage:</td>
        <td>{{ $data['massagen'] }}</td>
    </tr>
    <tr>
        <td>Dauer:</td>
        <td>{{ $data['dauer'] }}</td>
    </tr>
</table>

<table style="margin-top: 50px; max-width: 800px; padding-left: 100px;">
    <tr><td style="font-weight: 700; padding-bottom: 20px;">Nachricht:</td></tr>
    <tr>
        @if (!empty($data['message']))
            <td>
                {{ $data['message'] }}
            </td>
        @else
            <td>
                Es wurde keine Nachricht hinterlassen.
            </td>
        @endif
    </tr>
</table>
