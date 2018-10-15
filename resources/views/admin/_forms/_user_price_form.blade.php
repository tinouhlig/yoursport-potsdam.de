<div class="form-group">
    {!! Form::label('price', 'Preise') !!}
    {!! Form::select('price', $prices_list, null, ['class' => 'form-control new-price']) !!}
    <p class="help-block">Pflichtfeld!</p>
</div>
<div class="form-group">
    {!! Form::label('booked_at', 'gebucht am') !!}
    {!! Form::date('booked_at', null, ['class' => 'form-control new_booked_at']) !!}
    <p class="help-block">Pflichtfeld!</p>
</div>
<div class="form-group">
    {!! Form::label('expire_at', 'Auslaufdatum') !!}
    {!! Form::date('expire_at', null, ['class' => 'form-control new_expire_at']) !!}
    <p class="help-block">Pflichtfeld!</p>
</div>
<div class="form-group">
    {!! Form::submit('Speichern', [ 'class' => 'form-control btn-success'] ) !!}
</div>
