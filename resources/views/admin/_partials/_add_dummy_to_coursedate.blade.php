<hr class="m-t-b-10">
<form class="form-inline" method="POST" role="form" action="{!! route('admin::coursedates_create_Neukunde', ['coursedate' => $coursedate->id]) !!}" v-show="add_Neukunde">
    <div class="form-group">
        <input type="text" name="first_name" class="form-control" required="required" placeholder="Vorname">
    </div>
    <div class="form-group">
        <input type="text" name="last_name" class="form-control" required="required" placeholder="Nachname">
    </div>
    <div class="form-group">
         <input type="email" name="email" class="form-control" placeholder="E-Mailadresse">
    </div>
    {!! csrf_field() !!}
    <input type="submit" value="Speichern" class="btn btn-success">
    <button class="btn btn-danger" role="button" @click.prevent="add_Neukunde = false">
        <i class="fa fa-times" aria-hidden="true"></i>
        Schließen
    </button>
</form>


<button v-else type="button" class="btn btn-default" @click="add_Neukunde = true"><i class="fa fa-user-plus" aria-hidden="true"></i> Neukunden hinzufügen</button>


@section('scripts')
    @parent
    <script type="text/javascript">
        new Vue({
            el: '#add-Neukunde-wrapper',

            data: {
                'add_Neukunde' : false,
            },

            methods: {
                log() {
                    console.log('button clicked');
                }
            }

        })
    </script>

@endsection