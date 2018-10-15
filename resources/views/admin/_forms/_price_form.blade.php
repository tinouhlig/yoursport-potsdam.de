<div class="form-group col-lg-12">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control'] ) !!}
    <p class="help-block">Pflichtfeld!</p>
 </div>
<div class="form-group col-lg-12">
    {!! Form::label('amount', 'Preis in Euro, pro Monat') !!}
    {!! Form::text('amount', null, ['class' => 'form-control'] ) !!}
    <p class="help-block">Pflichtfeld! Bitte mit Cent-stellen angeben, z.b. 39.00 ACHTUNG! Trennung mit "PUNKT"</p>
 </div>
<div class="form-group col-lg-6">
    {!! Form::label('duration', 'Laufzeit') !!}
    {!! Form::text('duration', null, ['class' => 'form-control'] ) !!}
    <p class="help-block">Pflichtfeld! Laufzeit bitte als ganze Zahl angeben</p>
 </div>
 <div class="form-group col-lg-6">
    {!! Form::label('duration_type', 'Laufzeitart') !!}
    {!! Form::select('duration_type', ['months' => 'Monate', 'weeks' => 'Wochen'], null, ['class' => 'form-control']) !!}
    <p class="help-block">Pflichtfeld! Berechnung der Laufzeit in Wochen oder Monaten</p>
 </div>
<div class="form-group col-lg-4 ">
    {!! Form::label('first_cancel_period', '1. Kündigungsfrist') !!}
    <input type="number" name="first_cancel_period" class="form-control" min="0" value="{{ $price->first_cancel_period or 0 }}">
    <p class="help-block">Pflichtfeld! Kündiungsfrist als Zahl für die Anzahl der Monate angeben</p>
 </div>
 <div class="form-group col-lg-4 ">
    {!! Form::label('further_cancel_period', 'Kündigungsfrist nach Verlängerung') !!}
    <input type="number" name="further_cancel_period" class="form-control" min="0" value="{{ $price->further_cancel_period or 0 }}">
    <p class="help-block">Pflichtfeld! Kündiungsfrist als Zahl für die Anzahl der Monate angeben</p>
 </div>
 <div class="form-group col-lg-4 ">
    {!! Form::label('contract_extension', 'Vertragsverlängerung') !!}
    <input type="number" name="contract_extension" class="form-control" min="0" value="{{ $price->contract_extension or 0 }}">
    <p class="help-block">Pflichtfeld! Vertragsverlängerung als Zahl für die Anzahl der Monate angeben</p>
 </div>
<div class="form-group col-lg-12">
    {!! Form::label('course_count', 'Anzahl der möglicher Kurse pro Woche / gesamt') !!}
    {!! Form::number('course_count', null, ['class' => 'form-control'] ) !!}
    <p class="help-block">
        Wenn dieses Feld leer gelassen wird, können unendlich viele Kurse gebucht werden!<br>
        Wenn eine Wochenkarte geählt ist, ist das die Gesamtanzahl der Kurse. <br>
        Wenn eine Monatskarte gewählt ist, ist das die Anzahl der Kurse pro Woche.
    </p>
 </div>
 <div class="form-group col-lg-12">
     {!! Form::label('status', 'Status') !!}
     {!! Form::select('status', ['active' => 'aktiv', 'inactive' => 'inaktiv'], null, ['class' => 'form-control']) !!}
     <p class="help-block">Pflichtfeld!</p>
  </div>
<div class="form-group col-lg-12">
    {!! Form::submit('Speichern', [ 'class' => 'form-control btn-success'] ) !!}
 </div>
