<div class="form-group col-md-4">
    {!! Form::label('name', 'Namenszusatz') !!}
    {!! Form::text('name', null, ['class' => 'form-control'] ) !!}
    <p class="help-block">Für Schwierigkeitsgrad oder andere Zusätze</p>
</div>
<div class="form-group col-md-4">
     {!! Form::label('coursetype_id', 'Kursoberbegriff') !!}
     {!! Form::select('coursetype_id', $coursetypes, null, ['class' => 'form-control']) !!}
     <p class="help-block">Pflichtfeld!</p>
</div>
<div class="form-group col-md-4">
     {!! Form::label('type', 'Kursart') !!}
     {!! Form::select('type', ['normal' => 'Normal', 'small' => 'Kleingruppe'], null, ['class' => 'form-control']) !!}
     <p class="help-block">Pflichtfeld!</p>
</div>
<div class="form-group col-md-4">
     {!! Form::label('day', 'Wochentag') !!}
     {!! Form::select('day', ['Montag' => 'Montag', 'Dienstag' => 'Dienstag', 'Mittwoch' => 'Mittwoch', 'Donnerstag' => 'Donnerstag', 'Freitag' => 'Freitag', 'Samstag' => 'Samstag', 'Sonntag' => 'Sonntag'], null, ['class' => 'form-control']) !!}
     <p class="help-block">Pflichtfeld!</p>
</div>
<div class="form-group col-md-4">
     {!! Form::label('time', 'Startzeit') !!}
     {!! Form::text('time', null, [ 'class' => 'form-control'] ) !!}
     <p class="help-block">Pflichtfeld! Format: hh:mm:ss z.b. 09:00:00 oder 18:30:00</p>
</div>
<div class="form-group col-md-4">
    {!! Form::label('length', 'Länge in Minuten') !!}
    {!! Form::text('length', null, [ 'class' => 'form-control'] ) !!}
    <p class="help-block">Pflichtfeld!</p>
</div>
<div class="form-group col-md-4">
    {!! Form::label('max_participants', 'max. Anzahl an Teilnehmern') !!}
    {!! Form::text('max_participants', null, [ 'class' => 'form-control'] ) !!}
    <p class="help-block">Pflichtfeld!</p>
</div>
<div class="form-group col-md-4">
    {!! Form::label('start', 'Startdatum') !!}
    {!! Form::date('start', $start = \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
    <p class="help-block">Pflichtfeld!</p>
</div>
<div class="form-group col-md-4">
    {!! Form::label('end', 'Enddatum') !!}
    {!! Form::date('end', null, ['class' => 'form-control']) !!}
    <p class="help-block">Bitte ausfüllen falls der Kurs in einem bestimmtem Zeitraum stattfindet.</p>
</div>
<div class="form-group col-md-4">
     {!! Form::label('user_id', 'Trainer') !!}
     {!! Form::select('user_id', $trainer, null, ['class' => 'form-control']) !!}
     <p class="help-block">Pflichtfeld!</p>
</div>
<div class="form-group col-md-4">
    {!! Form::label('status', 'Status') !!}
    {!! Form::select('status', ['active' => 'aktiv', 'inactive' => 'inaktiv'], null, ['class' => 'form-control']) !!}
    <p class="help-block">Pflichtfeld!</p>
</div>
<div class="form-group col-md-12">
    {!! Form::label('description', 'Beschreibung') !!}
    {!! Form::textarea('description', null, [ 'class' => 'form-control'] ) !!}
</div>
<div class="form-group col-md-12">
    {!! Form::submit('Speichern', [ 'class' => 'form-control btn-success'] ) !!}
</div>

@section('styles')
    <link rel="stylesheet" href="/vendor/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" media="screen" title="no title" charset="utf-8">
@stop

@section('scripts')
    <script src="/vendor/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" charset="utf-8"></script>
    <script src="/vendor/bootstrap-wysihtml5/locales/bootstrap-wysihtml5.de-DE.js"></script>
    <script type="text/javascript">
        $("textarea").wysihtml5({
            locale: "de-DE",
            toolbar: {
                "image": false,
                "fa": true
            }
        });
    </script>
@endsection