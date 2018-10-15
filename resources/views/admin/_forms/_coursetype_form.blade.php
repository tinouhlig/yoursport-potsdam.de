<div class="form-group">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control'] ) !!}
    <p class="help-block">Pflichtfeld!</p>
 </div>
<div class="form-group">
    {!! Form::label('price_list', 'Preise') !!}
    {!! Form::select('price_list[]', $prices, null, ['class' => 'form-control multipleselect', 'multiple' => 'multiple']) !!}
    <p class="help-block">Pflichtfeld!</p>
 </div>
<div class="form-group">
    {!! Form::label('description', 'Beschreibung') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control description'] ) !!}
    <p class="help-block">Pflichtfeld!</p>
 </div>
 <div class="form-group">
     {!! Form::label('status', 'Status') !!}
     {!! Form::select('status', ['active' => 'aktiv', 'inactive' => 'inaktiv'], null, ['class' => 'form-control']) !!}
     <p class="help-block">Pflichtfeld!</p>
  </div>
<div class="form-group">
    {!! Form::submit('Speichern', [ 'class' => 'form-control btn-success'] ) !!}
 </div>

@section('styles')
 <link rel="stylesheet" href="/vendor/select2/select2.min.css" media="screen" title="no title" charset="utf-8">
 <link rel="stylesheet" href="/vendor/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" media="screen" title="no title" charset="utf-8">
@stop

@section('scripts')
    <script src="/vendor/select2/select2.min.js"></script>
    <script src="/vendor/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" charset="utf-8"></script>
    <script src="/vendor/bootstrap-wysihtml5/locales/bootstrap-wysihtml5.de-DE.js"></script>
    <script type="text/javascript">
        $(".multipleselect").select2();
        $(".description").wysihtml5({
            locale: "de-DE",
            toolbar: {
                "image": false,
                "fa": true
            }
        });
    </script>
 @endsection
