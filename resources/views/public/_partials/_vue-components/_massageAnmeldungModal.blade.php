<template id="massageanmeldungmodal">
    <div class="modal-mask" id="massageanmeldungmodal" v-show="show" @click="close" transition="modal" @keyup.esc="close">
        <div class="modal-wrapper massagen-anfrage">
            <div class="modal-container" @click.stop>
                <div class="modal-header">
                    <button class="modal-close-button" @click="close">
                        <span></span>
                    </button>
                    <h3 class="modal-title">Anfrageformular</h3>
                    <hr class="hr-primary">
                </div>
                <div class="modal-body">
                    <div class="kursplan-kursanmeldung-form">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                        {!! Form::open(['route' => 'massageanfrage', 'role' => 'form']) !!}
                            <div class="form-group col-sm-6">
                                {!! Form::label('massagen', 'Massage') !!}
                                <select
                                    class="form-control"
                                    name="massagen"
                                    v-model="selectedMassage"
                                    v-on:change="getDauer"
                                    required
                                >
                                    <option ></option>
                                    <option v-for="option in massagen" :value="option.name">
                                        @{{ option.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                {!! Form::label('dauer', 'Dauer') !!}
                                <select
                                    class="form-control"
                                    name="dauer"
                                    required
                                >
                                    <option></option>
                                    <option v-for="option in dauer" :value="option">
                                        @{{ option }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                {!! Form::label('email', 'E-Mailadresse') !!}
                                {!! Form::email('email', null, [ 'class' => 'form-control', 'required' => 'required'] ) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('message', 'optionale Nachricht') !!}
                                {!! Form::textarea('message', null, [ 'class' => 'form-control', 'required' => 'required', 'placeholder' => "Bitte teilen Sie uns Ihren Wunschtermin mit..." ] ) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit('Senden', [ 'class' => 'form-control btn button-primary'] ) !!}
                            </div>
                            {!! Form::text('spam_filter', null, [ 'class' => 'input-hidden']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="modal-close-text center-block" @click="close">Schließen</button>
                </div>
            </div><!-- /.modal-contaienr -->
        </div><!-- /.modal-wrapper -->
    </div><!-- /.modal-mask -->
</template>


@section('scripts')
    @parent
    <script type="text/javascript">
        Vue.component('massageanmeldungmodal',{
            template: '#massageanmeldungmodal',
            data: function () {
                return {
                    massagen : {
                        'Klassische Massage': {name: 'Klassische Massage', dauer: ['30 min', '45 min', '60 min', '90 min']},
                        'Aromaölmassage': {name: 'Aromaölmassage', dauer: ['30 min', '45 min', '60 min', '90 min']},
                        'Fußreflexzonenmassage': {name: 'Fußreflexzonenmassage', dauer: ['30 min', '45 min', '60 min']},
                        'Hot Stone Massage': {name: 'Hot Stone Massage', dauer: ['60 min', '90 min']},
                        'Gentle Pressure Technique': {name: 'Gentle Pressure Technique', dauer: ['30 min', '45 min']},
                        'Ganzkörpermassage Abhyanga': {name: 'Ganzkörpermassage Abhyanga', dauer: ['60 min', '90 min']}
                    },
                    selectedMassage : null,
                    dauer : []
                }
            },
            props: {
                show: {
                    type: Boolean,
                    required: true,
                    twoWay: true
                }
            },
            methods: {
                close: function () {
                    this.show = false;
                },
                getDauer: function() {
                    if (this.selectedMassage != null) {
                        this.dauer = this.massagen[this.selectedMassage].dauer;
                    } else {
                        this.dauer = [];
                    }
                }
            }
        });
        new Vue({
            el: '#massage-angebote',

            data: {
                showModal: false
            },

            methods: {
                showMassageAnmeldungModal: function () {
                    this.showModal = true;
                }
            }
        });
    </script>

@endsection
