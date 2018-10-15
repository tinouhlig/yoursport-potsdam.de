<div class="form-group">
    {!! Form::label('first_name', 'Vorname') !!}
    {!! Form::text('first_name', null, ['class' => 'form-control'] ) !!}
    <p class="help-block">Pflichtfeld!</p>
 </div>
<div class="form-group">
    {!! Form::label('last_name', 'Nachname') !!}
    {!! Form::text('last_name', null, ['class' => 'form-control'] ) !!}
    <p class="help-block">Pflichtfeld!</p>
 </div>
<div class="form-group">
    {!! Form::label('email', 'E-Mailadresse') !!}
    {!! Form::email('email', null, [ 'class' => 'form-control'] ) !!}
    <p class="help-block">Pflichtfeld!</p>
 </div>
<div class="form-group">
    {!! Form::label('role', 'Rolle') !!}
    {!! Form::select('role', ['admin' => 'Administator', 'client' => 'Kunde', 'trainer' => 'Trainer', 'inaktiv' => 'Inaktiv'], 'client', ['class' => 'form-control']) !!}
    <p class="help-block">Pflichtfeld!</p>
 </div>
<div class="form-group">
    {!! Form::label('phone', 'Telefonnummer') !!}
    {!! Form::text('phone', null, [ 'class' => 'form-control'] ) !!}
 </div>
<div class="form-group">
    {!! Form::submit('Speichern', [ 'class' => 'form-control btn-success'] ) !!}
 </div>
